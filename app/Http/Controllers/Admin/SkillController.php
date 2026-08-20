<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::withCount('projects')
            ->when(request('q'), function ($query, $search) {
                $query->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when(request('category'), fn ($query, $category) => $query->where('category', $category))
            ->orderBy('category')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        $categories = ['Frontend', 'Backend', 'Design', 'Tools & DevOps'];

        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create()
    {
        $categories = ['Frontend', 'Backend', 'Design', 'Tools & DevOps'];

        return view('admin.skills.create', ['skill' => new Skill(), 'categories' => $categories]);
    }

    public function store(SkillRequest $request)
    {
        Skill::create($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill)
    {
        $categories = ['Frontend', 'Backend', 'Design', 'Tools & DevOps'];

        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(SkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}