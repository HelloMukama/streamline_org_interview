<?php

namespace Database\Factories;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AuditLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'action' => $this->faker->randomElement(['created', 'modified', 'deleted']),
            'table_name' => $this->faker->randomElement(['patients', 'medical_records', 'lab_tests', 'medical_diagnoses', 'drugs', 'prescriptions', 'appointments', 'clinics', 'users', 'audit_logs']),
            'record_id' => $this->faker->randomNumber(),
        ];
    }
}
