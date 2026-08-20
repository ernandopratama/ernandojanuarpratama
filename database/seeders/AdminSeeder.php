<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $name     = env('ADMIN_NAME', 'Admin');
        $email    = env('ADMIN_EMAIL', 'admin@example.com');
        $password = env('ADMIN_PASSWORD', 'change-me-in-env');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => $name,
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );
    }
}