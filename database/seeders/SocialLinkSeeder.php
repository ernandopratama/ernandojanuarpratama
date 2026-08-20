<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/', 'sort_order' => 1],
            ['platform' => 'GitHub', 'url' => 'https://github.com/', 'sort_order' => 2],
            ['platform' => 'Layers', 'url' => 'https://layers.to/', 'sort_order' => 3],
            ['platform' => 'Email', 'url' => 'mailto:hello@example.com', 'sort_order' => 4],
        ];

        foreach ($links as $link) {
            \App\Models\SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                $link
            );
        }
    }
}
