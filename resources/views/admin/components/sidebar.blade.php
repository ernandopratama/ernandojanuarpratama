<aside class="bg-primary-container text-primary font-meta-technical text-meta-technical left-0 h-screen w-64 border-r border-outline-variant/20 flex flex-col p-gutter flex-shrink-0 z-50 transition-transform duration-300 -translate-x-full md:translate-x-0 absolute md:relative">
    {{-- Header --}}
    <div class="mb-8 flex flex-col items-center border-b border-outline-variant/20 pb-6">
        <div class="w-16 h-16 rounded-full border border-secondary p-1 mb-4 flex-shrink-0 flex items-center justify-center">
            <div class="w-full h-full rounded-full bg-secondary-container text-secondary flex items-center justify-center font-headline-sm text-headline-sm font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
        <h2 class="font-headline-sm text-headline-sm text-primary mb-1 text-center">Admin Console</h2>
        <p class="font-label-caps text-label-caps uppercase tracking-widest text-secondary text-center">System Management</p>
    </div>

    {{-- CTA --}}
    <a href="{{ route('admin.projects.create') }}" class="w-full mb-8 bg-secondary text-on-secondary font-label-caps text-label-caps uppercase py-3 px-4 rounded flex justify-center items-center gap-2 hover:bg-secondary-fixed transition-colors">
        <span class="material-symbols-outlined text-[18px]">add</span>
        New Project
    </a>

    {{-- Navigation --}}
    <nav class="flex-1 flex flex-col gap-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">space_dashboard</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.profile.edit') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.profile.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">person</span>
            <span>Profile</span>
        </a>
        <a href="{{ route('admin.experiences.index') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.experiences.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">timeline</span>
            <span>Experience</span>
        </a>
        <a href="{{ route('admin.projects.index') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.projects.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">grid_view</span>
            <span>Projects</span>
        </a>
        <a href="{{ route('admin.skills.index') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.skills.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">code</span>
            <span>Skills</span>
        </a>
        <a href="{{ route('admin.educations.index') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.educations.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">school</span>
            <span>Education</span>
        </a>
        <a href="{{ route('admin.social-links.index') }}" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all {{ request()->routeIs('admin.social-links.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-bright' }}">
            <span class="material-symbols-outlined text-[20px]">link</span>
            <span>Social Links</span>
        </a>
        <a href="{{ url('/') }}" target="_blank" data-sidebar-close class="flex items-center gap-unit p-3 rounded-lg transition-all text-on-surface-variant hover:bg-surface-bright">
            <span class="material-symbols-outlined text-[20px]">open_in_new</span>
            <span>View Portfolio</span>
        </a>
    </nav>

    {{-- Footer / Logout --}}
    <div class="mt-auto pt-6 border-t border-outline-variant/20">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-unit text-on-surface-variant p-3 hover:text-error hover:bg-error-container/20 transition-all rounded-lg">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>