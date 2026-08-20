@extends('admin.layouts.app')

@section('title', 'Add Project')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 03. PROJECT_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Add Project</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Create a new portfolio project entry.</p>
    </div>
</div>

@include('admin.projects._form', [
    'action' => route('admin.projects.store'),
    'method' => null,
    'project' => $project,
    'skills' => $skills,
])
@endsection