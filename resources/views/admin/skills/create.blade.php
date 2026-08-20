@extends('admin.layouts.app')

@section('title', 'Add Skill')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 04. SKILLS_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Add Skill</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Add a new technical proficiency.</p>
    </div>
</div>

@include('admin.skills._form', [
    'action' => route('admin.skills.store'),
    'method' => null,
    'skill' => $skill,
    'categories' => $categories,
])
@endsection