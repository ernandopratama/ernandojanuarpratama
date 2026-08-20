@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 00. SYSTEM_OVERVIEW</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Admin Console</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Overview of your portfolio content. All changes reflect immediately on the public landing page.</p>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-12">
    <div class="bg-surface-container border border-outline-variant/20 rounded-lg p-6">
        <p class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-2">Projects</p>
        <p class="font-display-lg text-4xl font-bold text-on-background">{{ $stats['projects'] }}</p>
        <p class="font-meta-technical text-[12px] text-on-surface-variant mt-1">{{ $stats['publishedProjects'] }} Published / {{ $stats['draftProjects'] }} Draft</p>
    </div>
    <div class="bg-surface-container border border-outline-variant/20 rounded-lg p-6">
        <p class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-2">Experiences</p>
        <p class="font-display-lg text-4xl font-bold text-on-background">{{ $stats['experiences'] }}</p>
        <p class="font-meta-technical text-[12px] text-on-surface-variant mt-1">Career timeline entries</p>
    </div>
    <div class="bg-surface-container border border-outline-variant/20 rounded-lg p-6">
        <p class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-2">Skills</p>
        <p class="font-display-lg text-4xl font-bold text-on-background">{{ $stats['skills'] }}</p>
        <p class="font-meta-technical text-[12px] text-on-surface-variant mt-1">Technical proficiencies</p>
    </div>
    <div class="bg-surface-container border border-outline-variant/20 rounded-lg p-6">
        <p class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-2">Education + Social</p>
        <p class="font-display-lg text-4xl font-bold text-on-background">{{ $stats['educations'] + $stats['socialLinks'] }}</p>
        <p class="font-meta-technical text-[12px] text-on-surface-variant mt-1">{{ $stats['educations'] }} Education / {{ $stats['socialLinks'] }} Links</p>
    </div>
</div>

{{-- Quick actions --}}
<div class="flex flex-col sm:flex-row gap-4 mb-12">
    <a href="{{ route('admin.projects.create') }}" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-6 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">add_box</span>
        Add Project
    </a>
    <a href="{{ route('admin.experiences.create') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-6 py-3 rounded font-label-caps text-label-caps uppercase transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">timeline</span>
        Add Experience
    </a>
    <a href="{{ route('admin.profile.edit') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-6 py-3 rounded font-label-caps text-label-caps uppercase transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">person</span>
        Edit Profile
    </a>
</div>

{{-- Recent panels --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-surface-container border border-outline-variant/20 rounded-lg overflow-hidden">
        <div class="p-5 border-b border-outline-variant/20 flex items-center justify-between">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant">Recent Projects</h2>
            <a href="{{ route('admin.projects.index') }}" class="font-meta-technical text-[12px] text-secondary hover:underline">View all</a>
        </div>
        @forelse($recentProjects as $project)
        <div class="flex items-center justify-between p-4 border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors group">
            <div>
                <p class="font-body-md text-body-md text-on-background">{{ $project->title }}</p>
                <p class="font-meta-technical text-[12px] text-on-surface-variant mt-0.5">{{ $project->year ?? '—' }}</p>
            </div>
            <div class="flex items-center gap-3">
                @include('admin.components.status-badge', ['status' => $project->status])
                <a href="{{ route('admin.projects.edit', $project) }}" class="text-on-surface-variant hover:text-primary transition-colors p-1 opacity-0 group-hover:opacity-100">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                </a>
            </div>
        </div>
        @empty
        <div class="p-6 font-meta-technical text-meta-technical text-on-surface-variant">No projects yet.</div>
        @endforelse
    </div>

    <div class="bg-surface-container border border-outline-variant/20 rounded-lg overflow-hidden">
        <div class="p-5 border-b border-outline-variant/20 flex items-center justify-between">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant">Recent Experiences</h2>
            <a href="{{ route('admin.experiences.index') }}" class="font-meta-technical text-[12px] text-secondary hover:underline">View all</a>
        </div>
        @forelse($recentExperiences as $experience)
        <div class="flex items-center justify-between p-4 border-b border-outline-variant/10 hover:bg-surface-container-high transition-colors group">
            <div>
                <p class="font-body-md text-body-md text-on-background">{{ $experience->position }}</p>
                <p class="font-meta-technical text-[12px] text-on-surface-variant mt-0.5">{{ $experience->company }} · {{ $experience->start_date?->format('M Y') }} — {{ $experience->is_current ? 'Present' : $experience->end_date?->format('M Y') }}</p>
            </div>
            <a href="{{ route('admin.experiences.edit', $experience) }}" class="text-on-surface-variant hover:text-primary transition-colors p-1 opacity-0 group-hover:opacity-100">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </a>
        </div>
        @empty
        <div class="p-6 font-meta-technical text-meta-technical text-on-surface-variant">No experiences yet.</div>
        @endforelse
    </div>
</div>
@endsection