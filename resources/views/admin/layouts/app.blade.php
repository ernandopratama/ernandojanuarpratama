<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Console') — EJ Portfolio</title>

    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .tech-grid {
            background-size: 40px 40px;
            background-image:
                linear-gradient(to right, rgba(211, 197, 171, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(211, 197, 171, 0.05) 1px, transparent 1px);
        }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #121316; }
        ::-webkit-scrollbar-thumb { background: #343537; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #43474d; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex overflow-hidden">

    @include('admin.components.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-surface relative tech-grid">
        {{-- Mobile Header (Hidden on Desktop) --}}
        <header class="md:hidden bg-surface-container flex justify-between items-center p-4 border-b border-outline-variant/20 z-20 sticky top-0">
            <div class="font-headline-sm text-headline-sm font-bold text-primary">EJ Console</div>
            <button class="text-on-surface-variant hover:text-primary" id="mobile-menu-btn" type="button" aria-label="Toggle navigation">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-margin-mobile md:p-margin-desktop w-full max-w-container-max mx-auto relative z-0">
            {{-- Flash messages --}}
            @if (session('success'))
                <div class="mb-8 flex items-start gap-3 border border-secondary/40 bg-secondary-container/20 rounded-lg p-4">
                    <span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">check_circle</span>
                    <p class="font-body-md text-body-md text-on-secondary-container">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-8 flex items-start gap-3 border border-error/40 bg-error-container/20 rounded-lg p-4">
                    <span class="material-symbols-outlined text-error text-[20px] mt-0.5">error</span>
                    <p class="font-body-md text-body-md text-on-error-container">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Global validation summary --}}
            @if ($errors->any())
                <div class="mb-8 flex items-start gap-3 border border-error/40 bg-error-container/20 rounded-lg p-4">
                    <span class="material-symbols-outlined text-error text-[20px] mt-0.5">warning</span>
                    <div class="font-body-md text-body-md text-on-error-container">
                        <p class="font-label-caps text-label-caps uppercase tracking-widest mb-1">Please fix the following errors</p>
                        <ul class="list-disc list-inside gap-1 flex flex-col">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')

            <div class="h-section-gap"></div>
        </div>
    </main>

    @include('admin.components.confirm-dialog')

    @stack('scripts')
</body>
</html>