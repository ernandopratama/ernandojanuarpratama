<section class="py-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="work" style="background-color: #F3E4C9; color: #0A2947;">
    <div class="max-w-container-max mx-auto">
        <div class="mb-12">
            <span class="font-meta-technical text-meta-technical mb-4 block" style="color: #8B5E3C;">03 / SELECTED WORK</span>
            <h2 class="font-headline-md text-headline-md">Recent Projects</h2>
        </div>
        @if($projects->isEmpty())
            <p class="opacity-60">Projects coming soon.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($projects as $project)
            @php
                $projectJson = json_encode([
                    'title' => $project->title,
                    'desc'  => $project->description,
                    'tags'  => $project->skills->pluck('name')->values()->toArray(),
                    'cat'   => 'SELECTED WORK',
                    'url'   => $project->project_url,
                    'github'=> $project->github_url,
                ]);
            @endphp
            <div class="reveal-on-scroll project-card group cursor-pointer p-8 rounded-[2rem] shadow-[var(--shadow-clay)] hover:-translate-y-2 hover:shadow-[var(--shadow-clay-hover)] transition-all duration-300 open-modal-btn"
                 data-project="{{ htmlspecialchars($projectJson, ENT_QUOTES) }}"
                 style="background-color: rgba(255,255,255,0.4);">
                <div class="w-full aspect-video mb-6 rounded-2xl shadow-inner overflow-hidden relative flex items-center justify-center"
                     style="background-color: {{ $loop->even ? '#D3D4C0' : '#0A2947' }};">
                    @if($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" loading="lazy" decoding="async" class="w-full h-full object-cover absolute inset-0">
                    @else
                        <span class="font-display-lg text-4xl opacity-50" style="color: {{ $loop->even ? '#0A2947' : '#F3E4C9' }};">
                            {{ $project->title }}
                        </span>
                    @endif
                </div>
                <h3 class="font-headline-sm mb-2 group-hover:text-[#8B5E3C] transition-colors">{{ $project->title }}</h3>
                <p class="opacity-80 mb-4">{{ Str::limit($project->description, 100) }}</p>
                @if($project->skills->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach($project->skills->take(3) as $skill)
                    <span class="font-meta-technical text-[12px] px-3 py-1.5 rounded-full shadow-inner bg-white/50 text-[#0A2947]">{{ $skill->name }}</span>
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Project Modal -->
<div class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10" id="project-modal">
    <div class="absolute inset-0 bg-[#0A2947]/90 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="modal-overlay"></div>
    <div class="relative w-full max-w-6xl max-h-[90vh] bg-[#F3E4C9] rounded-[3rem] shadow-[var(--shadow-clay)] flex flex-col md:flex-row overflow-hidden transition-all duration-500 opacity-0 translate-y-8" id="modal-content">
        <button class="absolute top-6 right-6 z-20 w-12 h-12 flex items-center justify-center bg-[#0A2947] text-[#F3E4C9] rounded-full hover:bg-[#8B5E3C] transition-colors shadow-[var(--shadow-clay-dark)]" id="close-modal">
            <span class="material-symbols-outlined">close</span>
        </button>
        <!-- Carousel Area -->
        <div class="w-full md:w-3/5 bg-[#0A2947] relative flex items-center justify-center min-h-[300px] md:min-h-full">
            <div class="relative w-full h-full overflow-hidden group flex items-center bg-[#0A2947]/50 shadow-inner">
                <img alt="Project Screenshot" class="w-full object-contain max-h-[60vh] md:max-h-[90vh] transition-opacity duration-300" id="modal-image" decoding="async" src="">
                <button class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-[#F3E4C9]/10 hover:bg-[#F3E4C9]/30 text-[#F3E4C9] rounded-full backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 border border-[#F3E4C9]/20" id="prev-slide">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-[#F3E4C9]/10 hover:bg-[#F3E4C9]/30 text-[#F3E4C9] rounded-full backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 border border-[#F3E4C9]/20" id="next-slide">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
            <div class="absolute top-4 left-4 border p-2 font-meta-technical text-[10px] text-[#F3E4C9]/90 backdrop-blur-md bg-[#0A2947]/80 flex items-center gap-2 rounded-sm" style="border-color: rgba(243, 228, 201, 0.2);">
                <div class="w-1.5 h-1.5 rounded-full bg-[#8B5E3C]"></div>
                VIEW: <span id="img-index">01/01</span>
            </div>
        </div>
        <!-- Details Area -->
        <div class="w-full md:w-2/5 p-8 md:p-12 flex flex-col overflow-y-auto bg-[#F3E4C9] text-[#0A2947] relative">
            <div class="absolute top-0 right-0 w-16 h-16 border-b border-l opacity-20 pointer-events-none" style="border-color: #0A2947;"></div>
            <div class="flex-grow">
                <span class="font-meta-technical text-[12px] mb-4 block tracking-widest uppercase" id="modal-category" style="color: #8B5E3C;">SELECTED WORK</span>
                <h2 class="font-headline-md text-headline-md mb-6 leading-tight" id="modal-title">Project Title</h2>
                <div class="border-t border-b py-6 mb-8" style="border-color: rgba(10, 41, 71, 0.1);">
                    <p class="font-body-md text-body-md opacity-80 leading-relaxed" id="modal-desc">
                        Project description will appear here.
                    </p>
                </div>
                <div class="mb-8">
                    <h4 class="font-meta-technical text-[11px] tracking-widest mb-4 opacity-60 uppercase">Tech Stack</h4>
                    <div class="flex flex-wrap gap-2" id="modal-tags">
                        <!-- tags injected via JS -->
                    </div>
                </div>
            </div>
            <div class="pt-6 mt-4 flex flex-col gap-3">
                <a class="font-label-caps text-label-caps bg-[#0A2947] text-[#F3E4C9] px-8 py-5 text-center rounded-full shadow-[var(--shadow-clay-dark)] hover:shadow-[var(--shadow-clay-dark-hover)] transition-all duration-300 flex items-center justify-center gap-2 w-full hover:-translate-y-1" href="#" id="modal-project-url">
                    View Project <span class="material-symbols-outlined text-[18px]">arrow_outward</span>
                </a>
                <a class="font-label-caps text-label-caps bg-white/30 text-[#0A2947] px-8 py-5 text-center rounded-full shadow-[var(--shadow-clay)] hover:shadow-[var(--shadow-clay-hover)] transition-all duration-300 flex items-center justify-center gap-2 w-full hover:-translate-y-1 hidden" href="#" id="modal-github-url">
                    GitHub <span class="material-symbols-outlined text-[18px]">code</span>
                </a>
            </div>
        </div>
    </div>
</div>
