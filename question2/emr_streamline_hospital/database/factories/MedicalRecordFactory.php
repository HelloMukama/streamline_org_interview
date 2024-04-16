<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => \App\Models\Patient::factory(),
            'staff_id' => \App\Models\User::factory(),
            'symptoms' => $this->faker->paragraph,
            'lab_test_id' => \App\Models\LabTest::factory(),
            'medical_diagnosis_id' => \App\Models\MedicalDiagnosis::factory(),
            'treatment' => $this->faker->sentence,
            'outcome' => $this->faker->randomElement(['admitted', 'died', 'referred', 'discharged']),
        ];
    }
}
