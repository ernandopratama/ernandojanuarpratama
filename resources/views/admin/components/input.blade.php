@php
    $field = $name;
    $value = old($name, $value ?? '');
    $required = $required ?? false;
    $type = $type ?? 'text';
    $placeholder = $placeholder ?? '';
    $step = $step ?? null;
    $min = $min ?? null;
    $max = $max ?? null;
    $accept = $accept ?? null;
    $disabled = $disabled ?? null;
    $help = $help ?? null;
@endphp
<div>
    <label for="{{ $field }}" class="block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant mb-2">
        {{ $label }}{{ $required ? ' *' : '' }}
    </label>
    <input
        id="{{ $field }}"
        type="{{ $type }}"
        name="{{ $field }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($step !== null) step="{{ $step }}" @endif
        @if($min !== null) min="{{ $min }}" @endif
        @if($max !== null) max="{{ $max }}" @endif
        @if($accept !== null) accept="{{ $accept }}" @endif
        @if($disabled) disabled @endif
        class="w-full bg-surface border-b border-outline-variant/50 focus:border-secondary focus:ring-0 text-on-background font-meta-technical text-meta-technical px-3 py-2 transition-colors focus:bg-surface-container-high outline-none @error($field) border-error @enderror"
    >
    @include('admin.components.errors', ['field' => $field])
    @if($help)
        <p class="mt-1 font-meta-technical text-[12px] text-on-surface-variant/60">{{ $help }}</p>
    @endif
</div>