<?php

namespace Tests\Feature\Admin;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminExperienceTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_create_experience(): void
    {
        $this->actingAs($this->admin())->post('/admin/experiences', [
            'company' => 'Tech Corp',
            'position' => 'Senior Software Engineer',
            'employment_type' => 'Full-time',
            'location' => 'Remote',
            'start_date' => '2022-01-01',
            'end_date' => '2024-01-01',
            'is_current' => 0,
            'description' => 'Leading core infrastructure.',
            'sort_order' => 1,
        ])->assertRedirect('/admin/experiences')
            ->assertSessionHas('success', 'Experience created successfully.');

        $this->assertDatabaseHas('experiences', [
            'company' => 'Tech Corp',
            'position' => 'Senior Software Engineer',
        ]);
    }

    public function test_admin_can_update_experience(): void
    {
        $experience = Experience::factory()->create();

        $this->actingAs($this->admin())->patch("/admin/experiences/{$experience->id}", [
            'company' => 'Updated Corp',
            'position' => 'CTO',
            'start_date' => '2020-06-01',
            'end_date' => null,
            'is_current' => 0,
        ])->assertRedirect('/admin/experiences')
            ->assertSessionHas('success', 'Experience updated successfully.');

        $this->assertDatabaseHas('experiences', [
            'id' => $experience->id,
            'company' => 'Updated Corp',
            'position' => 'CTO',
        ]);
    }

    public function test_admin_can_delete_experience(): void
    {
        $experience = Experience::factory()->create();

        $this->actingAs($this->admin())->delete("/admin/experiences/{$experience->id}")
            ->assertRedirect('/admin/experiences')
            ->assertSessionHas('success', 'Experience deleted successfully.');

        $this->assertDatabaseMissing('experiences', ['id' => $experience->id]);
    }

    public function test_experience_validation_requires_company_position_and_start_date(): void
    {
        $this->actingAs($this->admin())->post('/admin/experiences', [])
            ->assertSessionHasErrors(['company', 'position', 'start_date']);
    }

    public function test_current_position_clears_end_date(): void
    {
        $this->actingAs($this->admin())->post('/admin/experiences', [
            'company' => 'Startup Inc',
            'position' => 'Developer',
            'start_date' => '2018-01-01',
            'end_date' => '2025-01-01',
            'is_current' => 1,
        ]);

        $this->assertDatabaseHas('experiences', [
            'company' => 'Startup Inc',
            'end_date' => null,
            'is_current' => true,
        ]);
    }

    public function test_end_date_before_start_date_is_rejected(): void
    {
        $this->actingAs($this->admin())->post('/admin/experiences', [
            'company' => 'Corp',
            'position' => 'Dev',
            'start_date' => '2024-01-01',
            'end_date' => '2023-01-01',
            'is_current' => 0,
        ])->assertSessionHasErrors('end_date');
    }
}