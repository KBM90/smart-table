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

<body
    class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/20 to-emerald-50/30 font-sans text-slate-800 antialiased">
    <div class="min-h-screen relative overflow-hidden">

        <header class="border-b border-slate-200/80 bg-white/70 backdrop-blur-md sticky top-0 z-50">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-8">

                    <div>
                        <p
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">
                            Owner Dashboard
                        </p>
                        <p class="mt-1 text-lg font-black text-slate-900">
                            {{ app(\App\Support\CurrentTenant::class)->tenant()?->name }}
                        </p>
                    </div>

                    @php
                        $navLinks = [
                            ['label' => 'Dashboard', 'route' => 'owner.dashboard', 'match' => 'owner.dashboard'],
                            ['label' => 'Tables', 'route' => 'owner.tables.index', 'match' => 'owner.tables.*'],
                            ['label' => 'Products', 'route' => 'owner.products.index', 'match' => 'owner.products.*'],
                            ['label' => 'Categories', 'route' => 'owner.categories.index', 'match' => 'owner.categories.*'],
                            ['label' => 'Staff', 'route' => 'owner.staff.index', 'match' => 'owner.staff.*'],
                            ['label' => 'Requests', 'route' => 'owner.requests.index', 'match' => 'owner.requests.*'],
                            ['label' => 'Billing', 'route' => 'owner.billing.index', 'match' => 'owner.billing.*'],
                        ];
                    @endphp

                    <nav class="hidden md:flex items-center gap-1 font-semibold text-sm">
                        @foreach ($navLinks as $link)
                                            <a href="{{ route($link['route']) }}" class="rounded-xl px-3 py-2 transition
                                                                                                                      {{ request()->routeIs($link['match'])
                            ? 'text-indigo-600 bg-indigo-50/60 border border-indigo-100/40'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                                {{ $link['label'] }}
                                            </a>
                        @endforeach
                    </nav>

                </div>

                <div class="flex items-center gap-3">
                    {{-- Mobile nav --}}
                    <div x-data="{ open: false }" class="relative md:hidden">
                        <button @click="open = !open" type="button"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm">
                            Menu
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-2 w-44 rounded-2xl border border-slate-200 bg-white py-2 shadow-xl">
                            @foreach ($navLinks as $link)
                                                    <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-sm font-semibold transition
                                                                                                                                          {{ request()->routeIs($link['match'])
                                ? 'text-indigo-600 bg-indigo-50'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                                        {{ $link['label'] }}
                                                    </a>
                            @endforeach
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600 shadow-sm shadow-slate-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 py-10 relative z-10">
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