<?php

namespace Database\Factories;

use App\Models\MedicalDiagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalDiagnosisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalDiagnosis::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'icd_11_code' => $this->faker->unique()->word,
            'is_primary_diagnosis' => $this->faker->boolean,
        ];
    }
}
