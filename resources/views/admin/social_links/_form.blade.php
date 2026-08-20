<form method="POST" action="{{ $action }}" class="bg-surface-container border border-outline-variant/30 rounded-lg p-6 md:p-8 space-y-6 max-w-3xl">
    @csrf
    @if($method) @method($method) @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
        @include('admin.components.input', ['name' => 'platform', 'label' => 'Platform', 'value' => $socialLink->platform, 'placeholder' => 'LinkedIn', 'required' => true])
        @include('admin.components.input', ['name' => 'icon', 'label' => 'Icon', 'value' => $socialLink->icon, 'help' => 'Optional Material Symbols icon name, e.g. "link".'])
    </div>

    <div>
        @include('admin.components.input', ['name' => 'url', 'label' => 'Endpoint URL', 'type' => 'url', 'value' => $socialLink->url, 'placeholder' => 'https://linkedin.com/in/...', 'required' => true])
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
        <div>
            @include('admin.components.input', ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number', 'value' => $socialLink->sort_order, 'min' => 0, 'step' => 1, 'help' => 'Lower values appear first on the public footer.'])
        </div>
        <div class="md:pt-7">
            @include('admin.components.checkbox', ['name' => 'is_visible', 'label' => 'Visible', 'description' => 'Hidden links disappear from the public landing page.', 'checked' => $socialLink->is_visible])
        </div>
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-8 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            {{ $method ? 'Update Link' : 'Create Link' }}
        </button>
        <a href="{{ route('admin.social-links.index') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-8 py-3 rounded font-label-caps text-label-caps uppercase transition-all">Cancel</a>
    </div>
</form>