@php
    $field = $name;
    $checked = (bool) old($field, $checked ?? false);
@endphp
<div>
    <label class="flex items-start gap-3 cursor-pointer group">
        <input
            type="checkbox"
            name="{{ $field }}"
            value="{{ $value ?? '1' }}"
            @checked($checked)
            class="mt-0.5 w-4 h-4 rounded border-outline-variant/60 bg-surface-container text-secondary focus:ring-secondary focus:ring-offset-0"
        >
        <span class="font-body-md text-body-md text-on-background group-hover:text-primary transition-colors">
            {{ $label }}
            @if(!empty($description))
                <span class="block font-meta-technical text-[12px] text-on-surface-variant mt-0.5">{{ $description }}</span>
            @endif
        </span>
    </label>
</div>