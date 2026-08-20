<form method="POST" action="{{ $action }}" class="bg-surface-container border border-outline-variant/30 rounded-lg p-6 md:p-8 space-y-6 max-w-3xl">
    @csrf
    @if($method) @method($method) @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
        @include('admin.components.input', ['name' => 'name', 'label' => 'Skill Name', 'value' => $skill->name, 'required' => true])
        @include('admin.components.select', ['name' => 'category', 'label' => 'Category', 'options' => $categories, 'selected' => $skill->category, 'required' => true])
        @include('admin.components.input', ['name' => 'icon', 'label' => 'Icon', 'value' => $skill->icon, 'help' => 'Optional Material Symbols icon name, e.g. "terminal".'])
        @include('admin.components.input', ['name' => 'proficiency', 'label' => 'Proficiency (%)', 'type' => 'number', 'value' => $skill->proficiency ?? 0, 'min' => 0, 'max' => 100, 'step' => 1, 'required' => true])
    </div>

    <div>
        @include('admin.components.input', ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number', 'value' => $skill->sort_order, 'min' => 0, 'step' => 1, 'help' => 'Lower values appear first in the list.'])
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-8 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            {{ $method ? 'Update Skill' : 'Create Skill' }}
        </button>
        <a href="{{ route('admin.skills.index') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-8 py-3 rounded font-label-caps text-label-caps uppercase transition-all">Cancel</a>
    </div>
</form>