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
            'stagiaire_id' => random_int(1, 10),
            'classe_id' => 1,
            'date' => fake()->dateTimeBetween("this week Monday", "now"),
            'isPresence' => fake()->boolean(),
            'preuve' => fake()->randomElement(['rien', 'medicale']),
        ];
    }
}