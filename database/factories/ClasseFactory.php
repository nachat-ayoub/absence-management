<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classe>
 */
class ClasseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'branche' => fake()->unique()->text(5),
            'num_group' => random_int(100, 110),
            'annee_scolaire' => "2022-2023",
            'admin_id' => 1,
        ];
    }
}