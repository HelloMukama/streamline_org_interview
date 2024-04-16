<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'medical_record_id' => \App\Models\MedicalRecord::factory(),
            'drug_id' => \App\Models\Drug::factory(),
            'pharmacist_id' => \App\Models\User::factory(),
            'instructions' => $this->faker->sentence,
        ];
    }
}
