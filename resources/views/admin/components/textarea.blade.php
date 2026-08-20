@php
    $field = $name;
    $value = old($name, $value ?? '');
@endphp
<div>
    <label for="{{ $field }}" class="block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant mb-2">
        {{ $label }}{{ !empty($required) ? ' *' : '' }}
    </label>
    <textarea
        id="{{ $field }}"
        name="{{ $field }}"
        rows="{{ $rows ?? 4 }}"
        placeholder="{{ $placeholder ?? '' }}"
        @if(!empty($required)) required @endif
        class="w-full bg-surface border-b border-outline-variant/50 focus:border-secondary focus:ring-0 text-on-background font-meta-technical text-meta-technical px-3 py-2 transition-colors focus:bg-surface-container-high outline-none resize-y @error($field) border-error @enderror"
    >{{ $value }}</textarea>
    @include('admin.components.errors', ['field' => $field])
    @if(!empty($help))
        <p class="mt-1 font-meta-technical text-[12px] text-on-surface-variant/60">{{ $help }}</p>
    @endif
</div>