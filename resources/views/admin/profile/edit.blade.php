@extends('admin.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
    <div>
        <span class="font-meta-technical text-meta-technical text-secondary mb-2 block">// 01. PROFILE</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background mb-4">Edit Profile</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Single primary record shown on the public landing page. Save creates the record if it does not exist yet.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="bg-surface-container border border-outline-variant/30 rounded-lg p-6 md:p-8 space-y-8 max-w-4xl">
    @csrf
    @method('PATCH')

    {{-- Identity --}}
    <fieldset>
        <legend class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-4">Identity</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @include('admin.components.input', ['name' => 'name', 'label' => 'Name', 'value' => $profile->name, 'required' => true])
            @include('admin.components.input', ['name' => 'headline', 'label' => 'Headline', 'value' => $profile->headline, 'required' => true])
        </div>
        <div class="mt-6 md:mt-8">
            @include('admin.components.input', ['name' => 'short_bio', 'label' => 'Short Bio', 'value' => $profile->short_bio, 'required' => true])
        </div>
        <div class="mt-6 md:mt-8">
            @include('admin.components.textarea', ['name' => 'about', 'label' => 'About', 'value' => $profile->about, 'rows' => 6])
        </div>
    </fieldset>

    {{-- Contact --}}
    <fieldset>
        <legend class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-4">Contact</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @include('admin.components.input', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'value' => $profile->email])
            @include('admin.components.input', ['name' => 'phone', 'label' => 'Phone', 'value' => $profile->phone])
            @include('admin.components.input', ['name' => 'location', 'label' => 'Location', 'value' => $profile->location])
            @include('admin.components.input', ['name' => 'availability', 'label' => 'Availability', 'value' => $profile->availability, 'help' => 'Shown next to the hero status dot, e.g. "Available for Opportunities".'])
        </div>
    </fieldset>

    {{-- Media --}}
    <fieldset>
        <legend class="font-label-caps text-label-caps uppercase tracking-widest text-secondary mb-4">Media</legend>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <div>
                <label class="block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant mb-2">Profile Image</label>
                @if($profile->profile_image)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Current profile image" class="w-16 h-16 rounded-full object-cover border border-outline-variant/30">
                        <p class="font-meta-technical text-[12px] text-on-surface-variant">Current file: {{ basename($profile->profile_image) }}. Upload a new image to replace it.</p>
                    </div>
                @endif
                <input type="file" name="profile_image" id="profile_image" accept="image/jpeg,image/png,image/webp" data-preview-input data-preview-target="profile-image-preview"
                    class="block w-full text-sm text-on-surface-variant font-meta-technical file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-surface file:text-secondary file:cursor-pointer hover:file:bg-surface-container-high">
                <img id="profile-image-preview" class="hidden mt-3 w-16 h-16 rounded-full object-cover border border-outline-variant/30" alt="Image preview">
                @include('admin.components.errors', ['field' => 'profile_image'])
                <p class="mt-1 font-meta-technical text-[12px] text-on-surface-variant/60">JPG, PNG or WEBP. Max 2 MB.</p>
            </div>
            <div>
                <label class="block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant mb-2">CV File</label>
                @if($profile->cv_file)
                    <div class="mb-3 flex items-center gap-4">
                        <a href="{{ asset('storage/' . $profile->cv_file) }}" target="_blank" class="flex items-center gap-2 font-meta-technical text-[12px] text-primary hover:underline">
                            <span class="material-symbols-outlined text-[16px]">description</span>
                            {{ basename($profile->cv_file) }}
                        </a>
                        <p class="font-meta-technical text-[12px] text-on-surface-variant">Upload a new file to replace it.</p>
                    </div>
                @endif
                <input type="file" name="cv_file" id="cv_file" accept="application/pdf"
                    class="block w-full text-sm text-on-surface-variant font-meta-technical file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-surface file:text-secondary file:cursor-pointer hover:file:bg-surface-container-high">
                @include('admin.components.errors', ['field' => 'cv_file'])
                <p class="mt-1 font-meta-technical text-[12px] text-on-surface-variant/60">PDF. Max 5 MB.</p>
            </div>
        </div>
    </fieldset>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-8 rounded border border-secondary hover:bg-transparent hover:text-secondary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            Save Profile
        </button>
        <a href="{{ route('admin.dashboard') }}" class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-8 py-3 rounded font-label-caps text-label-caps uppercase transition-all">Cancel</a>
    </div>
</form>
@endsection