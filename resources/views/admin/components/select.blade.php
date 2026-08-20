@php
    $field = $name;
    $selected = old($name, $selected ?? '');
@endphp
<div>
    <label for="{{ $field }}" class="block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant mb-2">
        {{ $label }}{{ !empty($required) ? ' *' : '' }}
    </label>
    <div class="relative">
        <select
            id="{{ $field }}"
            name="{{ $field }}"
            @if(!empty($required)) required @endif
            class="w-full bg-surface border-b border-outline-variant/50 focus:border-secondary focus:ring-0 text-on-background font-meta-technical text-meta-technical pl-3 pr-10 py-2 appearance-none outline-none cursor-pointer transition-colors focus:bg-surface-container-high @error($field) border-error @enderror"
        >
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) $selected === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
        <span class="material-symbols-outlined absolute right-3 top-1/2 transform -translate-y-1/2 text-on-surface-variant text-[20px] pointer-events-none">arrow_drop_down</span>
    </div>
    @include('admin.components.errors', ['field' => $field])
</div>