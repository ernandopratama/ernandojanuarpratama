@extends('admin.layouts.app')

@section('title', 'Education')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 05. EDUCATION_MANAGEMENT</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Education Management</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Manage academic background and credentials.</p>
    </div>
    <a href="{{ route('admin.educations.create') }}" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-6 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2 group flex-shrink-0">
        <span class="material-symbols-outlined text-[18px]">add_box</span>
        <span>Add Education</span>
        <span class="material-symbols-outlined text-[14px] opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1">chevron_right</span>
    </a>
</div>

<div class="w-full border border-outline-variant/30 rounded-lg overflow-hidden bg-surface-container-lowest">
    <div class="grid grid-cols-12 gap-4 p-4 border-b border-outline-variant/30 bg-surface-container-low font-meta-technical text-meta-technical text-on-surface-variant text-xs uppercase tracking-widest">
        <div class="col-span-4">Institution</div>
        <div class="col-span-3">Degree / Field</div>
        <div class="col-span-3">Timeline</div>
        <div class="col-span-2 text-right">Actions</div>
    </div>

    @forelse($educations as $education)
    <div class="grid grid-cols-12 gap-4 p-4 items-center border-b border-outline-variant/10 hover:bg-surface-variant/20 transition-colors group">
        <div class="col-span-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded border border-outline-variant/30 bg-surface flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-secondary text-[20px]">school</span>
            </div>
            <div class="min-w-0">
                <div class="font-body-lg text-body-lg text-on-background truncate">{{ $education->institution }}</div>
                <div class="font-meta-technical text-[12px] text-on-surface-variant mt-1 truncate">{{ $education->location ?? '—' }}</div>
            </div>
        </div>
        <div class="col-span-3">
            <div class="font-body-md text-on-background">{{ $education->degree }}</div>
            @if($education->field)
                <div class="font-meta-technical text-[12px] text-secondary mt-1">{{ $education->field }}</div>
            @endif
        </div>
        <div class="col-span-3 font-meta-technical text-meta-technical text-on-surface-variant">
            {{ $education->start_date?->format('M Y') }} — {{ $education->end_date?->format('M Y') ?? 'Present' }}
        </div>
        <div class="col-span-2 flex justify-end gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity">
            <a href="{{ route('admin.educations.edit', $education) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors border border-transparent hover:border-outline-variant/30 rounded" title="Edit">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </a>
            <form method="POST" action="{{ route('admin.educations.destroy', $education) }}" data-confirm="Delete education record for '{{ $education->institution }}'? This cannot be undone.">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors border border-transparent hover:border-outline-variant/30 rounded" title="Delete">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="py-12 flex flex-col items-center justify-center text-center border border-dashed border-outline-variant/30 rounded-lg bg-surface-container/50 m-4">
        <span class="material-symbols-outlined text-[48px] text-outline-variant mb-4">school</span>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">No education records found.</p>
        <p class="font-meta-technical text-meta-technical text-outline max-w-sm">Add your first academic credential to populate this list.</p>
    </div>
    @endforelse
</div>

{{ $educations->links('admin.components.pagination') }}
@endsection