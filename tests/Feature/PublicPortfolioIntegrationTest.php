<?php

namespace Tests\Feature;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPortfolioIntegrationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_public_page_loads_with_empty_data(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_profile_update_reflects_on_public_page(): void
    {
        Profile::factory()->create(['headline' => 'Old Headline']);

        $this->actingAs($this->admin())->patch('/admin/profile', [
            'name' => 'Ernando Januar Pratama',
            'headline' => 'New Headline From Admin',
            'short_bio' => 'Fresh bio.',
        ])->assertRedirect('/admin/profile/edit');

        $this->get('/')->assertSee('New Headline From Admin')->assertDontSee('Old Headline');
    }

    public function test_new_experience_from_admin_appears_on_public_page(): void
    {
        $this->actingAs($this->admin())->post('/admin/experiences', [
            'company' => 'Tech Corp',
            'position' => 'Senior Software Engineer',
            'start_date' => '2022-01-01',
            'is_current' => 1,
        ])->assertRedirect('/admin/experiences');

        $this->get('/')->assertSee('Senior Software Engineer')->assertSee('Tech Corp');
    }

    public function test_published_project_appears_and_draft_does_not(): void
    {
        Project::factory()->create(['title' => 'Visible Project', 'status' => 'published']);
        Project::factory()->create(['title' => 'Hidden Draft', 'status' => 'draft']);

        $this->get('/')->assertSee('Visible Project')->assertDontSee('Hidden Draft');
    }

    public function test_visible_social_link_appears_and_hidden_disappears(): void
    {
        $visible = SocialLink::factory()->create(['platform' => 'LinkedIn', 'is_visible' => true]);
        $hidden = SocialLink::factory()->create(['platform' => 'Twitter / X', 'is_visible' => false]);

        $this->get('/')->assertSee('LinkedIn')->assertDontSee('Twitter / X');

        // Toggle from admin: hide the visible one, show the hidden one
        $this->actingAs($this->admin())->patch("/admin/social-links/{$visible->id}", [
            'platform' => $visible->platform,
            'url' => $visible->url,
            'is_visible' => 0,
        ])->assertRedirect('/admin/social-links');

        $this->actingAs($this->admin())->patch("/admin/social-links/{$hidden->id}", [
            'platform' => $hidden->platform,
            'url' => $hidden->url,
            'is_visible' => 1,
        ])->assertRedirect('/admin/social-links');

        $this->get('/')->assertDontSee('LinkedIn')->assertSee('Twitter / X');
    }

    public function test_education_and_skills_added_via_admin_appear_on_public_page(): void
    {
        $this->actingAs($this->admin())->post('/admin/educations', [
            'institution' => 'MIT',
            'degree' => 'Master of Science',
        ])->assertRedirect('/admin/educations');

        $this->actingAs($this->admin())->post('/admin/skills', [
            'name' => 'Laravel',
            'category' => 'Backend',
            'proficiency' => 85,
        ])->assertRedirect('/admin/skills');

        $this->get('/')->assertSee('MIT');
    }

    public function test_project_skills_synced_from_admin_show_as_tags_on_public_page(): void
    {
        $skill = Skill::factory()->create(['name' => 'Laravel']);
        $project = Project::factory()->create(['title' => 'Sync Project', 'status' => 'published']);

        $this->actingAs($this->admin())->patch("/admin/projects/{$project->id}", [
            'title' => $project->title,
            'slug' => $project->slug,
            'description' => $project->description,
            'status' => 'published',
            'skills' => [$skill->id],
        ])->assertRedirect('/admin/projects');

        $this->get('/')->assertSee('Sync Project')->assertSee('Laravel');
    }
}