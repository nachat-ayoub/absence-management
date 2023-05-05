<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => fake()->dateTimeBetween($startDate = '-2 years' , $endDate = 'now')->format('Y-m-d'),
            'classe_id' => random_int(1,6),
            'formateur_id' => random_int(1,5),
        ];
    }
}
