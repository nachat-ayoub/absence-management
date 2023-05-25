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
            'seance' => fake()->randomElement(['8:30 11:00', '11:00 13:20', '13:30 16:00', '16:00 18:30', '8:30 13:20', '13:30 18:30']),
            'isPresence' => fake()->boolean(),
            'preuve' => fake()->randomElement(['rien', 'medicale']),
        ];
    }
}