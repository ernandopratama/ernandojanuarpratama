<form method="POST" action="{{ $action }}" class="bg-surface-container border border-outline-variant/30 rounded-lg p-6 md:p-8 space-y-6 max-w-3xl">
    @csrf
    @if($method) @method($method) @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
        @include('admin.components.input', ['name' => 'institution', 'label' => 'Institution', 'value' => $education->institution, 'required' => true])
        @include('admin.components.input', ['name' => 'degree', 'label' => 'Degree', 'value' => $education->degree, 'required' => true])
        @include('admin.components.input', ['name' => 'field', 'label' => 'Field of Study', 'value' => $education->field])
        @include('admin.components.input', ['name' => 'location', 'label' => 'Location', 'value' => $education->location])
        @include('admin.components.input', ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date', 'value' => $education->start_date?->format('Y-m-d')])
        @include('admin.components.input', ['name' => 'end_date', 'label' => 'End Date', 'type' => 'date', 'value' => $education->end_date?->format('Y-m-d')])
    </div>

    <div>
        @include('admin.components.textarea', ['name' => 'description', 'label' => 'Description', 'value' => $education->description, 'rows' => 5])
    </div>

    <div>
        @include('admin.components.input', ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number', 'value' => $education->sort_order, 'min' => 0, 'step' => 1])
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-8 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            {{ $method ? 'Update Education' : 'Create Education' }}
        </button>
        <a href="{{ route('admin.educations.index') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-8 py-3 rounded font-label-caps text-label-caps uppercase transition-all">Cancel</a>
    </div>
</form>