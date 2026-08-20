<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'company' => 'Tech Corp',
                'position' => 'Senior Software Engineer',
                'start_date' => '2022-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => 'Leading the development of core infrastructure and user-facing applications. Architecting scalable solutions and mentoring junior developers.',
                'sort_order' => 1
            ],
            [
                'company' => 'Digital Agency',
                'position' => 'Software Developer',
                'start_date' => '2019-01-01',
                'end_date' => '2022-01-01',
                'is_current' => false,
                'description' => 'Built and maintained multiple client websites and web applications. Collaborated closely with design and product teams to deliver high-quality digital experiences.',
                'sort_order' => 2
            ],
            [
                'company' => 'Startup Inc',
                'position' => 'Junior Web Developer',
                'start_date' => '2018-01-01',
                'end_date' => '2019-01-01',
                'is_current' => false,
                'description' => 'Assisted in frontend development using React and modern CSS frameworks. Handled bug fixes and feature implementations under senior supervision.',
                'sort_order' => 3
            ]
        ];

        foreach ($experiences as $exp) {
            \App\Models\Experience::updateOrCreate(
                ['company' => $exp['company'], 'position' => $exp['position']],
                $exp
            );
        }
    }
}
