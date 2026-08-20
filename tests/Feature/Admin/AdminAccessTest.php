<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_unauthenticated_user_cannot_access_crud_route(): void
    {
        $this->get('/admin/skills')->assertRedirect('/admin/login');
    }

    public function test_non_admin_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($user)->get('/admin/projects')->assertForbidden();
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    public function test_admin_can_access_all_admin_index_pages(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $routes = [
            '/admin',
            '/admin/profile/edit',
            '/admin/experiences',
            '/admin/projects',
            '/admin/skills',
            '/admin/educations',
            '/admin/social-links',
        ];

        foreach ($routes as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }
}