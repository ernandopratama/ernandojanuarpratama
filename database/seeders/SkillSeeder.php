<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'Node.js', 'category' => 'Backend', 'proficiency' => 88],
            ['name' => 'Python', 'category' => 'Backend', 'proficiency' => 82],
            ['name' => 'PostgreSQL', 'category' => 'Backend', 'proficiency' => 85],
            ['name' => 'Redis', 'category' => 'Backend', 'proficiency' => 75],
            ['name' => 'Docker', 'category' => 'Backend', 'proficiency' => 78],
            ['name' => 'React', 'category' => 'Frontend', 'proficiency' => 90],
            ['name' => 'Vue', 'category' => 'Frontend', 'proficiency' => 90],
            ['name' => 'TypeScript', 'category' => 'Frontend', 'proficiency' => 86],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 92],
            ['name' => 'WebGL', 'category' => 'Frontend', 'proficiency' => 70],
            ['name' => 'Figma', 'category' => 'Design', 'proficiency' => 85],
            ['name' => 'UI/UX Systems', 'category' => 'Design', 'proficiency' => 84],
            ['name' => 'Prototyping', 'category' => 'Design', 'proficiency' => 88],
            ['name' => 'Wireframing', 'category' => 'Design', 'proficiency' => 86],
            ['name' => 'AWS', 'category' => 'Cloud', 'proficiency' => 80],
            ['name' => 'GCP', 'category' => 'Cloud', 'proficiency' => 72],
            ['name' => 'CI/CD Pipelines', 'category' => 'Cloud', 'proficiency' => 83],
            ['name' => 'Serverless', 'category' => 'Cloud', 'proficiency' => 76],
            ['name' => 'D3.js', 'category' => 'Frontend', 'proficiency' => 74],
            ['name' => 'Stripe', 'category' => 'Tools', 'proficiency' => 68],
            ['name' => 'GraphQL', 'category' => 'Backend', 'proficiency' => 79],
        ];

        foreach ($skills as $index => $skill) {
            \App\Models\Skill::updateOrCreate(
                ['name' => $skill['name']],
                [
                    'category' => $skill['category'],
                    'proficiency' => $skill['proficiency'],
                    'sort_order' => $index,
                ]
            );
        }
    }
}