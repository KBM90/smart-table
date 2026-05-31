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
    <body class="min-h-screen bg-slate-950 font-sans text-slate-100 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-slate-800 bg-slate-900/90">
                <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-8">
                        <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-400">Owner</p>
                        <p class="mt-1 text-lg font-semibold">{{ auth()->user()->tenant?->name }}</p>
                        </div>

                        <nav class="flex items-center gap-3 text-sm">
                            <a href="{{ route('owner.dashboard') }}" class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">Dashboard</a>
                            <a href="{{ route('owner.tables.index') }}" class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">Tables</a>
                            <a href="{{ route('owner.products.index') }}" class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">Products</a>
                            <a href="{{ route('owner.staff.index') }}" class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">Staff</a>
                            <a href="{{ route('owner.requests.index') }}" class="rounded-lg px-3 py-2 font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">Requests</a>
                        </nav>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg border border-slate-700 px-4 py-2 text-sm font-medium text-slate-200 transition hover:border-amber-400 hover:text-amber-300">
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
        @livewireScripts
    </body>
</html>