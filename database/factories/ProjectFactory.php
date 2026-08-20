<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraph(),
            'thumbnail' => null,
            'project_url' => fake()->url(),
            'github_url' => fake()->url(),
            'year' => (string) fake()->year(),
            'status' => 'draft',
            'featured' => false,
            'sort_order' => 0,
        ];
    }
}