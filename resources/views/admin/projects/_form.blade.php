@php $selectedSkills = old('skills', $project->skills->pluck('id')->all()); @endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="bg-surface-container border border-outline-variant/30 rounded-lg p-6 md:p-8 space-y-8 max-w-4xl">
    @csrf
    @if($method) @method($method) @endif

    {{-- Core --}}
    <fieldset>
        <legend class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-4">Core</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @include('admin.components.input', ['name' => 'title', 'label' => 'Title', 'value' => $project->title, 'required' => true])
            @include('admin.components.input', ['name' => 'slug', 'label' => 'Slug', 'value' => $project->slug, 'help' => 'Leave empty to generate automatically from the title. Must stay unique.'])
            @include('admin.components.input', ['name' => 'year', 'label' => 'Year', 'value' => $project->year, 'placeholder' => '2026'])
            @include('admin.components.select', ['name' => 'status', 'label' => 'Status', 'options' => ['draft' => 'Draft', 'published' => 'Published'], 'selected' => $project->status, 'required' => true])
            @include('admin.components.input', ['name' => 'project_url', 'label' => 'Project URL', 'type' => 'url', 'value' => $project->project_url])
            @include('admin.components.input', ['name' => 'github_url', 'label' => 'GitHub URL', 'type' => 'url', 'value' => $project->github_url])
        </div>
        <div class="mt-6 md:mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <div>
                @include('admin.components.checkbox', ['name' => 'featured', 'label' => 'Featured', 'description' => 'Featured projects are prioritized on the public landing page.', 'checked' => $project->featured])
            </div>
            <div>
                @include('admin.components.input', ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'number', 'value' => $project->sort_order, 'min' => 0, 'step' => 1])
            </div>
        </div>
        <div class="mt-6 md:mt-8">
            @include('admin.components.textarea', ['name' => 'description', 'label' => 'Description', 'value' => $project->description, 'rows' => 5, 'required' => true])
        </div>
    </fieldset>

    {{-- Thumbnail --}}
    <fieldset>
        <legend class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-4">Thumbnail</legend>
        <label class="block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant mb-2">Project Thumbnail</label>
        @if($project->thumbnail)
            <div class="mb-3 flex items-center gap-4">
                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="Current thumbnail" class="w-32 h-20 object-cover rounded border border-outline-variant/30">
                <p class="font-meta-technical text-[12px] text-on-surface-variant">Current file: {{ basename($project->thumbnail) }}. Upload a new image to replace it, or leave empty to keep.</p>
            </div>
        @endif
        <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png,image/webp" data-preview-input data-preview-target="thumbnail-preview"
            class="block w-full text-sm text-on-surface-variant font-meta-technical file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-surface file:text-secondary file:cursor-pointer hover:file:bg-surface-container-high">
        <img id="thumbnail-preview" class="hidden mt-3 w-32 h-20 object-cover rounded border border-outline-variant/30" alt="Image preview">
        @include('admin.components.errors', ['field' => 'thumbnail'])
        <p class="mt-1 font-meta-technical text-[12px] text-on-surface-variant/60">JPG, PNG or WEBP. Max 2 MB.</p>
    </fieldset>

    {{-- Skills --}}
    <fieldset>
        <legend class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-4">Technologies</legend>
        @if($skills->isNotEmpty())
            <div class="space-y-4">
                @foreach($skills as $category => $categorySkills)
                    <fieldset class="border border-outline-variant/20 rounded-lg p-4">
                        <legend class="font-meta-technical text-[12px] text-secondary uppercase tracking-widest px-1 bg-surface-container">{{ $category }}</legend>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                            @foreach($categorySkills as $skill)
                                <label class="flex items-center gap-2 cursor-pointer group py-1">
                                    <input type="checkbox" name="skills[]" value="{{ $skill->id }}" @checked(in_array($skill->id, $selectedSkills))
                                        class="w-4 h-4 rounded border-outline-variant/60 bg-surface-container text-secondary focus:ring-secondary focus:ring-offset-0">
                                    <span class="font-meta-technical text-meta-technical text-on-background group-hover:text-primary transition-colors">{{ $skill->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach
            </div>
            @error('skills')
                <p class="mt-2 font-meta-technical text-[12px] text-error">{{ $message }}</p>
            @enderror
        @else
            <p class="font-meta-technical text-meta-technical text-on-surface-variant">No skills available yet. <a href="{{ route('admin.skills.create') }}" class="text-secondary hover:underline">Add skills first</a> to assign technologies to this project.</p>
        @endif
    </fieldset>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-8 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            {{ $method ? 'Update Project' : 'Create Project' }}
        </button>
        <a href="{{ route('admin.projects.index') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-8 py-3 rounded font-label-caps text-label-caps uppercase transition-all">Cancel</a>
    </div>
</form>