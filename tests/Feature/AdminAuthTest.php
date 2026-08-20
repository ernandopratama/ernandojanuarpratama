<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_successfully()
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password123'
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_failed_login_shows_error()
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'wrongpassword'
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_non_admin_cannot_login_to_admin_panel()
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_logout()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin);
        
        $response = $this->post('/admin/logout');
        
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    public function test_admin_can_access_dashboard_after_login()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin);
        
        $response = $this->get('/admin');
        
        $response->assertStatus(200);
    }
}
