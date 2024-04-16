<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_number' => $this->faker->unique()->numberBetween(100000, 999999),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date(),
            'phone_number' => $this->faker->phoneNumber,
            'next_of_kin_relationship' => $this->faker->randomElement(['parent', 'spouse', 'sibling', 'child', 'friend']),
            'next_of_kin_phone_number' => $this->faker->phoneNumber,
        ];
    }
}
