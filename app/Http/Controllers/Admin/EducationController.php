<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationRequest;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('sort_order')
            ->orderByDesc('end_date')
            ->paginate(10);

        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.create', ['education' => new Education()]);
    }

    public function store(EducationRequest $request)
    {
        Education::create($request->validated());

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Education created successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(EducationRequest $request, Education $education)
    {
        $education->update($request->validated());

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Education deleted successfully.');
    }
}