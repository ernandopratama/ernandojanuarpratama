<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExperienceRequest;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create', ['experience' => new Experience()]);
    }

    public function store(ExperienceRequest $request)
    {
        $data = $request->validated();

        if ($request->boolean('is_current')) {
            $data['end_date'] = null;
        }

        Experience::create($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        $data = $request->validated();

        if ($request->boolean('is_current')) {
            $data['end_date'] = null;
        }

        $experience->update($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully.');
    }
}