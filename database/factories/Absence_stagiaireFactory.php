<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence_stagiaire>
 */
class Absence_stagiaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'absence_id' => random_int(1 , 60),
            'stagiaire_id' => random_int(1 , 60),
            'preuve' => fake()->text(12),
        ];
    }
}
