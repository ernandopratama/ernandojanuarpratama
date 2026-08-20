<section class="py-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="skills" style="background-color: #153250; color: #F3E4C9;">
    <div class="max-w-container-max mx-auto">
        <div class="mb-12">
            <span class="font-meta-technical text-meta-technical mb-4 block" style="color: #D3D4C0;">04 / SKILLS</span>
            <h2 class="font-headline-md text-headline-md">Technical Expertise</h2>
        </div>
        @if($skills->isEmpty())
            <p class="opacity-60">Skills coming soon.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($skills as $category => $categorySkills)
            <div class="reveal-on-scroll bg-white/5 p-8 rounded-3xl shadow-[var(--shadow-clay-dark)] hover:-translate-y-2 hover:shadow-[var(--shadow-clay-dark-hover)] transition-all duration-300">
                <h3 class="font-headline-sm text-headline-sm text-[#F3E4C9] mb-6">{{ $category }}</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($categorySkills as $skill)
                    <span class="font-meta-technical text-[12px] px-3 py-1.5 rounded-full bg-white/10 text-[#D3D4C0] border border-white/10">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
