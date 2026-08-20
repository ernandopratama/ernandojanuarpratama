<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Education::updateOrCreate(
            ['institution' => 'University of Technology', 'degree' => 'Bachelor of Science'],
            [
                'field' => 'Computer Science',
                'start_date' => '2014-08-01',
                'end_date' => '2018-05-01',
                'description' => 'Graduated with honors. Focused on software engineering and systems architecture.',
                'sort_order' => 1
            ]
        );
    }
}
