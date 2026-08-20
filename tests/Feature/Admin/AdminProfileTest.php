<?php

namespace Tests\Feature\Admin;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_create_initial_profile(): void
    {
        $this->actingAs($this->admin())->patch('/admin/profile', [
            'name' => 'Ernando Januar Pratama',
            'headline' => 'Building Digital Experiences.',
            'short_bio' => 'Short bio text.',
            'email' => 'hello@example.com',
            'location' => 'Indonesia',
        ])->assertRedirect('/admin/profile/edit')
            ->assertSessionHas('success', 'Profile updated successfully.');

        $this->assertDatabaseHas('profiles', [
            'name' => 'Ernando Januar Pratama',
            'headline' => 'Building Digital Experiences.',
        ]);
    }

    public function test_admin_can_update_existing_profile_without_duplicates(): void
    {
        Profile::factory()->create(['name' => 'Original Name']);

        $this->actingAs($this->admin())->patch('/admin/profile', [
            'name' => 'Updated Name',
            'headline' => 'New headline.',
            'short_bio' => 'Updated bio.',
        ])->assertRedirect('/admin/profile/edit');

        $this->assertDatabaseHas('profiles', ['name' => 'Updated Name']);
        $this->assertSame(1, Profile::count());
    }

    public function test_profile_requires_required_fields(): void
    {
        $this->actingAs($this->admin())->patch('/admin/profile', [])
            ->assertSessionHasErrors(['name', 'headline', 'short_bio']);
    }

    public function test_admin_can_upload_profile_image(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin())->patch('/admin/profile', [
            'name' => 'Ernando',
            'headline' => 'Headline',
            'short_bio' => 'Bio',
            'profile_image' => UploadedFile::fake()->image('avatar.jpg', 100, 100),
        ]);

        $response->assertRedirect('/admin/profile/edit');

        $profile = Profile::first();
        $this->assertNotNull($profile->profile_image);
        Storage::disk('public')->assertExists($profile->profile_image);
    }

    public function test_invalid_profile_image_is_rejected(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())->patch('/admin/profile', [
            'name' => 'Ernando',
            'headline' => 'Headline',
            'short_bio' => 'Bio',
            'profile_image' => UploadedFile::fake()->create('document.pdf', 100),
        ])->assertSessionHasErrors('profile_image');
    }
}