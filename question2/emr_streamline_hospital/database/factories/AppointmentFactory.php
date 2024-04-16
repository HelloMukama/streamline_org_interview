<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => \App\Models\Patient::factory(),
            'clinic_id' => \App\Models\Clinic::factory(),
            'staff_id' => \App\Models\User::factory(),
            'clinical_notes' => $this->faker->sentence,
            'date_and_time' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['postponed', 'brought_forward', 'canceled', 'started', 'completed']),
        ];
    }
}
