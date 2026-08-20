<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'headline' => fake()->sentence(6),
            'short_bio' => fake()->paragraph(),
            'about' => fake()->paragraphs(2, true),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'location' => fake()->city(),
            'availability' => 'Available for Opportunities',
            'profile_image' => null,
            'cv_file' => null,
        ];
    }
}