<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.realtime-config')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    <script>document.documentElement.classList.add('loading');</script>
    <div id="page-loader"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-white/60 backdrop-blur-md transition-opacity duration-500">

        <svg class="w-32 h-32 drop-shadow-xl" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">

            <path class="svg-draw-path" d="M 85 45 L 35 45 C 20 45 20 65 35 65 L 65 65 C 80 65 80 85 65 85 L 25 85"
                stroke="#0f766e" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />

            <path class="svg-draw-path" d="M 25 85 L 35 95 L 65 95 C 85 95 90 75 75 60" stroke="#0f766e"
                stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />

            <line class="svg-draw-path" x1="65" y1="65" x2="90" y2="35" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="105" y2="55" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="95" y2="85" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="60" y2="25" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />

            <circle class="svg-node" cx="90" cy="35" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="105" cy="55" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="95" cy="85" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="60" cy="25" r="5" fill="#14b8a6" />

        </svg>
    </div>
    <div class="min-h-screen">
        <header class="border-b border-slate-200 bg-white/95">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-8">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-600">Waiter</p>
                        <p class="mt-1 text-lg font-semibold">{{ auth()->user()->tenant?->name }}</p>
                    </div>

                    <nav class="flex items-center gap-3 text-sm">
                        <a href="{{ route('waiter.dashboard') }}"
                            class="rounded-lg px-3 py-2 font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Dashboard</a>
                        <a href="{{ route('waiter.requests.index') }}"
                            class="rounded-lg px-3 py-2 font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Requests</a>
                        <a href="{{ route('waiter.tables.index') }}"
                            class="rounded-lg px-3 py-2 font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Tables</a>

                    </nav>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-sky-500 hover:text-sky-700">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 py-10">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>
    </div>
    @stack('scripts') {{-- add this line --}}

    @livewireScripts
</body>

</html>