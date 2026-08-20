<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Enterprise Dashboard',
                'slug' => 'enterprise-dashboard',
                'description' => 'A comprehensive analytics dashboard processing real-time data for enterprise clients. Architected with performance and security in mind, utilizing advanced data visualization techniques.',
                'status' => 'published',
                'featured' => true,
                'sort_order' => 1,
                'skills' => ['React', 'Node.js', 'D3.js']
            ],
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'description' => 'A fully custom headless e-commerce solution with integrated payment gateways. Scalable backend architecture to handle high traffic and complex catalog requirements.',
                'status' => 'published',
                'featured' => true,
                'sort_order' => 2,
                'skills' => ['Vue', 'Stripe', 'GraphQL']
            ]
        ];

        foreach ($projects as $projectData) {
            $skills = $projectData['skills'];
            unset($projectData['skills']);

            $project = \App\Models\Project::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );

            $skillIds = \App\Models\Skill::whereIn('name', $skills)->pluck('id');
            $project->skills()->sync($skillIds);
        }
    }
}
