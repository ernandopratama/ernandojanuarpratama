<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialLink>
 */
class SocialLinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'platform' => fake()->randomElement(['LinkedIn', 'GitHub', 'Twitter / X', 'Instagram']),
            'url' => fake()->url(),
            'icon' => null,
            'sort_order' => 0,
            'is_visible' => true,
        ];
    }
}