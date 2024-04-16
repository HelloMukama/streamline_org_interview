<?php

namespace Database\Factories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrugFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drug::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'brand_name' => $this->faker->word,
            'form' => $this->faker->randomElement(['tablet', 'capsule', 'syrup', 'injection']),
            'code' => $this->faker->unique()->word,
        ];
    }
}
