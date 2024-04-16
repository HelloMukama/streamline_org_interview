<?php

namespace Database\Factories;

use App\Models\LabTest;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabTestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabTest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'duration' => $this->faker->randomNumber(2),
            'result' => $this->faker->sentence,
            'authenticated' => $this->faker->boolean,
            'senior_lab_technician_id' => \App\Models\User::factory(),
        ];
    }
}
