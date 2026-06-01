<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Smart Table</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 font-sans text-slate-900 antialiased">
        @php($navLinks = [
            ['label' => 'Features', 'href' => '#features'],
            ['label' => 'How it works', 'href' => '#how-it-works'],
            ['label' => 'Pricing', 'href' => '#pricing'],
            ['label' => 'FAQ', 'href' => '#faq'],
        ])

        <div class="relative overflow-x-hidden">
            <div class="absolute inset-x-0 top-0 -z-10 h-[36rem] bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.14),_transparent_55%)]"></div>
            <div class="absolute right-0 top-24 -z-10 h-72 w-72 rounded-full bg-sky-200/40 blur-3xl"></div>

            <header
                x-data="{ mobileOpen: false, scrolled: false }"
                x-init="scrolled = window.scrollY > 12; window.addEventListener('scroll', () => scrolled = window.scrollY > 12)"
                class="sticky top-0 z-50"
            >
                <nav
                    class="border-b transition duration-300"
                    :class="scrolled ? 'border-slate-200/80 bg-white/90 backdrop-blur-xl shadow-sm' : 'border-transparent bg-white/70 backdrop-blur-md'"
                    aria-label="Primary"
                >
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex h-18 items-center justify-between gap-4">
                            <a href="/" class="flex items-center gap-3" aria-label="Smart Table home">
                                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <rect x="4.5" y="5.5" width="15" height="4" rx="1.5"></rect>
                                        <path d="M7.5 9.5v9m9-9v9M5.5 18.5h13"></path>
                                        <path d="M9 3.5v2m6-2v2"></path>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-lg font-semibold tracking-tight text-slate-950">Smart Table</p>
                                    <p class="text-xs font-medium text-slate-500">Restaurant service, simplified</p>
                                </div>
                            </a>

                            <div class="hidden items-center gap-8 lg:flex">
                                @foreach ($navLinks as $link)
                                    <a href="{{ $link['href'] }}" class="text-sm font-medium text-slate-600 transition hover:text-slate-950">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach
                            </div>

                            <div class="hidden items-center gap-3 lg:flex">
                                @auth
                                    <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-white hover:text-slate-950">
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" class="rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700">
                                        Get started
                                    </a>
                                @endauth
                            </div>

                            <button
                                type="button"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:text-slate-950 lg:hidden"
                                @click="mobileOpen = !mobileOpen"
                                :aria-expanded="mobileOpen.toString()"
                                aria-controls="mobile-menu"
                                aria-label="Toggle navigation menu"
                            >
                                <svg x-show="!mobileOpen" x-transition.opacity class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M4 7h16M4 12h16M4 17h16"></path>
                                </svg>
                                <svg x-show="mobileOpen" x-transition.opacity class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M6 6l12 12M18 6L6 18"></path>
                                </svg>
                            </button>
                        </div>

                        <div
                            id="mobile-menu"
                            x-show="mobileOpen"
                            x-transition.opacity.scale.origin.top
                            class="pb-4 lg:hidden"
                            @click.outside="mobileOpen = false"
                        >
                            <div class="space-y-2 rounded-3xl border border-slate-200 bg-white p-4 shadow-xl shadow-slate-200/60">
                                @foreach ($navLinks as $link)
                                    <a href="{{ $link['href'] }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100" @click="mobileOpen = false">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach

                                <div class="border-t border-slate-200 pt-2">
                                    @auth
                                        <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                                            Login
                                        </a>
                                        <a href="{{ route('register') }}" class="mt-2 block rounded-2xl bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                                            Get started
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                <section class="relative">
                    <div class="container mx-auto px-4 pb-20 pt-12 sm:px-6 lg:px-8 lg:pb-24 lg:pt-20">
                        <div class="grid items-center gap-14 lg:grid-cols-[1.1fr_0.9fr]">
                            <div class="max-w-2xl">
                                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-4 py-2 text-sm font-medium text-indigo-700 shadow-sm">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    Live table requests and menu browsing for cafés and restaurants
                                </div>
                                <h1 class="mt-6 text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                                    Turn every table into a smart waiter
                                </h1>
                                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                                    Smart Table lets guests scan a QR code, open a table session, browse the menu in real time, and call staff instantly. Your team gets a live dashboard built for fast service across every location.
                                </p>
                                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-700">
                                        Get started free
                                    </a>
                                    <a href="#how-it-works" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950">
                                        See how it works
                                    </a>
                                </div>
                                <dl class="mt-10 grid gap-4 text-sm text-slate-600 sm:grid-cols-3">
                                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <dt class="font-semibold text-slate-950">Multi-tenant</dt>
                                        <dd class="mt-1">Separate restaurants and staff with secure tenancy.</dd>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <dt class="font-semibold text-slate-950">Real-time</dt>
                                        <dd class="mt-1">Live updates for waiter calls with polling fallback.</dd>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <dt class="font-semibold text-slate-950">No app needed</dt>
                                        <dd class="mt-1">Guests scan once and use any phone browser.</dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="relative mx-auto w-full max-w-xl">
                                <div class="absolute -left-6 top-10 hidden h-32 w-32 rounded-full bg-indigo-200/60 blur-3xl sm:block"></div>
                                <div class="absolute -right-4 bottom-0 h-40 w-40 rounded-full bg-sky-200/50 blur-3xl"></div>

                                <div class="relative rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-2xl shadow-slate-200/70">
                                    <div class="rounded-[1.75rem] bg-slate-950 p-3">
                                        <div class="mx-auto flex h-[34rem] max-w-[20rem] flex-col rounded-[1.6rem] border border-white/10 bg-slate-900 p-4 text-white shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                                            <div class="mx-auto mb-4 h-1.5 w-20 rounded-full bg-white/15"></div>
                                            <div class="rounded-3xl bg-gradient-to-br from-indigo-500 via-sky-500 to-cyan-400 p-5">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <p class="text-xs uppercase tracking-[0.28em] text-white/70">Table 07</p>
                                                        <p class="mt-2 text-2xl font-semibold">Welcome back</p>
                                                    </div>
                                                    <div class="rounded-2xl bg-white/15 p-3 backdrop-blur">
                                                        <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                            <path d="M7 7h4v4H7zM13 7h4v4h-4zM7 13h4v4H7z"></path>
                                                            <path d="M13 13h1m3 0h-1m-3 4h4"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="mt-6 rounded-3xl bg-white/15 p-4 backdrop-blur">
                                                    <p class="text-sm text-white/80">Scan complete · session active</p>
                                                    <p class="mt-2 text-lg font-semibold">Need something?</p>
                                                    <button type="button" class="mt-4 flex w-full items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-indigo-700 shadow-sm">
                                                        Call waiter
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mt-4 grid grid-cols-2 gap-3">
                                                <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                                                    <p class="text-xs uppercase tracking-[0.24em] text-white/50">Menu</p>
                                                    <p class="mt-3 text-sm font-semibold">Today’s specials</p>
                                                    <p class="mt-2 text-xs leading-5 text-slate-300">Live catalog with images, categories, and prices.</p>
                                                </div>
                                                <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                                                    <p class="text-xs uppercase tracking-[0.24em] text-white/50">Status</p>
                                                    <p class="mt-3 text-sm font-semibold">2 min response</p>
                                                    <div class="mt-3 flex items-center gap-2 text-xs text-emerald-300">
                                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                                        Staff dashboard online
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 rounded-3xl border border-white/10 bg-white/5 p-4">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="text-sm font-semibold">Live dashboard sync</p>
                                                        <p class="mt-1 text-xs text-slate-300">Requests stream instantly to your team.</p>
                                                    </div>
                                                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-400/10 text-emerald-300">
                                                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                            <path d="M5 12a7 7 0 0 1 14 0"></path>
                                                            <path d="M8.5 12a3.5 3.5 0 0 1 7 0"></path>
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pointer-events-none absolute -right-5 top-12 hidden rounded-3xl border border-slate-200 bg-white p-4 shadow-xl lg:block">
                                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Staff alert</p>
                                        <p class="mt-2 text-sm font-semibold text-slate-900">Table 07 called waiter</p>
                                        <p class="mt-1 text-xs text-slate-500">Received instantly on the dashboard.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="border-y border-slate-200 bg-white/80">
                    <div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                            @foreach ([
                                ['title' => 'No app to install', 'copy' => 'Customers scan a QR code and use the browser they already have.'],
                                ['title' => 'Real-time table calls', 'copy' => 'Waiter requests appear live with a resilient polling fallback.'],
                                ['title' => 'Multi-tenant ready', 'copy' => 'Built for multiple venues with staff roles and isolated data.'],
                                ['title' => 'Works on any device', 'copy' => 'Phones, tablets, and desktop dashboards stay in sync.'],
                            ] as $prop)
                                <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                                    <span class="mt-1 flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path d="M12 3v18M3 12h18"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <h2 class="font-semibold text-slate-950">{{ $prop['title'] }}</h2>
                                        <p class="mt-1 text-sm leading-6 text-slate-600">{{ $prop['copy'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="features" class="py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Features</p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Everything your dining room needs to stay responsive</h2>
                            <p class="mt-4 text-lg text-slate-600">Smart Table is designed around the features already powering your café or restaurant workflow.</p>
                        </div>

                        <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ([
                                ['title' => 'QR per table', 'copy' => 'Generate unique QR codes for every table so guests always land in the right place.', 'icon' => 'qr'],
                                ['title' => 'Customer sessions', 'copy' => 'Open table sessions tied to the guest visit for a smooth self-service experience.', 'icon' => 'session'],
                                ['title' => 'Call waiter', 'copy' => 'Let customers request staff assistance instantly with one tap from the table page.', 'icon' => 'bell'],
                                ['title' => 'Live dashboard', 'copy' => 'Staff receive live requests immediately, with polling fallback when needed.', 'icon' => 'pulse'],
                                ['title' => 'Product catalog', 'copy' => 'Publish menus with categories, pricing, and an image library your team can manage.', 'icon' => 'catalog'],
                                ['title' => 'Secure tenancy', 'copy' => 'Owner and staff roles stay scoped to their restaurant with RLS-backed isolation.', 'icon' => 'shield'],
                            ] as $feature)
                                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                        @if ($feature['icon'] === 'qr')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z"></path><path d="M14 14h2m4 0h-2m-4 4h6"></path></svg>
                                        @elseif ($feature['icon'] === 'session')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="8"></circle></svg>
                                        @elseif ($feature['icon'] === 'bell')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M15 17H5l1.4-1.4A2 2 0 0 0 7 14.2V11a5 5 0 1 1 10 0v3.2a2 2 0 0 0 .6 1.4L19 17h-4"></path><path d="M10 19a2 2 0 0 0 4 0"></path></svg>
                                        @elseif ($feature['icon'] === 'pulse')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 12h4l2-5 4 10 2-5h6"></path></svg>
                                        @elseif ($feature['icon'] === 'catalog')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 6.5A2.5 2.5 0 0 1 7.5 4H19v16H7.5A2.5 2.5 0 0 0 5 22z"></path><path d="M5 6.5V20"></path></svg>
                                        @else
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l7 4v5c0 5-3 8-7 9-4-1-7-4-7-9V7z"></path><path d="M9.5 12l1.8 1.8 3.7-3.8"></path></svg>
                                        @endif
                                    </span>
                                    <h3 class="mt-5 text-xl font-semibold text-slate-950">{{ $feature['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $feature['copy'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="how-it-works" class="bg-white py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">How it works</p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">From printed QR to live request in three simple steps</h2>
                        </div>

                        <div class="mt-12 grid gap-6 lg:grid-cols-3">
                            @foreach ([
                                ['step' => '01', 'title' => 'Print QR codes for each table', 'copy' => 'Set up a unique QR code per table so every guest starts in the right session.'],
                                ['step' => '02', 'title' => 'Customer scans and interacts', 'copy' => 'Guests browse the menu in real time or call the waiter from their phone.'],
                                ['step' => '03', 'title' => 'Staff sees live dashboard requests', 'copy' => 'Your team receives incoming calls instantly inside the authenticated dashboard.'],
                            ] as $item)
                                <div class="relative rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-sm font-semibold text-white">{{ $item['step'] }}</div>
                                    <h3 class="mt-6 text-xl font-semibold text-slate-950">{{ $item['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['copy'] }}</p>
                                    @if (! $loop->last)
                                        <div class="mt-6 hidden h-px bg-gradient-to-r from-indigo-200 via-slate-200 to-transparent lg:block"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="pricing" class="py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl rounded-[2rem] border border-indigo-100 bg-gradient-to-br from-indigo-600 to-sky-500 p-8 text-white shadow-2xl shadow-indigo-600/20 sm:p-10">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-100">Pricing</p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Free during beta</h2>
                            <p class="mt-4 text-base leading-7 text-indigo-50">Start onboarding your venue now, test live table calls, and shape the product with your team before billing launches.</p>
                            <div class="mt-8 flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-4xl font-semibold">€0</p>
                                    <p class="mt-2 text-sm text-indigo-100">No billing setup required yet.</p>
                                </div>
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-indigo-700 shadow-lg transition hover:bg-indigo-50">
                                    Get started
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="faq" class="bg-white py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">FAQ</p>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Questions restaurant teams usually ask first</h2>
                                <p class="mt-4 text-lg text-slate-600">Everything below is tailored to the current Smart Table product and infrastructure.</p>
                            </div>

                            <div class="space-y-4">
                                @foreach ([
                                    ['q' => 'Do customers need an app?', 'a' => 'No. Guests simply scan the QR code and use Smart Table directly in their mobile browser.'],
                                    ['q' => 'Does it work offline?', 'a' => 'Customers need connectivity to load the session and send requests. When the connection is weak, the staff side still benefits from polling fallback for resilience.'],
                                    ['q' => 'How is data isolated between restaurants?', 'a' => 'Each restaurant is treated as its own tenant, with staff roles scoped to that tenant and data protected through RLS-backed isolation.'],
                                    ['q' => 'Can I customize the menu?', 'a' => 'Yes. Owners can manage the product catalog, categories, pricing, and image library from the dashboard.'],
                                    ['q' => 'What languages are supported?', 'a' => 'The current landing page and default copy are in English. The product can be extended with localized content as your rollout grows.'],
                                ] as $faq)
                                    <div x-data="{ open: false }" class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                        <button
                                            type="button"
                                            class="flex w-full items-center justify-between gap-4 text-left"
                                            @click="open = !open"
                                            :aria-expanded="open.toString()"
                                        >
                                            <span class="text-base font-semibold text-slate-950">{{ $faq['q'] }}</span>
                                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-slate-500">
                                                <svg class="h-5 w-5 transition duration-200" :class="open ? 'rotate-45' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                    <path d="M12 5v14M5 12h14"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <div x-show="open" x-transition.opacity.duration.200ms class="pt-4 text-sm leading-6 text-slate-600">
                                            {{ $faq['a'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-20">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="rounded-[2rem] bg-slate-950 px-8 py-12 text-white shadow-2xl shadow-slate-300/20 sm:px-10 lg:flex lg:items-center lg:justify-between">
                            <div class="max-w-2xl">
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-300">Start now</p>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Give every table a faster way to reach your staff</h2>
                                <p class="mt-4 text-base leading-7 text-slate-300">Launch Smart Table for your café or restaurant and keep service moving with live customer requests and menu access.</p>
                            </div>
                            <div class="mt-8 lg:mt-0">
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:bg-indigo-400">
                                    Get started
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-slate-200 bg-white">
                <div class="container mx-auto flex flex-col gap-8 px-4 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-900 text-white">
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <rect x="4.5" y="5.5" width="15" height="4" rx="1.5"></rect>
                                    <path d="M7.5 9.5v9m9-9v9M5.5 18.5h13"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-base font-semibold text-slate-950">Smart Table</p>
                                <p class="text-sm text-slate-500">Live table service for modern restaurants.</p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-slate-500">© 2026 Smart Table</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-slate-600">
                        <a href="{{ route('login') }}" class="transition hover:text-slate-950">Login</a>
                        <a href="{{ route('register') }}" class="transition hover:text-slate-950">Register</a>
                        <a href="#" class="transition hover:text-slate-950">Privacy</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>