@extends('layouts.guest')

@section('content')
    @php($navLinks = [
        ['label' => 'Features', 'href' => '#features'],
        ['label' => 'How it works', 'href' => '#how-it-works'],
        ['label' => 'Pricing', 'href' => '/pricing'],
        ['label' => 'FAQ', 'href' => '#faq'],
    ])
    <div class="relative overflow-x-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[36rem] bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.12),_transparent_55%)]"></div>
        <div class="absolute right-0 top-24 -z-10 h-72 w-72 rounded-full bg-sky-200/30 blur-3xl"></div>
        <header
            x-data="{ mobileOpen: false, scrolled: false }"
            x-init="scrolled = window.scrollY > 12; window.addEventListener('scroll', () => scrolled = window.scrollY > 12)"
            class="sticky top-0 z-50 transition-all duration-300"
            :class="scrolled ? 'border-b border-slate-200/80 bg-white/80 backdrop-blur-xl shadow-sm' : 'border-transparent bg-transparent'"
        >
            <nav aria-label="Primary">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 md:h-20 items-center justify-between gap-4">
                        
                        <a href="/" class="flex items-center gap-3 transition hover:opacity-80" aria-label="Smart Table home">
                            <img 
                                src="{{ asset('img/system/logo_with_text.png') }}"
                                alt="Smart Table"
                                class="h-20 md:h-14 w-auto object-contain"
                            />
                        </a>

                        <div class="hidden items-center gap-8 lg:flex">
                            @foreach ($navLinks as $link)
                                <a href="{{ $link['href'] }}" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                        
                        <div class="hidden items-center gap-4 lg:flex">
                            @auth
                                <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 hover:-translate-y-0.5">
                                    Get started
                                </a>
                            @endauth
                        </div>
                        
                        <button
                            type="button"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 lg:hidden"
                            @click="mobileOpen = !mobileOpen"
                            :aria-expanded="mobileOpen.toString()"
                            aria-controls="mobile-menu"
                            aria-label="Toggle navigation menu"
                        >
                            <svg x-show="!mobileOpen" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M4 7h16M4 12h16M4 17h16"></path>
                            </svg>
                            <svg x-show="mobileOpen" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M6 6l12 12M18 6L6 18"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div
                        id="mobile-menu"
                        x-show="mobileOpen"
                        x-transition.opacity.scale.origin.top
                        x-cloak
                        class="pb-4 lg:hidden"
                        @click.outside="mobileOpen = false"
                    >
                        <div class="space-y-1 rounded-3xl border border-slate-200 bg-white/90 p-4 shadow-xl shadow-slate-200/60 backdrop-blur-xl">
                            @foreach ($navLinks as $link)
                                <a href="{{ $link['href'] }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600" @click="mobileOpen = false">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                            <div class="my-2 h-px bg-slate-100"></div>
                            
                            @auth
                                <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="mt-2 block rounded-2xl bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                                    Get started
                                </a>
                            @endauth
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
                            <div class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50/50 px-4 py-2 text-sm font-medium text-indigo-700 shadow-sm backdrop-blur-sm">
                                <span class="relative flex h-2.5 w-2.5 items-center justify-center">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                </span>
                                Live table requests and menu browsing
                            </div>
                            <h1 class="mt-8 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl lg:leading-[1.1]">
                                Turn every table into a <span class="text-indigo-600">smart waiter</span>
                            </h1>
                            <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                                Smart Table lets guests scan a QR code, open a table session, browse the menu in real time, and call staff instantly. Your team gets a live dashboard built for fast service.
                            </p>
                            <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-700 hover:-translate-y-0.5">
                                    Get started free
                                </a>
                                <a href="#how-it-works" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900">
                                    See how it works
                                </a>
                            </div>
                            <dl class="mt-10 grid gap-4 text-sm text-slate-600 sm:grid-cols-3">
                                <div class="rounded-2xl border border-slate-200/60 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
                                    <dt class="font-semibold text-slate-900">Multi-tenant</dt>
                                    <dd class="mt-1">Secure tenancy for isolated staff and data.</dd>
                                </div>
                                <div class="rounded-2xl border border-slate-200/60 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
                                    <dt class="font-semibold text-slate-900">Real-time</dt>
                                    <dd class="mt-1">Live call updates with robust polling fallback.</dd>
                                </div>
                                <div class="rounded-2xl border border-slate-200/60 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
                                    <dt class="font-semibold text-slate-900">No app needed</dt>
                                    <dd class="mt-1">Guests use any phone browser instantly.</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="relative mx-auto w-full max-w-xl lg:max-w-none">
                            <div class="absolute -left-6 top-10 hidden h-40 w-40 rounded-full bg-indigo-200/50 blur-3xl sm:block"></div>
                            <div class="absolute -right-4 bottom-0 h-40 w-40 rounded-full bg-sky-200/40 blur-3xl"></div>
                            <div class="relative rounded-[2.5rem] border border-slate-200/80 bg-white p-4 shadow-2xl shadow-indigo-100 lg:p-6">
                                <div class="rounded-[2rem] bg-slate-950 p-3 shadow-inner">
                                    <div class="mx-auto flex h-[36rem] max-w-[20rem] flex-col rounded-[1.5rem] border border-white/10 bg-slate-900 p-4 text-white shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                                        <div class="mx-auto mb-5 h-1.5 w-16 rounded-full bg-white/20"></div>
                                        <div class="rounded-3xl bg-gradient-to-br from-indigo-500 via-sky-500 to-cyan-400 p-5 shadow-lg">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-white/80">Table 07</p>
                                                    <p class="mt-1 text-2xl font-bold tracking-tight">Welcome back</p>
                                                </div>
                                                <div class="rounded-2xl bg-white/20 p-2.5 backdrop-blur-md">
                                                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                        <path d="M7 7h4v4H7zM13 7h4v4h-4zM7 13h4v4H7z"></path>
                                                        <path d="M13 13h1m3 0h-1m-3 4h4"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="mt-6 rounded-2xl bg-white/20 p-4 backdrop-blur-md">
                                                <div class="flex items-center gap-2 text-xs font-medium text-white/90">
                                                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span> Session active
                                                </div>
                                                <p class="mt-2 text-lg font-semibold">Need something?</p>
                                                <button type="button" class="mt-4 flex w-full items-center justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-indigo-700 shadow-sm transition hover:bg-indigo-50">
                                                    Call waiter
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-4 grid grid-cols-2 gap-3">
                                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">
                                                <p class="text-[10px] font-bold uppercase tracking-wider text-white/50">Menu</p>
                                                <p class="mt-2 text-sm font-semibold">Today’s specials</p>
                                                <p class="mt-1 text-xs text-slate-400">Live catalog & prices</p>
                                            </div>
                                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">
                                                <p class="text-[10px] font-bold uppercase tracking-wider text-white/50">Status</p>
                                                <p class="mt-2 text-sm font-semibold">2 min response</p>
                                                <div class="mt-2 flex items-center gap-1.5 text-xs font-medium text-emerald-400">
                                                    <svg viewBox="0 0 24 24" class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5"></path></svg>
                                                    Staff online
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto rounded-2xl border border-indigo-500/30 bg-indigo-500/10 p-4 backdrop-blur-md">
                                            <div class="flex items-center gap-3">
                                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-500/20 text-indigo-300">
                                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                        <path d="M5 12a7 7 0 0 1 14 0"></path>
                                                        <path d="M8.5 12a3.5 3.5 0 0 1 7 0"></path>
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                    </svg>
                                                </span>
                                                <div>
                                                    <p class="text-sm font-semibold text-indigo-100">Live dashboard sync</p>
                                                    <p class="text-xs text-indigo-300/80">Requests stream instantly</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pointer-events-none absolute -right-6 top-16 hidden rounded-2xl border border-slate-200 bg-white/95 p-4 shadow-2xl backdrop-blur-sm lg:block">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600">
                                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 17H5l1.4-1.4A2 2 0 0 0 7 14.2V11a5 5 0 1 1 10 0v3.2a2 2 0 0 0 .6 1.4L19 17h-4"></path><path d="M10 19a2 2 0 0 0 4 0"></path></svg>
                                        </span>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">Table 07 called</p>
                                            <p class="text-xs font-medium text-slate-500">Just now</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="border-y border-slate-200/60 bg-white/60 backdrop-blur-md">
                <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                        @foreach ([
                            ['title' => 'No app to install', 'copy' => 'Customers scan a QR code and use the browser they already have.'],
                            ['title' => 'Real-time table calls', 'copy' => 'Waiter requests appear live with a resilient polling fallback.'],
                            ['title' => 'Multi-tenant ready', 'copy' => 'Built for multiple venues with staff roles and isolated data.'],
                            ['title' => 'Works on any device', 'copy' => 'Phones, tablets, and desktop dashboards stay in sync.'],
                        ] as $prop)
                            <div class="flex items-start gap-4">
                                <span class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 shadow-sm border border-indigo-100">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path d="M12 3v18M3 12h18"></path>
                                    </svg>
                                </span>
                                <div>
                                    <h2 class="text-sm font-bold text-slate-900">{{ $prop['title'] }}</h2>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ $prop['copy'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="features" class="py-20 sm:py-28">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-2xl">
                        <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">Features</p>
                        <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Everything your dining room needs</h2>
                        <p class="mt-4 text-lg leading-8 text-slate-600">Smart Table is designed around the features already powering your café or restaurant workflow to keep you responsive.</p>
                    </div>
                    <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([
                            ['title' => 'QR per table', 'copy' => 'Generate unique QR codes for every table so guests always land in the right place.', 'icon' => 'qr'],
                            ['title' => 'Customer sessions', 'copy' => 'Open table sessions tied to the guest visit for a smooth self-service experience.', 'icon' => 'session'],
                            ['title' => 'Call waiter', 'copy' => 'Let customers request staff assistance instantly with one tap from the table page.', 'icon' => 'bell'],
                            ['title' => 'Live dashboard', 'copy' => 'Staff receive live requests immediately, with polling fallback when needed.', 'icon' => 'pulse'],
                            ['title' => 'Product catalog', 'copy' => 'Publish menus with categories, pricing, and an image library your team can manage.', 'icon' => 'catalog'],
                            ['title' => 'Secure tenancy', 'copy' => 'Owner and staff roles stay scoped to their restaurant with RLS-backed isolation.', 'icon' => 'shield'],
                        ] as $feature)
                            <article class="group relative rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition hover:shadow-md hover:border-indigo-100">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white">
                                    @if ($feature['icon'] === 'qr')
                                        <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z"></path><path d="M14 14h2m4 0h-2m-4 4h6"></path></svg>
                                    @elseif ($feature['icon'] === 'session')
                                        <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="8"></circle></svg>
                                    @elseif ($feature['icon'] === 'bell')
                                        <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M15 17H5l1.4-1.4A2 2 0 0 0 7 14.2V11a5 5 0 1 1 10 0v3.2a2 2 0 0 0 .6 1.4L19 17h-4"></path><path d="M10 19a2 2 0 0 0 4 0"></path></svg>
                                    @elseif ($feature['icon'] === 'pulse')
                                        <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 12h4l2-5 4 10 2-5h6"></path></svg>
                                    @elseif ($feature['icon'] === 'catalog')
                                        <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 6.5A2.5 2.5 0 0 1 7.5 4H19v16H7.5A2.5 2.5 0 0 0 5 22z"></path><path d="M5 6.5V20"></path></svg>
                                    @else
                                        <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3l7 4v5c0 5-3 8-7 9-4-1-7-4-7-9V7z"></path><path d="M9.5 12l1.8 1.8 3.7-3.8"></path></svg>
                                    @endif
                                </span>
                                <h3 class="mt-6 text-lg font-bold text-slate-900">{{ $feature['title'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $feature['copy'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="how-it-works" class="bg-slate-900 py-20 sm:py-28 text-white">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-2xl">
                        <p class="text-sm font-bold uppercase tracking-widest text-indigo-400">How it works</p>
                        <h2 class="mt-4 text-3xl font-extrabold tracking-tight sm:text-4xl">From printed QR to live request in three steps</h2>
                    </div>
                    <div class="mt-16 grid gap-8 lg:grid-cols-3">
                        @foreach ([
                            ['step' => '01', 'title' => 'Print QR codes', 'copy' => 'Set up a unique QR code per table so every guest starts in the right session.'],
                            ['step' => '02', 'title' => 'Customer scans', 'copy' => 'Guests browse the menu in real time or call the waiter from their phone.'],
                            ['step' => '03', 'title' => 'Staff responds', 'copy' => 'Your team receives incoming calls instantly inside the authenticated dashboard.'],
                        ] as $item)
                            <div class="relative rounded-3xl border border-slate-700 bg-slate-800 p-8 shadow-sm">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-500 text-sm font-bold text-white shadow-lg">{{ $item['step'] }}</div>
                                <h3 class="mt-6 text-xl font-bold text-white">{{ $item['title'] }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-300">{{ $item['copy'] }}</p>
                                @if (! $loop->last)
                                    <div class="mt-8 hidden h-px w-full bg-gradient-to-r from-slate-700 to-transparent lg:block"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="pricing" class="py-24 sm:py-32 bg-slate-50">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-4xl text-center">
                        <h2 class="text-sm font-bold uppercase tracking-widest text-indigo-600">Pricing</h2>
                        <p class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Simple, transparent pricing</p>
                        <p class="mt-6 text-lg leading-8 text-slate-600">Choose the plan that fits your restaurant or cafe workflow. Start for free, upgrade when you are ready.</p>
                    </div>
                    <div class="isolate mx-auto mt-16 grid max-w-md grid-cols-1 gap-y-8 sm:mt-20 lg:mx-auto lg:max-w-none lg:grid-cols-3 lg:gap-x-8 xl:gap-x-12">
                        
                        <div class="rounded-3xl p-8 ring-1 ring-slate-200 bg-white xl:p-10 flex flex-col justify-between shadow-sm hover:shadow-md transition">
                            <div>
                                <h3 id="tier-trial" class="text-lg font-bold leading-8 text-slate-900">7-Day Trial</h3>
                                <p class="mt-4 text-sm leading-6 text-slate-500">Test drive the complete Smart Table experience.</p>
                                <p class="mt-6 flex items-baseline gap-x-1">
                                    <span class="text-4xl font-bold tracking-tight text-slate-900">$0</span>
                                    <span class="text-sm font-semibold leading-6 text-slate-500">/ 1 week</span>
                                </p>
                                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-slate-600">
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Full platform access</li>
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Unlimited QR menus</li>
                                </ul>
                            </div>
                            <a href="/register?plan=trial" aria-describedby="tier-trial" class="mt-8 block rounded-xl bg-slate-50 px-3 py-3 text-center text-sm font-bold leading-6 text-slate-700 ring-1 ring-inset ring-slate-200 hover:bg-slate-100 transition">Start Free Trial</a>
                        </div>
                        <div class="rounded-3xl p-8 ring-1 ring-slate-200 bg-white xl:p-10 flex flex-col justify-between shadow-sm hover:shadow-md transition">
                            <div>
                                <h3 id="tier-monthly" class="text-lg font-bold leading-8 text-slate-900">Monthly</h3>
                                <p class="mt-4 text-sm leading-6 text-slate-500">Perfect for growing cafes needing flexibility.</p>
                                <p class="mt-6 flex items-baseline gap-x-1">
                                    <span class="text-4xl font-bold tracking-tight text-slate-900">$28</span>
                                    <span class="text-sm font-semibold leading-6 text-slate-500">/ month</span>
                                </p>
                                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-slate-600">
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Waiter accounts</li>
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Tenant-scoped dashboards</li>
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Standard support</li>
                                </ul>
                            </div>
                            <a href="/register?plan=monthly" aria-describedby="tier-monthly" class="mt-8 block rounded-xl bg-indigo-600 px-3 py-3 text-center text-sm font-bold leading-6 text-white shadow-sm hover:bg-indigo-500 transition">Subscribe Monthly</a>
                        </div>
                        <div class="rounded-3xl p-8 ring-2 ring-indigo-600 bg-slate-900 xl:p-10 flex flex-col justify-between relative shadow-xl">
                            <div class="absolute -top-4 right-8 rounded-full bg-indigo-500 px-4 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">Best Value</div>
                            <div>
                                <h3 id="tier-annual" class="text-lg font-bold leading-8 text-white">Annual</h3>
                                <p class="mt-4 text-sm leading-6 text-slate-300">Maximize your ROI with a discounted yearly rate.</p>
                                <p class="mt-6 flex items-baseline gap-x-1">
                                    <span class="text-4xl font-bold tracking-tight text-white">$250</span>
                                    <span class="text-sm font-semibold leading-6 text-slate-300">/ year</span>
                                </p>
                                <p class="mt-1 text-sm font-medium text-indigo-400">That's just ~$86 per month</p>
                                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-slate-300">
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> All Monthly features</li>
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Priority support</li>
                                    <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Save $100 annually</li>
                                </ul>
                            </div>
                            <a href="/register?plan=annual" aria-describedby="tier-annual" class="mt-8 block rounded-xl bg-indigo-500 px-3 py-3 text-center text-sm font-bold leading-6 text-white shadow-sm hover:bg-indigo-400 transition">Subscribe Annually</a>
                        </div>
                    </div>
                    <div class="mt-16 flex flex-wrap justify-center items-center gap-4 text-slate-500">
                        <span class="text-sm font-medium text-slate-600">Secure payments via:</span>
                        <svg class="h-6 w-auto text-slate-400" fill="currentColor" viewBox="0 0 60 25"><path d="M59.64 14.28h-8.06c.19 1.93 1.6 3.17 3.51 3.17 1.64 0 2.65-.6 3.25-1.73l3.92 1.68c-1.63 2.8-4.54 3.96-7.3 3.96-4.9 0-7.7-3.32-7.7-8.24 0-5.12 3.1-8.39 7.48-8.39 4.8 0 7.23 3.48 7.23 8.16 0 .5-.05 1.01-.1 1.39zm-4.33-2.88c-.1-1.68-1.25-2.9-2.93-2.9-1.68 0-2.8 1.15-3.03 2.9h5.96zM42.27 4.97V.08h-4.32v21.05h4.32v-3.07c1.1 1.68 2.83 2.98 5.1 2.98 3.92 0 6.94-3.1 6.94-7.9 0-4.75-3.02-7.8-6.94-7.8-2.26 0-4 1.3-5.1 2.98V4.97zm.43 8.16c0-2.73 1.73-4.46 3.94-4.46 2.2 0 3.94 1.73 3.94 4.46s-1.73 4.56-3.94 4.56c-2.2 0-3.94-1.83-3.94-4.56zm-15.65-7.8c-1.54 0-2.83.67-3.56 1.73V5.35h-4.32V21h4.32v-9.65c0-2.16 1.34-3.55 3.12-3.55 1.73 0 2.83 1.05 2.83 3.02V21h4.32v-9.6c0-3.94-2.1-5.66-4.9-5.66H27.05zm-14.7 0c-4.76 0-7.55 3.3-7.55 8.25s2.74 8.26 7.55 8.26c2.4 0 4.2-1.02 5.3-2.65V21h4.32V5.4h-4.32v1.54c-1.1-1.63-2.9-2.6-5.3-2.6zm3.95 8.25c0 2.8-1.78 4.6-4 4.6-2.2 0-4-1.8-4-4.6s1.8-4.6 4-4.6c2.2 0 4 1.8 4 4.6zM2.87 21h4.32V5.35H2.87V21zM2.83.1h4.4v4.4h-4.4z"/></svg>
                        <span class="hidden sm:block text-slate-300">|</span>
                        <span class="inline-flex items-center gap-x-1.5 rounded-lg bg-white px-3 py-1.5 text-sm font-semibold text-slate-700 ring-1 ring-inset ring-slate-200 shadow-sm">
                            <svg class="h-4 w-4 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0a12 12 0 100 24 12 12 0 000-24zm0 18.5a6.5 6.5 0 110-13 6.5 6.5 0 010 13zm3-7h-2.5v2.5h-1V11.5H9v-1h2.5v-2.5h1v2.5H15v1z"/></svg>
                            USDT (OKX)
                        </span>
                    </div>
                </div>
            </section>
            <section id="faq" class="bg-white py-20 sm:py-32">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid gap-12 lg:grid-cols-[0.8fr_1.2fr]">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">FAQ</p>
                            <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Questions teams ask first</h2>
                            <p class="mt-4 text-lg leading-8 text-slate-600">Everything below is tailored to the current Smart Table product and infrastructure.</p>
                        </div>
                        <div class="space-y-4">
                            @foreach ([
                                ['q' => 'Do customers need an app?', 'a' => 'No. Guests simply scan the QR code and use Smart Table directly in their mobile browser.'],
                                ['q' => 'Does it work offline?', 'a' => 'Customers need connectivity to load the session and send requests. When the connection is weak, the staff side still benefits from polling fallback.'],
                                ['q' => 'How is data isolated between restaurants?', 'a' => 'Each restaurant is treated as its own tenant, with staff roles scoped to that tenant and data protected through RLS-backed isolation.'],
                                ['q' => 'Can I customize the menu?', 'a' => 'Yes. Owners can manage the product catalog, categories, pricing, and image library from the dashboard.'],
                                ['q' => 'What languages are supported?', 'a' => 'The current landing page and default copy are in English. The product can be extended with localized content as your rollout grows.'],
                            ] as $faq)
                                <div x-data="{ open: false }" class="rounded-2xl border border-slate-200 bg-slate-50/50 p-6 transition hover:bg-slate-50">
                                    <button
                                        type="button"
                                        class="flex w-full items-center justify-between gap-4 text-left focus:outline-none"
                                        @click="open = !open"
                                        :aria-expanded="open.toString()"
                                    >
                                        <span class="text-base font-bold text-slate-900">{{ $faq['q'] }}</span>
                                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white text-slate-500 shadow-sm transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    <div x-show="open" x-collapse class="pt-4 text-sm leading-6 text-slate-600">
                                        {{ $faq['a'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative overflow-hidden rounded-[3rem] bg-slate-900 px-8 py-16 text-center shadow-2xl sm:px-16 sm:py-20 lg:px-24 text-white">
                        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-indigo-900/40 via-slate-900 to-slate-900"></div>
                        
                        <h2 class="mx-auto max-w-2xl text-3xl font-extrabold tracking-tight sm:text-5xl">Give every table a faster way to reach your staff</h2>
                        <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-slate-300">Launch Smart Table for your café or restaurant and keep service moving with live customer requests.</p>
                        
                        <div class="mt-10 flex items-center justify-center gap-4">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-sm font-bold text-slate-900 shadow-lg transition hover:bg-slate-50 hover:scale-105">
                                Get started now
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="border-t border-slate-200 bg-white">
            <div class="container mx-auto flex flex-col gap-8 px-4 py-12 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div>
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-sm">
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <rect x="4.5" y="5.5" width="15" height="4" rx="1.5"></rect>
                                <path d="M7.5 9.5v9m9-9v9M5.5 18.5h13"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-base font-bold text-slate-900">Smart Table</p>
                            <p class="text-sm text-slate-500">Live service for modern restaurants.</p>
                        </div>
                    </div>
                    <p class="mt-6 text-sm text-slate-400">© {{ date('Y') }} Smart Table. All rights reserved.</p>
                </div>
                <div class="flex flex-wrap items-center gap-6 text-sm font-semibold text-slate-600">
                    <a href="{{ route('login') }}" class="transition hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="transition hover:text-indigo-600">Register</a>
                    <a href="{{ route('legal.privacy') }}" class="transition hover:text-indigo-600">Privacy Policy</a>
                    <a href="{{ route('legal.terms') }}" class="transition hover:text-indigo-600">Terms of Service</a>
                    <a href="{{ route('legal.refund') }}" class="transition hover:text-indigo-600">Refund Policy</a>
                </div>
            </div>
        </footer>
    </div>
@endsection
