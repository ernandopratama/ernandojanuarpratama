@extends('admin.layouts.app')

@section('title', 'Skills')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 04. SKILLS_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Technical Skills</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Manage and organize your technical proficiencies. Updates here directly reflect on the public portfolio view.</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-6 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2 group flex-shrink-0">
        <span class="material-symbols-outlined text-[18px]">add_box</span>
        <span>Add Skill</span>
        <span class="material-symbols-outlined text-[14px] opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1">chevron_right</span>
    </a>
</div>

{{-- Toolbar --}}
<form method="GET" action="{{ route('admin.skills.index') }}" class="bg-surface-container border border-outline-variant/30 rounded-lg p-4 mb-8 flex flex-col md:flex-row gap-4 justify-between items-center">
    <div class="relative w-full md:w-96">
        <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
        <input name="q" value="{{ request('q') }}" type="text" placeholder="Search skills..."
            class="w-full bg-surface border-b border-outline-variant/50 focus:border-secondary focus:ring-0 text-on-background font-meta-technical text-meta-technical pl-10 pr-4 py-2 transition-colors focus:bg-surface-container-high outline-none">
    </div>
    <div class="flex gap-4 w-full md:w-auto">
        <div class="relative flex-1 md:w-48">
            <select name="category" onchange="this.form.submit()"
                class="w-full bg-surface border-b border-outline-variant/50 focus:border-secondary focus:ring-0 text-on-background font-meta-technical text-meta-technical pl-4 pr-10 py-2 appearance-none outline-none cursor-pointer">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            <span class="material-symbols-outlined absolute right-3 top-1/2 transform -translate-y-1/2 text-on-surface-variant text-[20px] pointer-events-none">arrow_drop_down</span>
        </div>
        <button type="submit" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-4 py-2 rounded font-meta-technical text-meta-technical transition-all">Filter</button>
    </div>
</form>

{{-- Bento list --}}
<div class="space-y-4">
    <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">
        <div class="col-span-3">Category</div>
        <div class="col-span-4">Skill Name</div>
        <div class="col-span-3">Proficiency Level</div>
        <div class="col-span-1 text-center">Order</div>
        <div class="col-span-1 text-right">Actions</div>
    </div>

    @forelse($skills as $skill)
    @php
        $categoryIcons = ['Frontend' => 'code', 'Backend' => 'terminal', 'Design' => 'palette', 'Tools & DevOps' => 'build'];
    @endphp
    <div class="bg-surface-container hover:bg-surface-container-high transition-colors border border-outline-variant/20 hover:border-outline-variant/50 rounded-lg p-4 md:px-6 md:py-4 flex flex-col md:grid md:grid-cols-12 gap-4 items-start md:items-center group">
        <div class="col-span-3 font-meta-technical text-meta-technical text-secondary flex items-center gap-2 w-full">
            <span class="material-symbols-outlined text-[16px] opacity-70">{{ $categoryIcons[$skill->category] ?? 'extension' }}</span>
            {{ $skill->category }}
        </div>
        <div class="col-span-4 font-headline-sm text-[18px] md:text-headline-sm text-on-background font-semibold w-full">
            {{ $skill->name }}
            <span class="block font-meta-technical text-[12px] text-on-surface-variant font-normal mt-0.5">{{ $skill->projects_count }} {{ Str::plural('project', $skill->projects_count) }}</span>
        </div>
        <div class="col-span-3 w-full flex items-center gap-3">
            <div class="flex-1 h-1 bg-surface rounded-full overflow-hidden">
                <div class="h-full bg-primary w-[{{ $skill->proficiency }}%]"></div>
            </div>
            <span class="font-meta-technical text-[12px] text-on-surface-variant min-w-[3ch]">{{ $skill->proficiency }}%</span>
        </div>
        <div class="col-span-1 w-full md:text-center font-meta-technical text-meta-technical text-on-surface-variant">
            <span class="md:hidden text-[12px] uppercase opacity-50 mr-2">Order:</span>
            {{ str_pad($skill->sort_order + 1, 2, '0', STR_PAD_LEFT) }}
        </div>
        <div class="col-span-1 w-full flex justify-end gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity">
            <a href="{{ route('admin.skills.edit', $skill) }}" class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Edit">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </a>
            <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" data-confirm="Delete skill '{{ $skill->name }}'? It will be detached from {{ $skill->projects_count }} {{ Str::plural('project', $skill->projects_count) }}.">
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
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">No skills found.</p>
        <p class="font-meta-technical text-meta-technical text-outline max-w-sm">Adjust your filters or add a new skill to populate this list.</p>
    </div>
    @endforelse
</div>

{{ $skills->links('admin.components.pagination') }}
@endsection