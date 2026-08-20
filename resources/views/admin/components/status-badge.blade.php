@php
    $status = $status ?? '';
    $label = $label ?? ucfirst($status);
    $positive = $status === 'published' || $status === 'visible' || $status === true;
@endphp
<span class="inline-flex items-center gap-1.5 font-meta-technical text-[12px] px-2.5 py-1 rounded border {{ $positive ? 'border-secondary/40 bg-secondary-container/20 text-secondary' : 'border-outline-variant/40 bg-surface-variant/20 text-on-surface-variant' }}">
    <span class="w-1.5 h-1.5 rounded-full {{ $positive ? 'bg-secondary' : 'bg-outline' }}"></span>
    {{ $label }}
</span>