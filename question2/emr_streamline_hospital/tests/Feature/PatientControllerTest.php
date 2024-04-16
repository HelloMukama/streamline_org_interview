<?php

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

uses(RefreshDatabase::class);

beforeEach(function () {
    // test route names
    $this->routeNames = [
        'index' => 'patients.index.pest',
        'create' => 'patients.create.pest',
        'store' => 'patients.store.pest',
        'show' => 'patients.show.pest',
        'edit' => 'patients.edit.pest',
        'update' => 'patients.update.pest',
        'destroy' => 'patients.destroy.pest',
        'trashed' => 'patients.trashed.pest',
        'restore' => 'patients.restore.pest',
        'restoreAll' => 'patients.restoreAll.pest',
    ];
});

describe('page access', function () {
    it('can access the index page', function () {
        $response = $this->get(route($this->routeNames['index']));
        $response->assertStatus(200);
    });

    it('can access the create page', function () {
        $response = $this->get(route($this->routeNames['create']));
        $response->assertStatus(200);
    });

});

it('can store a new patient', function () {
    $patientData = [
        'file_number' => '123456',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'gender' => 'male',
        'date_of_birth' => '1990-01-01',
        'phone_number' => '1234567890',
        'next_of_kin_relationship' => 'sibling',
        'next_of_kin_phone_number' => '0987654321',
    ];

    $response = $this->post(route($this->routeNames['store']), $patientData);
    $response->assertRedirect(route($this->routeNames['index']));
    $this->assertDatabaseHas('patients', $patientData); // patients table
});

it('can show a patient', function () {
    $patient = Patient::factory()->create();
    $response = $this->get(route($this->routeNames['show'], $patient));
    $response->assertStatus(200);
});

it('can access the edit page', function () {
    $patient = Patient::factory()->create();
    $response = $this->get(route($this->routeNames['edit'], $patient));
    $response->assertStatus(200);
});

it('can update a patient', function () {
    $patient = Patient::factory()->create();
    $updatedData = [
        'last_name' => 'Does',
        'gender' => 'female',
    ];

    $response = $this->put(route($this->routeNames['update'], $patient), $updatedData);
    $response->assertRedirect(route($this->routeNames['index']));
    $this->assertDatabaseHas('patients', $updatedData);
});

it('can delete a patient', function () {
    $patient = Patient::factory()->create();
    $response = $this->delete(route($this->routeNames['destroy'], $patient));
    $response->assertRedirect(route($this->routeNames['index']));
    $this->assertSoftDeleted('patients', ['id' => $patient->id]);
});

it('validates patient registration', function () {
    $response = $this->post(route($this->routeNames['store']), []);

    $response->assertSessionHasErrors([
        'file_number', 'first_name', 'last_name', 'gender', 
        'date_of_birth', 'phone_number', 'next_of_kin_relationship', 'next_of_kin_phone_number'
    ]);
});

it('can restore a patient', function () {
    $patient = Patient::factory()->create();
    $patient->delete();

    $response = $this->post(route($this->routeNames['restore'], $patient->id));
    $response->assertRedirect($this->routeNames['trashed']);
    $this->assertDatabaseHas('patients', ['id' => $patient->id, 'deleted_at' => null]);
});

it('can restore all patients', function () {
    $trashedPatients = Patient::factory()->count(3)->create();
    Patient::destroy($trashedPatients->pluck('id'));

    $response = $this->post(route($this->routeNames['restoreAll']));
    $response->assertRedirect($this->routeNames['index']);

    foreach ($trashedPatients as $patient) {
        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'deleted_at' => null]);
    }
});
