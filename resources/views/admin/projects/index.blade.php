@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 03. PROJECT_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Projects</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Manage portfolio projects, thumbnails and assigned technologies. Published projects appear on the public landing page.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-6 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2 group flex-shrink-0">
        <span class="material-symbols-outlined text-[18px]">add_box</span>
        <span>Add Project</span>
        <span class="material-symbols-outlined text-[14px] opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1">chevron_right</span>
    </a>
</div>

<div class="space-y-4">
    <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">
        <div class="col-span-2">Thumbnail</div>
        <div class="col-span-4">Title</div>
        <div class="col-span-2">Status</div>
        <div class="col-span-2">Year</div>
        <div class="col-span-2 text-right">Actions</div>
    </div>

    @forelse($projects as $project)
    <div class="bg-surface-container hover:bg-surface-container-high transition-colors border border-outline-variant/20 hover:border-outline-variant/50 rounded-lg p-4 md:px-6 md:py-4 flex flex-col md:grid md:grid-cols-12 gap-4 items-start md:items-center group">
        <div class="col-span-2 w-full">
            <div class="w-24 h-16 rounded border border-outline-variant/30 bg-surface overflow-hidden flex items-center justify-center">
                @if($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                @else
                    <span class="material-symbols-outlined text-outline-variant text-[20px]">image</span>
                @endif
            </div>
        </div>
        <div class="col-span-4 w-full">
            <div class="font-headline-sm text-[18px] md:text-headline-sm text-on-background font-semibold flex items-center gap-2">
                {{ $project->title }}
                @if($project->featured)
                    <span class="material-symbols-outlined text-secondary text-[18px]" title="Featured">star</span>
                @endif
            </div>
            <div class="font-meta-technical text-[12px] text-on-surface-variant mt-0.5 truncate">/{{ $project->slug }}</div>
        </div>
        <div class="col-span-2 w-full">
            @include('admin.components.status-badge', ['status' => $project->status])
        </div>
        <div class="col-span-2 w-full font-meta-technical text-meta-technical text-on-surface-variant">
            {{ $project->year ?? '—' }}
        </div>
        <div class="col-span-2 w-full flex justify-end gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity">
            <a href="{{ route('admin.projects.edit', $project) }}" class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Edit">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </a>
            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Delete project '{{ $project->title }}'? Its thumbnail will also be removed.">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-on-surface-variant hover:text-error transition-colors p-1" title="Delete">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="py-12 flex flex-col items-center justify-center text-center border border-dashed border-outline-variant/30 rounded-lg bg-surface-container/50">
        <span class="material-symbols-outlined text-[48px] text-outline-variant mb-4">folder_off</span>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">No projects found.</p>
        <p class="font-meta-technical text-meta-technical text-outline max-w-sm">Add your first project to populate this list.</p>
    </div>
    @endforelse
</div>

{{ $projects->links('admin.components.pagination') }}
@endsection