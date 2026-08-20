<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Profile::updateOrCreate(['id' => 1], [
            'name' => 'Ernando Januar Pratama',
            'headline' => 'Building Digital Experiences That Solve Real Problems.',
            'short_bio' => "I'm Ernando Januar Pratama, an IT professional and software developer focused on building reliable digital products, web applications, and technology solutions.",
            'about' => "With over 5 years of experience in software development, I specialize in creating scalable web applications and seamless digital experiences. My approach combines technical precision with an eye for design architecture.\n\nI believe in writing clean, maintainable code and building systems that stand the test of time while remaining adaptable to future needs.",
            'email' => 'hello@example.com',
            'location' => 'Indonesia',
            'availability' => 'Available for Opportunities'
        ]);
    }
}
