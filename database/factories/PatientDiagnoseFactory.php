<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientDiagnose>
 */
class PatientDiagnoseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => \App\Models\Patient::factory(),
            'diagnose_id' => \App\Models\Diagnose::factory(),
            'observation' => $this->faker->optional()->sentence,
            'creation' => $this->faker->date(),
        ];
    }
}
