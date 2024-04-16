<?php

use App\Models\Patient;
use App\Models\User;
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

    Patient::factory()->create();

});

describe('page access', function () {
    it('can access the create page', function () {  // pass
        $this->withoutExceptionHandling();
        // $response = $this->get(route($this->routeNames['create']));
        $response = $this->get(route('patients.create.pest'));
        $response->assertStatus(200);
    });
});

it('can store a new patient', function () {  // pass
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);

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
    $response->assertRedirect(route('patients.index')); // redirect route defined in PatientController
    $this->assertDatabaseHas('patients', $patientData); // patients table
});

it('can show a patient', function () {  // pass
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $patient = Patient::factory()->create();
    $response = $this->get(route($this->routeNames['show'], $patient));
    $response->assertStatus(200);
});

it('can access the edit page', function () {  // pass
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $patient = Patient::factory()->create();
    $response = $this->get(route($this->routeNames['edit'], $patient));
    $response->assertStatus(200);
});

it('can update a patient', function () {
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $patient = Patient::factory()->create();
    $updatedData = [
        'last_name' => 'Does',
        'gender' => 'female',
    ];

    $response = $this->put(route($this->routeNames['update'], $patient), $updatedData);
    $response->assertRedirect(route('patients.index'));
    $this->assertDatabaseHas('patients', $updatedData);
});

it('can delete a patient', function () {  // pass
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $patient = Patient::factory()->create();
    $response = $this->delete(route($this->routeNames['destroy'], $patient));
    $response->assertRedirect(route('patients.index'));
    $this->assertSoftDeleted('patients', ['id' => $patient->id]);
});

it('can restore a patient', function () {   // pass
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $patient = Patient::factory()->create();
    $patient->delete();

    $response = $this->post(route($this->routeNames['restore'], $patient->id));
    $response->assertRedirect(route('patients.trashed'));
    $this->assertDatabaseHas('patients', ['id' => $patient->id, 'deleted_at' => null]);
});

it('can restore all patients', function () {  // pass
    $this->withoutExceptionHandling();
    // Authenticate the request
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $trashedPatients = Patient::factory()->count(3)->create();
    Patient::destroy($trashedPatients->pluck('id'));

    $response = $this->post(route('patients.restoreAll.pest'));
    $response->assertRedirect(route('patients.index'));

    foreach ($trashedPatients as $patient) {
        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'deleted_at' => null]);
    }
});

it('validates patient registration', function () {  // pass
    $this->withoutExceptionHandling();
    $response = $this->post(route($this->routeNames['store']), []);

    $response->assertSessionHasErrors([
        'file_number', 'first_name', 'last_name', 'gender', 
        'date_of_birth', 'phone_number', 'next_of_kin_relationship', 'next_of_kin_phone_number'
    ]);
});
