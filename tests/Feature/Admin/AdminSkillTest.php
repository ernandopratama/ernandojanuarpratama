<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSkillTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_create_skill(): void
    {
        $this->actingAs($this->admin())->post('/admin/skills', [
            'name' => 'Laravel',
            'category' => 'Backend',
            'icon' => 'terminal',
            'proficiency' => 85,
            'sort_order' => 0,
        ])->assertRedirect('/admin/skills')
            ->assertSessionHas('success', 'Skill created successfully.');

        $this->assertDatabaseHas('skills', [
            'name' => 'Laravel',
            'category' => 'Backend',
            'proficiency' => 85,
        ]);
    }

    public function test_admin_can_update_skill(): void
    {
        $skill = Skill::factory()->create();

        $this->actingAs($this->admin())->patch("/admin/skills/{$skill->id}", [
            'name' => 'Laravel Updated',
            'category' => 'Frontend',
            'proficiency' => 90,
        ])->assertRedirect('/admin/skills');

        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'name' => 'Laravel Updated',
            'category' => 'Frontend',
            'proficiency' => 90,
        ]);
    }

    public function test_admin_can_delete_skill_and_pivot_is_cleaned(): void
    {
        $skill = Skill::factory()->create();
        $project = Project::factory()->create();
        $project->skills()->attach($skill->id);

        $this->assertDatabaseHas('project_skill', ['skill_id' => $skill->id]);

        $this->actingAs($this->admin())->delete("/admin/skills/{$skill->id}")
            ->assertRedirect('/admin/skills')
            ->assertSessionHas('success', 'Skill deleted successfully.');

        $this->assertDatabaseMissing('skills', ['id' => $skill->id]);
        $this->assertDatabaseMissing('project_skill', ['skill_id' => $skill->id]);
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    public function test_skill_validation_rejects_unknown_category_and_invalid_proficiency(): void
    {
        $this->actingAs($this->admin())->post('/admin/skills', [
            'name' => 'X',
            'category' => 'Unknown',
            'proficiency' => 150,
        ])->assertSessionHasErrors(['category', 'proficiency']);
    }

    public function test_skill_list_supports_search_and_category_filter(): void
    {
        Skill::factory()->create(['name' => 'Laravel', 'category' => 'Backend']);
        Skill::factory()->create(['name' => 'Vue.js', 'category' => 'Frontend']);

        $admin = $this->admin();

        $this->actingAs($admin)->get('/admin/skills?q=laravel')
            ->assertOk()
            ->assertSee('Laravel')
            ->assertDontSee('Vue.js');

        $this->actingAs($admin)->get('/admin/skills?category=Frontend')
            ->assertOk()
            ->assertSee('Vue.js')
            ->assertDontSee('Laravel');
    }
}