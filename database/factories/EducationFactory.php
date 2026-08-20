<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'institution' => fake()->company(),
            'degree' => fake()->randomElement(['Bachelor of Science', 'Master of Science', 'Bachelor of Arts']),
            'field' => fake()->word(),
            'location' => fake()->city(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'description' => fake()->paragraph(),
            'sort_order' => 0,
        ];
    }
}