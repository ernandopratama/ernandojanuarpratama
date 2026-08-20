<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #0A2947;">

    <div class="w-full max-w-md px-6 py-8">

        {{-- Logo / Brand --}}
        <div class="text-center mb-10">
            <a href="/" class="inline-block group">
                <div class="w-16 h-16 rounded-[2rem] flex items-center justify-center mx-auto mb-4 shadow-[var(--shadow-clay-dark)] group-hover:-translate-y-1 transition-all duration-300"
                     style="background-color: #F3E4C9;">
                    <span class="font-mono font-bold text-2xl" style="color: #0A2947;">EP.</span>
                </div>
            </a>
            <h1 class="text-2xl font-bold tracking-tight" style="color: #F3E4C9;">Admin Login</h1>
            <p class="mt-1 text-sm font-mono" style="color: #D3D4C0; opacity: 0.6;">Portfolio Management System</p>
        </div>

        {{-- Card --}}
        <div class="rounded-[2.5rem] p-8 md:p-10 shadow-[var(--shadow-clay-dark)]" style="background-color: #F3E4C9;">

            {{-- Auth error --}}
            @if ($errors->any())
            <div class="mb-6 px-4 py-3 rounded-xl text-sm font-medium" style="background-color: rgba(139,94,60,0.12); color: #8B5E3C; border: 1px solid rgba(139,94,60,0.25);">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold mb-2" style="color: #0A2947;">
                        Email Address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="admin@example.com"
                        class="w-full px-5 py-4 rounded-[1.5rem] text-sm outline-none transition-all duration-200 border-2 shadow-inner"
                        style="background-color: rgba(10,41,71,0.03); border-color: rgba(10,41,71,0.1); color: #0A2947;"
                        onfocus="this.style.borderColor='#8B5E3C'; this.style.backgroundColor='#ffffff'"
                        onblur="this.style.borderColor='rgba(10,41,71,0.1)'; this.style.backgroundColor='rgba(10,41,71,0.03)'"
                    >
                </div>

                {{-- Password --}}
                <div class="mb-7">
                    <label for="password" class="block text-sm font-semibold mb-2" style="color: #0A2947;">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-5 py-4 rounded-[1.5rem] text-sm outline-none transition-all duration-200 border-2 shadow-inner"
                        style="background-color: rgba(10,41,71,0.03); border-color: rgba(10,41,71,0.1); color: #0A2947;"
                        onfocus="this.style.borderColor='#8B5E3C'; this.style.backgroundColor='#ffffff'"
                        onblur="this.style.borderColor='rgba(10,41,71,0.1)'; this.style.backgroundColor='rgba(10,41,71,0.03)'"
                    >
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-4 px-6 rounded-full font-bold text-sm tracking-widest uppercase transition-all duration-300 hover:-translate-y-1 shadow-[var(--shadow-clay-dark)] hover:shadow-[var(--shadow-clay-dark-hover)]"
                    style="background-color: #0A2947; color: #F3E4C9;"
                    onclick="this.disabled=true; this.form.submit();"
                >
                    Sign In
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <div class="text-center mt-6">
            <a href="/" class="text-sm transition-colors duration-200 font-mono"
               style="color: #D3D4C0; opacity: 0.6;"
               onmouseover="this.style.opacity='1'"
               onmouseout="this.style.opacity='0.6'">
                &larr; Back to portfolio
            </a>
        </div>

    </div>

</body>
</html>