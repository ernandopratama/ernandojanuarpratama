@extends('admin.layouts.app')

@section('title', 'Edit Experience')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 02. EXPERIENCE_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Edit Experience</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Update this career timeline entry.</p>
    </div>
</div>

@include('admin.experiences._form', [
    'action' => route('admin.experiences.update', $experience),
    'method' => 'PATCH',
    'experience' => $experience,
])
@endsection