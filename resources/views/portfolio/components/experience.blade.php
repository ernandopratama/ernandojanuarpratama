<section class="py-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="experience" style="background-color: #0A2947; color: #F3E4C9;">
    <div class="max-w-container-max mx-auto">
        <div class="mb-12">
            <span class="font-meta-technical text-meta-technical mb-4 block" style="color: #D3D4C0;">02 / EXPERIENCE</span>
            <h2 class="font-headline-md text-headline-md">Career Journey</h2>
        </div>
        @if($experiences->isEmpty())
            <p class="opacity-60">Experience coming soon.</p>
        @else
        <div class="relative border-l-4 ml-4 md:ml-6 space-y-12" style="border-color: rgba(243, 228, 201, 0.1);">
            @foreach($experiences as $exp)
            <div class="reveal-on-scroll pl-10 relative project-card group">
                <div class="absolute w-6 h-6 rounded-full -left-[15px] top-4 shadow-[var(--shadow-clay-dark)] border-4 border-[#0A2947]"
                     style="background-color: {{ $exp->is_current ? '#D3D4C0' : 'rgba(243, 228, 201, 0.4)' }};"></div>
                <div class="bg-white/5 p-8 rounded-3xl shadow-[var(--shadow-clay-dark)] hover:-translate-y-2 hover:shadow-[var(--shadow-clay-dark-hover)] transition-all duration-300">
                    <h3 class="font-headline-sm text-headline-sm text-[#F3E4C9]">{{ $exp->position }}</h3>
                    <p class="font-meta-technical text-meta-technical mb-4" style="color: #8B5E3C;">
                        {{ $exp->company }}
                        @if($exp->employment_type) &bull; {{ $exp->employment_type }}@endif
                        @if($exp->location) &bull; {{ $exp->location }}@endif
                        &bull;
                        {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }}
                        &mdash;
                        {{ $exp->is_current ? 'Present' : \Carbon\Carbon::parse($exp->end_date)->format('Y') }}
                    </p>
                    @if($exp->description)
                    <p class="max-w-2xl opacity-80 text-[#D3D4C0]">{{ $exp->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
