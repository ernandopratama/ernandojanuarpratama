<footer class="w-full py-8 border-t" style="background-color: #0A2947; border-color: rgba(243, 228, 201, 0.1); color: #F3E4C9;">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-desktop max-w-container-max mx-auto gap-gutter">
        <div class="font-label-caps text-label-caps mb-4 md:mb-0">
            {{ $profile ? collect(explode(' ', $profile->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('') . '.' : 'EP.' }}
        </div>
        <div class="flex flex-wrap justify-center gap-6">
            @forelse($socialLinks as $link)
            <a class="font-meta-technical text-meta-technical hover:text-[#D3D4C0] transition-colors duration-300 opacity-80 hover:opacity-100"
               href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                {{ $link->platform }}
            </a>
            @empty
            @endforelse
        </div>
        <div class="font-meta-technical text-[12px] opacity-50 mt-4 md:mt-0">
            &copy; {{ date('Y') }} {{ $profile->name ?? 'Ernando Januar Pratama' }}. All rights reserved. Built with precision.
        </div>
    </div>
</footer>
