<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            ProfileSeeder::class,
            SkillSeeder::class,
            ExperienceSeeder::class,
            ProjectSeeder::class,
            EducationSeeder::class,
            SocialLinkSeeder::class,
            AdminSeeder::class,
        ]);
    }
}