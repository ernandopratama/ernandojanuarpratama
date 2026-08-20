<section class="relative min-h-screen flex items-center pt-24 pb-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="hero" style="background-color: #F3E4C9; color: #153250;">
    <div class="absolute inset-0 grid-bg opacity-30"></div>
    <div class="max-w-container-max mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-gutter relative z-10">
        <div class="lg:col-span-7 flex flex-col justify-center space-y-8">
            <div class="inline-flex items-center gap-3 hero-animate hero-delay-1" style=" margin-top: 25px;">
                <div class="w-2 h-2 rounded-full shadow-[var(--shadow-clay-dark)]" style="background-color: #8B5E3C;"></div>
                <span class="font-meta-technical text-meta-technical" style="color: #8B5E3C; letter-spacing: 0.1em;">{{ $profile ? strtoupper($profile->availability ?? 'AVAILABLE FOR OPPORTUNITIES') : 'AVAILABLE FOR OPPORTUNITIES' }}</span>
            </div>
            <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-[#0A2947] max-w-3xl hero-animate hero-delay-2">
                {{ $profile->headline ?? 'Building Digital Experiences That Solve Real Problems.' }}
            </h1>
            <p class="font-body-lg text-body-lg max-w-2xl text-[#153250]/80 hero-animate hero-delay-3">
                {{ $profile->short_bio ?? '' }}
            </p>
            <div class="pt-4 flex gap-4 hero-animate hero-delay-4">
                <a class="font-label-caps text-label-caps px-8 py-4 rounded-full shadow-[var(--shadow-clay-dark)] hover:shadow-[var(--shadow-clay-dark-hover)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-2" href="#contact" style="background-color: #0A2947; color: #F3E4C9;">
                    Let&apos;s Talk <span class="material-symbols-outlined">north_east</span>
                </a>
                <a class="font-label-caps text-label-caps px-8 py-4 rounded-full shadow-[var(--shadow-clay)] hover:shadow-[var(--shadow-clay-hover)] hover:-translate-y-1 transition-all duration-300" href="#work" style="background-color: #F3E4C9; color: #0A2947;">
                    View Work
                </a>
            </div>
        </div>
        <div class="lg:col-span-5 relative hidden lg:flex justify-center items-center hero-animate hero-delay-3">
            <div class="relative w-full aspect-[4/5] bg-[#E5D5BA] rounded-[3rem] shadow-[var(--shadow-clay)] p-6">
                <div class="w-full h-full relative overflow-hidden rounded-[2rem] flex items-center justify-center shadow-inner bg-[#F3E4C9]/40">
                    @if($profile && $profile->profile_image)
                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $profile->name }}" decoding="async" class="w-full h-full object-cover absolute inset-0">
                    @else
                        @php $initials = $profile ? collect(explode(' ', $profile->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('') : 'EJ'; @endphp
                        <span class="font-display-lg text-[120px] font-bold text-[#0A2947]/10 absolute select-none">{{ $initials }}</span>
                    @endif
                    <div class="absolute bottom-6 left-6 font-meta-technical text-[10px] text-[#0A2947]/50">
                        SYS.INIT: {{ date('Y') }}<br/>LOC: {{ $profile->location ?? 'INDONESIA' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
