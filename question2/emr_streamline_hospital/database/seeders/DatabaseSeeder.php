<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create user "John Doe"
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'role' => 'administrator',
            'password' => Hash::make('12345678'),
        ]);

        // Use factories for other models
        \App\Models\Patient::factory(8)->create();
        \App\Models\MedicalRecord::factory(8)->create();
        \App\Models\LabTest::factory(10)->create();
        \App\Models\MedicalDiagnosis::factory(8)->create();
        \App\Models\Drug::factory(8)->create();
        \App\Models\Prescription::factory(8)->create();
        \App\Models\Appointment::factory(8)->create();
        \App\Models\Clinic::factory(8)->create();
        // \App\Models\AuditLog::factory(8)->create();
    }
}
