<form method="POST" action="{{ $action }}" class="bg-surface-container border border-outline-variant/30 rounded-lg p-6 md:p-8 space-y-6 max-w-3xl">
    @csrf
    @if($method) @method($method) @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
        @include('admin.components.input', ['name' => 'company', 'label' => 'Company', 'value' => $experience->company, 'required' => true])
        @include('admin.components.input', ['name' => 'position', 'label' => 'Position', 'value' => $experience->position, 'required' => true])
        @include('admin.components.select', ['name' => 'employment_type', 'label' => 'Employment Type', 'options' => ['' => '— Select —', 'Full-time' => 'Full-time', 'Part-time' => 'Part-time', 'Contract' => 'Contract', 'Freelance' => 'Freelance'], 'selected' => $experience->employment_type])
        @include('admin.components.input', ['name' => 'location', 'label' => 'Location', 'value' => $experience->location])
        @include('admin.components.input', ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date', 'value' => $experience->start_date?->format('Y-m-d'), 'required' => true])
        @include('admin.components.input', ['name' => 'end_date', 'label' => 'End Date', 'type' => 'date', 'value' => $experience->end_date?->format('Y-m-d'), 'help' => 'Cleared automatically when "Current Position" is enabled.'])
    </div>

    <div>
        @include('admin.components.checkbox', ['name' => 'is_current', 'label' => 'Current Position', 'description' => 'Mark as ongoing. Public timeline shows "Present" and end date is ignored.', 'checked' => $experience->is_current])
    </div>

    <div>
        @include('admin.components.textarea', ['name' => 'description', 'label' => 'Description', 'value' => $experience->description, 'rows' => 5])
    </div>

    <div>
        @include('admin.components.input', ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number', 'value' => $experience->sort_order, 'min' => 0, 'step' => 1])
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-8 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            {{ $method ? 'Update Experience' : 'Create Experience' }}
        </button>
        <a href="{{ route('admin.experiences.index') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-8 py-3 rounded font-label-caps text-label-caps uppercase transition-all">Cancel</a>
    </div>
</form>

@push('scripts')
<script>
    const currentCb = document.getElementById('is_current');
    const endDate = document.getElementById('end_date');
    if (currentCb && endDate) {
        const syncEndDate = () => {
            endDate.disabled = currentCb.checked;
            if (currentCb.checked) endDate.value = '';
        };
        currentCb.addEventListener('change', syncEndDate);
        syncEndDate();
    }
</script>
@endpush