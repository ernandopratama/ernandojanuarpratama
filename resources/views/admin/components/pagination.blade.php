@if ($paginator->hasPages())
    <div class="mt-8 flex flex-col md:flex-row justify-between items-center border-t border-outline-variant/20 pt-6 gap-4">
        <p class="font-meta-technical text-meta-technical text-on-surface-variant">
            Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
        </p>
        <nav class="flex gap-2" aria-label="Pagination">
            @if ($paginator->onFirstPage())
                <span class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant opacity-50">
                    <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:border-secondary hover:text-secondary transition-colors">
                    <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                </a>
            @endif

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}" class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:border-secondary hover:text-secondary transition-colors">
                    <span class="font-meta-technical text-[12px]">1</span>
                </a>
                @if ($start > 2)
                    <span class="w-8 h-8 flex items-center justify-center text-on-surface-variant font-meta-technical text-[12px]">...</span>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i === $current)
                    <span class="w-8 h-8 rounded border border-secondary bg-secondary/10 flex items-center justify-center text-secondary">
                        <span class="font-meta-technical text-[12px]">{{ $i }}</span>
                    </span>
                @else
                    <a href="{{ $paginator->url($i) }}" class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:border-secondary hover:text-secondary transition-colors">
                        <span class="font-meta-technical text-[12px]">{{ $i }}</span>
                    </a>
                @endif
            @endfor

            @if ($end < $last)
                @if ($end < $last - 1)
                    <span class="w-8 h-8 flex items-center justify-center text-on-surface-variant font-meta-technical text-[12px]">...</span>
                @endif
                <a href="{{ $paginator->url($last) }}" class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:border-secondary hover:text-secondary transition-colors">
                    <span class="font-meta-technical text-[12px]">{{ $last }}</span>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant hover:border-secondary hover:text-secondary transition-colors">
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </a>
            @else
                <span class="w-8 h-8 rounded border border-outline-variant/30 flex items-center justify-center text-on-surface-variant opacity-50">
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </span>
            @endif
        </nav>
    </div>
@endif