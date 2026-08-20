<?php

namespace Tests\Feature\Admin;

use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSocialLinkTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_create_visible_social_link(): void
    {
        $this->actingAs($this->admin())->post('/admin/social-links', [
            'platform' => 'LinkedIn',
            'url' => 'https://linkedin.com/in/ejdesign',
            'icon' => 'link',
            'sort_order' => 0,
            'is_visible' => 1,
        ])->assertRedirect('/admin/social-links')
            ->assertSessionHas('success', 'Social link created successfully.');

        $this->assertDatabaseHas('social_links', [
            'platform' => 'LinkedIn',
            'url' => 'https://linkedin.com/in/ejdesign',
            'is_visible' => true,
        ]);
    }

    public function test_admin_can_toggle_social_link_hidden(): void
    {
        $link = SocialLink::factory()->create(['is_visible' => true]);

        $this->actingAs($this->admin())->patch("/admin/social-links/{$link->id}", [
            'platform' => $link->platform,
            'url' => $link->url,
            'is_visible' => 0,
        ])->assertRedirect('/admin/social-links');

        $this->assertDatabaseHas('social_links', [
            'id' => $link->id,
            'is_visible' => false,
        ]);
    }

    public function test_admin_can_update_social_link(): void
    {
        $link = SocialLink::factory()->create();

        $this->actingAs($this->admin())->patch("/admin/social-links/{$link->id}", [
            'platform' => 'GitHub',
            'url' => 'https://github.com/ej-dev',
            'is_visible' => 1,
        ])->assertRedirect('/admin/social-links')
            ->assertSessionHas('success', 'Social link updated successfully.');

        $this->assertDatabaseHas('social_links', [
            'id' => $link->id,
            'platform' => 'GitHub',
            'url' => 'https://github.com/ej-dev',
        ]);
    }

    public function test_admin_can_delete_social_link(): void
    {
        $link = SocialLink::factory()->create();

        $this->actingAs($this->admin())->delete("/admin/social-links/{$link->id}")
            ->assertRedirect('/admin/social-links')
            ->assertSessionHas('success', 'Social link deleted successfully.');

        $this->assertDatabaseMissing('social_links', ['id' => $link->id]);
    }

    public function test_social_link_requires_platform_and_valid_url(): void
    {
        $this->actingAs($this->admin())->post('/admin/social-links', [
            'platform' => '',
            'url' => 'not-a-url',
        ])->assertSessionHasErrors(['platform', 'url']);
    }
}