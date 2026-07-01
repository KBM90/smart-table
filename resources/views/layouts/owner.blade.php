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
    @if (request()->routeIs('owner.billing.*'))
        @paddleJS
    @endif
    @livewireStyles
</head>

<body
    class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/20 to-emerald-50/30 font-sans text-slate-800 antialiased">
    <script>document.documentElement.classList.add('loading');</script>
    @php
        $owner = auth()->user();
        $needsAccountVerification = $owner?->requiresAccountVerification() ?? false;
        $ownerNotificationCount = $needsAccountVerification ? 1 : 0;
        $appLocaleOptions = \App\Support\AppLocale::options();
    @endphp
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
    <div class="min-h-screen relative overflow-hidden">

        <header class="border-b border-slate-200/80 bg-white/70 backdrop-blur-md sticky top-0 z-50">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-8">

                    <div>
                        <p
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">
                            {{ __('owner.nav.owner_dashboard') }}
                        </p>
                        <p class="mt-1 text-lg font-black text-slate-900">
                            {{ app(\App\Support\CurrentTenant::class)->tenant()?->name }}
                        </p>
                    </div>

                    @php
                        $navLinks = [
                            ['label' => __('owner.nav.dashboard'), 'route' => 'owner.dashboard', 'match' => 'owner.dashboard'],
                            ['label' => __('owner.nav.tables'), 'route' => 'owner.tables.index', 'match' => 'owner.tables.*'],
                            ['label' => __('owner.nav.products'), 'route' => 'owner.products.index', 'match' => 'owner.products.*'],
                            ['label' => __('owner.nav.staff'), 'route' => 'owner.staff.index', 'match' => 'owner.staff.*'],
                            ['label' => __('owner.nav.performance'), 'route' => 'owner.waiters.index', 'match' => 'owner.waiters.*'],
                            ['label' => __('owner.nav.requests'), 'route' => 'owner.requests.index', 'match' => 'owner.requests.*'],
                            ['label' => __('owner.nav.settings'), 'route' => 'owner.settings.edit', 'match' => 'owner.settings.*'],
                            ['label' => __('owner.nav.billing'), 'route' => 'owner.billing.index', 'match' => 'owner.billing.*'],
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
                    <form method="GET" action="{{ url()->current() }}" class="hidden sm:block">
                        @foreach (request()->except('lang') as $key => $value)
                            @if (is_scalar($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <label for="owner-language" class="sr-only">{{ __('owner.language') }}</label>
                        <select id="owner-language" name="lang" onchange="this.form.submit()"
                            class="h-10 rounded-xl border border-slate-200 bg-white px-3 text-sm font-bold text-slate-700 shadow-sm shadow-slate-100 transition hover:border-indigo-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @foreach ($appLocaleOptions as $locale => $label)
                                <option value="{{ $locale }}" @selected(app()->getLocale() === $locale)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </form>

                    <details class="group relative">
                        <summary
                            class="flex h-10 w-10 cursor-pointer list-none items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm shadow-slate-100 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600">
                            <span class="sr-only">{{ __('owner.notifications.open') }}</span>
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                                <path
                                    d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8a6 6 0 0 0-12 0c0 4.499-1.411 5.956-2.738 7.326" />
                            </svg>
                            @if ($ownerNotificationCount > 0)
                                <span
                                    class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-600 px-1 text-[11px] font-black text-white ring-2 ring-white">
                                    {{ $ownerNotificationCount }}
                                </span>
                            @endif
                        </summary>
                        <div
                            class="absolute right-0 mt-3 w-80 rounded-lg border border-slate-200 bg-white p-3 shadow-xl shadow-slate-200/70">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                <p class="text-sm font-black text-slate-900">{{ __('owner.notifications.title') }}</p>
                                <span class="text-xs font-bold text-slate-400">{{ $ownerNotificationCount }}</span>
                            </div>

                            @if ($needsAccountVerification)
                                <a href="{{ route('owner.account-verification.show') }}"
                                    class="mt-3 block rounded-lg border border-amber-200 bg-amber-50 p-3 transition hover:bg-amber-100">
                                    <span class="block text-sm font-black text-amber-900">{{ __('owner.notifications.verify_title') }}</span>
                                    <span class="mt-1 block text-xs leading-5 text-amber-800">
                                        {{ __('owner.notifications.verify_body', ['method' => $owner->verification_method === 'whatsapp' ? 'WhatsApp' : 'email']) }}
                                    </span>
                                </a>
                            @else
                                <p class="py-6 text-center text-sm font-semibold text-slate-500">{{ __('owner.notifications.none') }}</p>
                            @endif
                        </div>
                    </details>

                    {{-- Mobile nav --}}
                    <div x-data="{ open: false }" class="relative md:hidden">
                        <button @click="open = !open" type="button"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm">
                            {{ __('owner.nav.menu') }}
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
                            {{ __('owner.nav.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 py-10 relative z-10">
            @if ($needsAccountVerification)
                <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 px-5 py-4 text-amber-900 shadow-sm">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-black">{{ __('owner.notifications.banner_title') }}</p>
                            <p class="mt-1 text-sm leading-6">
                                {{ __('owner.notifications.banner_body', [
                                    'action' => $owner->verification_code_sent_at
                                        ? __('owner.notifications.using_code_sent_to')
                                        : __('owner.notifications.by_sending_code_to'),
                                    'destination' => $owner->verificationDestination(),
                                ]) }}
                            </p>
                        </div>
                        <a href="{{ route('owner.account-verification.show') }}"
                            class="inline-flex items-center justify-center rounded-lg bg-amber-900 px-4 py-2 text-sm font-black text-white transition hover:bg-amber-800">
                            {{ __('owner.notifications.verify_now') }}
                        </a>
                    </div>
                </div>
            @endif

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
