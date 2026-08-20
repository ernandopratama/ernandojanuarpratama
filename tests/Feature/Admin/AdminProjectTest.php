<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProjectTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function validProjectData(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Enterprise Dashboard',
            'description' => 'A comprehensive analytics dashboard.',
            'status' => 'published',
            'featured' => 1,
            'year' => '2026',
            'sort_order' => 1,
        ], $overrides);
    }

    public function test_admin_can_create_project_with_auto_slug_and_skill_sync(): void
    {
        $skillA = Skill::factory()->create();
        $skillB = Skill::factory()->create();

        $this->actingAs($this->admin())->post('/admin/projects', $this->validProjectData([
            'slug' => '',
            'skills' => [$skillA->id, $skillB->id],
        ]))->assertRedirect('/admin/projects')
            ->assertSessionHas('success', 'Project created successfully.');

        $project = Project::where('slug', 'enterprise-dashboard')->first();
        $this->assertNotNull($project);
        $this->assertSame([$skillA->id, $skillB->id], $project->skills()->pluck('skills.id')->sort()->values()->all());
        $this->assertDatabaseHas('project_skill', ['project_id' => $project->id, 'skill_id' => $skillA->id]);
    }

    public function test_generated_slugs_stay_unique(): void
    {
        Project::factory()->create(['title' => 'Same Title', 'slug' => 'same-title']);

        $this->actingAs($this->admin())->post('/admin/projects', $this->validProjectData([
            'title' => 'Same Title',
            'slug' => '',
        ]))->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', ['slug' => 'same-title-2']);
    }

    public function test_provided_slug_is_respected(): void
    {
        $this->actingAs($this->admin())->post('/admin/projects', $this->validProjectData([
            'slug' => 'custom-slug',
        ]))->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', ['slug' => 'custom-slug']);
    }

    public function test_admin_can_update_project_and_sync_skills_replace_old(): void
    {
        $skillA = Skill::factory()->create();
        $skillB = Skill::factory()->create();
        $project = Project::factory()->create();
        $project->skills()->attach($skillA->id);

        $this->actingAs($this->admin())->patch("/admin/projects/{$project->id}", $this->validProjectData([
            'title' => 'Updated Title',
            'slug' => $project->slug,
            'skills' => [$skillB->id],
        ]))->assertRedirect('/admin/projects')
            ->assertSessionHas('success', 'Project updated successfully.');

        $this->assertDatabaseMissing('project_skill', ['project_id' => $project->id, 'skill_id' => $skillA->id]);
        $this->assertDatabaseHas('project_skill', ['project_id' => $project->id, 'skill_id' => $skillB->id]);
    }

    public function test_updating_project_without_skills_clears_pivot(): void
    {
        $skill = Skill::factory()->create();
        $project = Project::factory()->create();
        $project->skills()->attach($skill->id);

        $this->actingAs($this->admin())->patch("/admin/projects/{$project->id}", $this->validProjectData([
            'slug' => $project->slug,
            'skills' => [],
        ]))->assertRedirect('/admin/projects');

        $this->assertDatabaseMissing('project_skill', ['project_id' => $project->id]);
    }

    public function test_admin_can_delete_project(): void
    {
        Storage::fake('public');
        $project = Project::factory()->create();

        $this->actingAs($this->admin())->delete("/admin/projects/{$project->id}")
            ->assertRedirect('/admin/projects')
            ->assertSessionHas('success', 'Project deleted successfully.');

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_project_thumbnail_upload_and_replacement(): void
    {
        Storage::fake('public');

        $project = Project::factory()->create();

        $this->actingAs($this->admin())->patch("/admin/projects/{$project->id}", $this->validProjectData([
            'slug' => $project->slug,
            'thumbnail' => UploadedFile::fake()->image('thumb.jpg', 300, 200),
        ]))->assertRedirect('/admin/projects');

        $firstThumbnail = $project->fresh()->thumbnail;
        $this->assertNotNull($firstThumbnail);
        Storage::disk('public')->assertExists($firstThumbnail);

        $this->actingAs($this->admin())->patch("/admin/projects/{$project->id}", $this->validProjectData([
            'slug' => $project->slug,
            'thumbnail' => UploadedFile::fake()->image('thumb2.jpg', 300, 200),
        ]))->assertRedirect('/admin/projects');

        $this->assertNotSame($firstThumbnail, $project->fresh()->thumbnail);
        Storage::disk('public')->assertExists($project->fresh()->thumbnail);
        Storage::disk('public')->assertMissing($firstThumbnail);
    }

    public function test_deleting_project_removes_its_thumbnail(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())->post('/admin/projects', $this->validProjectData([
            'thumbnail' => UploadedFile::fake()->image('cover.jpg', 300, 200),
        ]))->assertRedirect('/admin/projects');

        $project = Project::where('slug', 'enterprise-dashboard')->first();
        Storage::disk('public')->assertExists($project->thumbnail);

        $this->actingAs($this->admin())->delete("/admin/projects/{$project->id}")->assertRedirect('/admin/projects');

        Storage::disk('public')->assertMissing($project->thumbnail);
    }

    public function test_invalid_thumbnail_file_is_rejected(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())->post('/admin/projects', $this->validProjectData([
            'thumbnail' => UploadedFile::fake()->create('document.pdf', 100),
        ]))->assertSessionHasErrors('thumbnail');
    }

    public function test_project_validation_requires_title_description_and_valid_status(): void
    {
        $this->actingAs($this->admin())->post('/admin/projects', [])
            ->assertSessionHasErrors(['title', 'description', 'status']);
    }

    public function test_invalid_skill_id_is_rejected(): void
    {
        $this->actingAs($this->admin())->post('/admin/projects', $this->validProjectData([
            'skills' => [999],
        ]))->assertSessionHasErrors('skills.0');
    }
}