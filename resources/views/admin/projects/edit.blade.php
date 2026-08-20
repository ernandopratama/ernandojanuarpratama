@extends('admin.layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 03. PROJECT_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Edit Project</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Update this portfolio project entry.</p>
    </div>
</div>

@include('admin.projects._form', [
    'action' => route('admin.projects.update', $project),
    'method' => 'PATCH',
    'project' => $project,
    'skills' => $skills,
])
@endsection