<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'category' => fake()->randomElement(['Frontend', 'Backend', 'Design', 'Tools & DevOps']),
            'icon' => null,
            'proficiency' => fake()->numberBetween(40, 98),
            'sort_order' => 0,
        ];
    }
}