<section class="py-section-gap px-margin-mobile md:px-margin-desktop w-full overflow-hidden" id="contact" style="background-color: #0A2947; color: #F3E4C9;">
    <div class="max-w-container-max mx-auto text-center reveal-on-scroll flex flex-col items-center justify-center min-h-[50vh]">
        <span class="font-meta-technical text-meta-technical mb-4 block" style="color: #D3D4C0;">04 / CONTACT</span>
        <h2 class="font-display-lg-mobile md:font-display-lg mb-8 max-w-4xl mx-auto">Let&apos;s build something exceptional together.</h2>
        <p class="font-body-lg mb-10 opacity-80 max-w-2xl mx-auto">
            Currently open for new opportunities and collaborations. Whether you have a question or just want to say hi, I&apos;ll try my best to get back to you!
        </p>
        @if($profile && $profile->email)
        <a class="font-label-caps text-label-caps px-8 py-4 rounded-full shadow-[var(--shadow-clay)] hover:shadow-[var(--shadow-clay-hover)] transition-all duration-300 inline-flex items-center gap-2 hover:-translate-y-1"
           href="mailto:{{ $profile->email }}" style="background-color: #F3E4C9; color: #0A2947;">
            Say Hello <span class="material-symbols-outlined">send</span>
        </a>
        @else
        <a class="font-label-caps text-label-caps px-8 py-4 rounded-full shadow-[var(--shadow-clay)] hover:shadow-[var(--shadow-clay-hover)] transition-all duration-300 inline-flex items-center gap-2 hover:-translate-y-1"
           href="#" style="background-color: #F3E4C9; color: #0A2947;">
            Say Hello <span class="material-symbols-outlined">send</span>
        </a>
        @endif
        @if($socialLinks->isNotEmpty())
        <div class="flex flex-wrap justify-center gap-6 mt-10">
            @foreach($socialLinks as $link)
            <a class="font-meta-technical text-meta-technical hover:text-[#D3D4C0] transition-colors duration-300 opacity-80 hover:opacity-100"
               href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                {{ $link->platform }}
            </a>
            @endforeach
        </div>
        @endif

        @if($profile && $profile->cv_file)
        <a href="{{ route('cv.download') }}" class="mt-8 font-meta-technical text-meta-technical text-[#D3D4C0] hover:text-[#F3E4C9] transition-colors duration-300 inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px]">description</span>
            Download CV (PDF)
        </a>
        @endif
    </div>
</section>
