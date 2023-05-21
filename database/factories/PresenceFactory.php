<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stagiaire_id' => random_int(1, 50),
            'classe_id' => random_int(1, 7),
            'date' => fake()->date("Y-m-d"),
            'isPresence' => fake()->boolean(),
            'preuve' => fake()->randomElement(["rien", "medicale"]),
        ];
    }
}