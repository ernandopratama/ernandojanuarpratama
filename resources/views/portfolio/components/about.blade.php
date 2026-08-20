<section class="py-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="about" style="background-color: #D3D4C0; color: #0A2947;">
    <div class="max-w-container-max mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-gutter items-center">
        <div class="reveal-on-scroll">
            <span class="font-meta-technical text-meta-technical mb-4 block" style="color: #8B5E3C;">01 / ABOUT</span>
            <h2 class="font-headline-md text-headline-md mb-6">Bridging the gap between design and robust engineering.</h2>
            @if($profile && $profile->about)
                @foreach(explode("\n\n", $profile->about) as $paragraph)
                    <p class="font-body-lg text-body-lg mb-6 opacity-80">{{ trim($paragraph) }}</p>
                @endforeach
            @endif
        </div>
        <div class="reveal-on-scroll grid grid-cols-2 gap-6" style="transition-delay: 200ms;">
            @forelse($skills as $category => $categorySkills)
            <div class="p-8 rounded-3xl shadow-[var(--shadow-clay)] hover:-translate-y-2 hover:shadow-[var(--shadow-clay-hover)] transition-all duration-300" style="background-color: rgba(255,255,255,0.3);">
                <h4 class="font-headline-sm font-bold mb-2">{{ $category }}</h4>
                <p class="opacity-80">{{ $categorySkills->pluck('name')->implode(', ') }}</p>
            </div>
            @empty
            <div class="col-span-2 p-8 rounded-3xl shadow-[var(--shadow-clay)]" style="background-color: rgba(255,255,255,0.3);">
                <p class="opacity-60">Skills coming soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
