<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($profile?->name ?? 'Ernando Januar Pratama') . ' — Portfolio')</title>
    <meta name="description" content="{{ Str::limit($profile?->short_bio ?? 'IT professional and software developer building reliable digital products, web applications, and technology solutions.', 160) }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#0A2947">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='12' fill='%230A2947'/%3E%3Ctext x='32' y='43' font-family='Arial,sans-serif' font-size='28' font-weight='bold' fill='%23F3E4C9' text-anchor='middle'%3EEP%3C/text%3E%3C/svg%3E">

    {{-- Open Graph / Twitter --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $profile?->name ?? 'Ernando Januar Pratama' }}">
    <meta property="og:title" content="{{ $profile?->name ?? 'Ernando Januar Pratama' }}">
    <meta property="og:description" content="{{ Str::limit($profile?->short_bio ?? 'IT professional and software developer building reliable digital products, web applications, and technology solutions.', 160) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $profile?->profile_image ? asset('storage/' . $profile?->profile_image) : asset('og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $profile?->name ?? 'Ernando Januar Pratama' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $profile?->name ?? 'Ernando Januar Pratama' }}">
    <meta name="twitter:description" content="{{ Str::limit($profile?->short_bio ?? 'IT professional and software developer building reliable digital products, web applications, and technology solutions.', 160) }}">
    <meta name="twitter:image" content="{{ $profile?->profile_image ? asset('storage/' . $profile?->profile_image) : asset('og-image.png') }}">

    {{-- Structured data: Person --}}
    @php
        $seoName = $profile?->name ?? 'Ernando Januar Pratama';
        $seoDescription = $profile?->short_bio ?? 'IT professional and software developer building reliable digital products, web applications, and technology solutions.';
        $seoImage = $profile?->profile_image ? asset('storage/' . $profile?->profile_image) : asset('og-image.png');
        $seoData = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $seoName,
            'url' => url('/'),
            'image' => $seoImage,
            'jobTitle' => 'Software Developer',
            'description' => $profile?->short_bio ?? null,
            'email' => $profile?->email ? 'mailto:' . $profile?->email : null,
            'address' => $profile?->location ? ['@type' => 'PostalAddress', 'addressLocality' => $profile?->location] : null,
            'sameAs' => $socialLinks->pluck('url')->values()->all(),
        ];
    @endphp
    <script type="application/ld+json">
    @json($seoData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background-color: #0A2947; color: #e3e2e5; }
        .grid-bg {
            background-size: 40px 40px;
            background-image:
                linear-gradient(to right, rgba(141, 145, 152, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(141, 145, 152, 0.05) 1px, transparent 1px);
        }
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        @keyframes premiumEntrance {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hero-animate {
            opacity: 0;
            animation: premiumEntrance 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        .hero-delay-1 { animation-delay: 0.1s; }
        .hero-delay-2 { animation-delay: 0.3s; }
        .hero-delay-3 { animation-delay: 0.5s; }
        .hero-delay-4 { animation-delay: 0.7s; }

        .project-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .project-card:hover {
            transform: translateY(-8px) scale(1.02);
        }
        
        body.modal-open {
            overflow: hidden;
        }
    </style>
</head>
<body class="font-body-md text-body-md antialiased overflow-x-hidden selection:bg-primary-container selection:text-primary">
    
    @yield('content')

    @stack('scripts')
</body>
</html>
