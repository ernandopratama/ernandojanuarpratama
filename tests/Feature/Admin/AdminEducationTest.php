<?php

namespace Tests\Feature\Admin;

use App\Models\Education;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEducationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_create_education(): void
    {
        $this->actingAs($this->admin())->post('/admin/educations', [
            'institution' => 'MIT',
            'degree' => 'Master of Science',
            'field' => 'Computer Science',
            'location' => 'Cambridge, MA',
            'start_date' => '2018-09-01',
            'end_date' => '2020-05-01',
            'description' => 'Focus on systems.',
            'sort_order' => 1,
        ])->assertRedirect('/admin/educations')
            ->assertSessionHas('success', 'Education created successfully.');

        $this->assertDatabaseHas('educations', [
            'institution' => 'MIT',
            'degree' => 'Master of Science',
        ]);
    }

    public function test_admin_can_update_education(): void
    {
        $education = Education::factory()->create();

        $this->actingAs($this->admin())->patch("/admin/educations/{$education->id}", [
            'institution' => 'Stanford',
            'degree' => 'Bachelor of Science',
        ])->assertRedirect('/admin/educations')
            ->assertSessionHas('success', 'Education updated successfully.');

        $this->assertDatabaseHas('educations', [
            'id' => $education->id,
            'institution' => 'Stanford',
            'degree' => 'Bachelor of Science',
        ]);
    }

    public function test_admin_can_delete_education(): void
    {
        $education = Education::factory()->create();

        $this->actingAs($this->admin())->delete("/admin/educations/{$education->id}")
            ->assertRedirect('/admin/educations');

        $this->assertDatabaseMissing('educations', ['id' => $education->id]);
    }

    public function test_education_validation_requires_institution_and_degree(): void
    {
        $this->actingAs($this->admin())->post('/admin/educations', [])
            ->assertSessionHasErrors(['institution', 'degree']);
    }

    public function test_end_date_before_start_date_is_rejected(): void
    {
        $this->actingAs($this->admin())->post('/admin/educations', [
            'institution' => 'MIT',
            'degree' => 'BSc',
            'start_date' => '2022-01-01',
            'end_date' => '2021-01-01',
        ])->assertSessionHasErrors('end_date');
    }
}