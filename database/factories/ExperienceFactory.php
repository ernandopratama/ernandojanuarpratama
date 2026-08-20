<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company' => fake()->company(),
            'position' => fake()->jobTitle(),
            'employment_type' => fake()->randomElement(['Full-time', 'Part-time', 'Contract', 'Freelance']),
            'location' => fake()->city(),
            'start_date' => fake()->date(),
            'end_date' => null,
            'is_current' => true,
            'description' => fake()->paragraph(),
            'sort_order' => 0,
        ];
    }
}