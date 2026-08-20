<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('skills')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $project = new Project();
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get()->groupBy('category');

        return view('admin.projects.create', compact('project', 'skills'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data['slug'] ?? '', $data['title']);
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project = Project::create($data);
        $project->skills()->sync($request->input('skills', []));

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get()->groupBy('category');

        return view('admin.projects.edit', compact('project', 'skills'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data['slug'] ?? '', $data['title'], $project->id);
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('projects', 'public');

            if ($project->thumbnail && $project->thumbnail !== $path) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $data['thumbnail'] = $path;
        }

        $project->update($data);
        $project->skills()->sync($request->input('skills', []));

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    private function resolveSlug(string $slug, string $title, ?int $ignoreId = null): string
    {
        $base = $slug !== '' ? Str::slug($slug) : Str::slug($title);
        $slug = $base;
        $counter = 2;

        while (Project::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}