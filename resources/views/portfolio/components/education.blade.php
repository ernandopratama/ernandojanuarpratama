<section class="py-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="education" style="background-color: #D3D4C0; color: #0A2947;">
    <div class="max-w-container-max mx-auto">
        <div class="mb-12">
            <span class="font-meta-technical text-meta-technical mb-4 block" style="color: #8B5E3C;">05 / EDUCATION</span>
            <h2 class="font-headline-md text-headline-md">Academic Background</h2>
        </div>
        @if($educations->isEmpty())
            <p class="opacity-60">Education coming soon.</p>
        @else
        <div class="space-y-8">
            @foreach($educations as $edu)
            <div class="reveal-on-scroll p-8 rounded-3xl shadow-[var(--shadow-clay)] hover:-translate-y-2 hover:shadow-[var(--shadow-clay-hover)] transition-all duration-300" style="background-color: rgba(255,255,255,0.4);">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3">
                    <h3 class="font-headline-sm text-headline-sm">{{ $edu->institution }}</h3>
                    @if($edu->start_date || $edu->end_date)
                    <span class="font-meta-technical text-meta-technical mt-1 md:mt-0" style="color: #8B5E3C;">
                        {{ $edu->start_date ? \Carbon\Carbon::parse($edu->start_date)->format('Y') : '' }}
                        @if($edu->end_date) &mdash; {{ \Carbon\Carbon::parse($edu->end_date)->format('Y') }}@endif
                    </span>
                    @endif
                </div>
                <p class="font-meta-technical text-meta-technical mb-3" style="color: #8B5E3C;">
                    {{ $edu->degree }}{{ $edu->field ? ' — ' . $edu->field : '' }}{{ $edu->location ? ' &bull; ' . $edu->location : '' }}
                </p>
                @if($edu->description)
                <p class="opacity-80">{{ $edu->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
