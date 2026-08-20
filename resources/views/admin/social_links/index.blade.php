@extends('admin.layouts.app')

@section('title', 'Social Links')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 border-b border-outline-variant/20 pb-6 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 06. SOCIAL_LINKS</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Social Links</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Manage external connections and platform routing. Sort order controls the display sequence on the public footer.</p>
    </div>
    <a href="{{ route('admin.social-links.create') }}" class="flex items-center gap-2 border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary px-6 py-2 rounded transition-all font-meta-technical text-meta-technical whitespace-nowrap bg-surface-container">
        <span class="material-symbols-outlined text-[18px]">add</span>
        Add Link
    </a>
</div>

<div class="bg-surface-container-low border border-outline-variant/30 rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-outline-variant/40 bg-surface-container text-on-surface-variant font-meta-technical text-xs tracking-wider uppercase">
                    <th class="p-4 w-12 text-center"></th>
                    <th class="p-4 font-medium">Platform</th>
                    <th class="p-4 font-medium">Endpoint URL</th>
                    <th class="p-4 font-medium text-center w-24">Visible</th>
                    <th class="p-4 font-medium text-right w-32">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20 font-body-md">
                @forelse($socialLinks as $socialLink)
                <tr class="hover:bg-surface-container-high transition-colors group">
                    <td class="p-4 text-center text-outline group-hover:text-on-surface-variant">
                        <span class="material-symbols-outlined text-lg cursor-move">drag_indicator</span>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-surface border border-outline-variant/50 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-sm">{{ $socialLink->icon ?? 'link' }}</span>
                            </div>
                            <div>
                                <div class="font-medium text-on-background">{{ $socialLink->platform }}</div>
                                <div class="text-xs text-on-surface-variant font-meta-technical">Sort: {{ str_pad($socialLink->sort_order + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 font-meta-technical text-sm {{ $socialLink->is_visible ? 'text-primary' : 'text-on-surface-variant line-through opacity-70' }} truncate max-w-[200px] md:max-w-md">
                        <a class="hover:underline" href="{{ $socialLink->url }}" target="_blank" rel="noopener noreferrer">{{ $socialLink->url }}</a>
                    </td>
                    <td class="p-4 text-center">
                        @if($socialLink->is_visible)
                            <span class="material-symbols-outlined text-secondary text-lg" title="Visible">visibility</span>
                        @else
                            <span class="material-symbols-outlined text-outline text-lg" title="Hidden">visibility_off</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-2 opacity-100 md:opacity-50 md:group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.social-links.edit', $socialLink) }}" class="p-1 text-on-surface-variant hover:text-primary transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form method="POST" action="{{ route('admin.social-links.destroy', $socialLink) }}" data-confirm="Delete social link '{{ $socialLink->platform }}'? This cannot be undone.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 text-on-surface-variant hover:text-error transition-colors" title="Delete">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-12">
                        <div class="flex flex-col items-center justify-center text-center border border-dashed border-outline-variant/30 rounded-lg bg-surface-container/50 py-10">
                            <span class="material-symbols-outlined text-[48px] text-outline-variant mb-4">link_off</span>
                            <p class="font-body-lg text-body-lg text-on-surface-variant mb-2">No social links found.</p>
                            <p class="font-meta-technical text-meta-technical text-outline max-w-sm">Add your first platform endpoint to populate this list.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-outline-variant/20 bg-surface-container text-xs text-on-surface-variant font-meta-technical flex justify-between items-center">
        <span>{{ $socialLinks->total() }} Total Links</span>
        <span>Sort Order: Manual</span>
    </div>
</div>

{{ $socialLinks->links('admin.components.pagination') }}
@endsection