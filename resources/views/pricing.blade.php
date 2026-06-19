@extends('layouts.guest')

@section('content')
@php($navLinks = [
    ['label' => 'Features', 'href' => '/#features'],
    ['label' => 'How it works', 'href' => '/#how-it-works'],
    ['label' => 'Pricing', 'href' => '/pricing'],
    ['label' => 'FAQ', 'href' => '#faq'],
])

<div class="relative overflow-x-hidden">
    <div
        class="absolute inset-x-0 top-0 -z-10 h-[36rem] bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.12),_transparent_55%)]">
    </div>
    <div class="absolute right-0 top-24 -z-10 h-72 w-72 rounded-full bg-sky-200/30 blur-3xl"></div>

    <header x-data="{ mobileOpen: false, scrolled: false }"
        x-init="scrolled = window.scrollY > 12; window.addEventListener('scroll', () => scrolled = window.scrollY > 12)"
        class="sticky top-0 z-50 transition-all duration-300"
        :class="scrolled ? 'border-b border-slate-200/80 bg-white/80 backdrop-blur-xl shadow-sm' : 'border-transparent bg-transparent'">
        <nav aria-label="Primary">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-14 md:h-20 items-center justify-between gap-4">
                    <a href="/" class="flex items-center gap-3 transition hover:opacity-80"
                        aria-label="Smart Table home">

                        <img src="{{ asset('img/system/logo_with_text.png') }}" alt="Smart Table"
                            class="h-14 md:h-20 w-auto object-contain" />
                    </a>

                    <div class="hidden items-center gap-8 lg:flex">
                        @foreach ($navLinks as $link)
                            <a href="{{ $link['href'] }}"
                                class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </div>

                    <div class="hidden items-center gap-4 lg:flex">
                        @auth
                            <a href="{{ route(auth()->user()->dashboardRouteName()) }}"
                                class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 hover:-translate-y-0.5">
                                Get started
                            </a>
                        @endauth
                    </div>

                    <button type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 lg:hidden"
                        @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen.toString()"
                        aria-controls="mobile-menu" aria-label="Toggle navigation menu">
                        <svg x-show="!mobileOpen" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" aria-hidden="true">
                            <path d="M4 7h16M4 12h16M4 17h16"></path>
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18"></path>
                        </svg>
                    </button>
                </div>

                <div id="mobile-menu" x-show="mobileOpen" x-transition.opacity.scale.origin.top x-cloak
                    class="pb-4 lg:hidden" @click.outside="mobileOpen = false">
                    <div
                        class="space-y-1 rounded-3xl border border-slate-200 bg-white/90 p-4 shadow-xl shadow-slate-200/60 backdrop-blur-xl">
                        @foreach ($navLinks as $link)
                            <a href="{{ $link['href'] }}"
                                class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-600"
                                @click="mobileOpen = false">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                        <div class="my-2 h-px bg-slate-100"></div>

                        @auth
                            <a href="{{ route(auth()->user()->dashboardRouteName()) }}"
                                class="block rounded-2xl px-4 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="mt-2 block rounded-2xl bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
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
            <div class="container mx-auto px-4 pb-12 pt-16 text-center sm:px-6 lg:px-8 lg:pt-24">
                <div class="mx-auto max-w-3xl">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50/50 px-4 py-2 text-sm font-semibold text-indigo-700 shadow-sm backdrop-blur-sm">
                        Transparent Pricing
                    </span>
                    <h1 class="mt-8 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Simple Pricing for <span class="text-indigo-600">Restaurants & Cafés</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600 max-w-2xl mx-auto">
                        Smart Table helps restaurants manage QR menus, live customer requests, tableside waiter
                        calls, and staff dashboards with zero friction. Choose a plan tailored to your business
                        operations.
                    </p>
                    <div class="mt-10 flex justify-center gap-4">
                        <a href="{{ route('register', ['plan' => 'trial']) }}"
                            class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-8 py-4 text-sm font-bold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-700 hover:-translate-y-0.5">
                            Start Free Trial
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-slate-50 border-t border-slate-200/50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-y-8 sm:mt-12 lg:mx-auto lg:max-w-none lg:grid-cols-3 lg:gap-x-8 xl:gap-x-12">
                    <div
                        class="rounded-3xl p-8 ring-1 ring-slate-200 bg-white flex flex-col justify-between shadow-sm hover:shadow-md transition">
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 id="tier-trial" class="text-lg font-bold leading-8 text-slate-900">7-Day Trial</h3>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-500">Test drive the complete Smart Table
                                experience at your venue.</p>
                            <p class="mt-6 flex items-baseline gap-x-1">
                                <span class="text-4xl font-extrabold tracking-tight text-slate-900">$0</span>
                                <span class="text-sm font-semibold leading-6 text-slate-500">/ 7 days</span>
                            </p>
                            <ul role="list"
                                class="mt-8 space-y-3.5 text-sm leading-6 text-slate-600 border-t border-slate-100 pt-6">
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    1 Location / Venue
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Up to 5 Tables & QR Codes
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Digital Menu (Text Only)
                                </li>
                                <li class="flex gap-x-3 text-slate-400">
                                    <svg class="h-5 w-5 flex-none text-slate-300" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                        </path>
                                    </svg>
                                    Live WebSockets Dashboard
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register', ['plan' => 'trial']) }}" aria-describedby="tier-trial"
                            class="mt-8 block rounded-xl bg-slate-50 px-3 py-3 text-center text-sm font-bold leading-6 text-slate-700 ring-1 ring-inset ring-slate-200 hover:bg-slate-100 transition">Start
                            Free Trial</a>
                    </div>

                    <div
                        class="rounded-3xl p-8 ring-1 ring-slate-200 bg-white flex flex-col justify-between shadow-sm hover:shadow-md transition">
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 id="tier-monthly" class="text-lg font-bold leading-8 text-slate-900">Monthly</h3>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-500">Perfect for growing restaurants needing
                                full real-time services.</p>
                            <p class="mt-6 flex items-baseline gap-x-1">
                                <span class="text-4xl font-extrabold tracking-tight text-slate-900">$25</span>
                                <span class="text-sm font-semibold leading-6 text-slate-500">/ month</span>
                            </p>
                            <ul role="list"
                                class="mt-8 space-y-3.5 text-sm leading-6 text-slate-600 border-t border-slate-100 pt-6">
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    1 Location / Venue
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Unlimited Tables & QR Codes
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Rich Menu Catalog (with images)
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Real-time Staff Dashboard
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Up to 5 Waiter Accounts
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register', ['plan' => 'monthly']) }}" aria-describedby="tier-monthly"
                            class="mt-8 block rounded-xl bg-indigo-600 px-3 py-3 text-center text-sm font-bold leading-6 text-white shadow-sm hover:bg-indigo-500 transition">Subscribe
                            Monthly</a>
                    </div>

                    <div
                        class="rounded-3xl p-8 ring-2 ring-indigo-600 bg-slate-900 xl:p-10 flex flex-col justify-between relative shadow-xl">
                        <div
                            class="absolute -top-4 right-8 rounded-full bg-indigo-500 px-4 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-sm">
                            Most Popular</div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 id="tier-annual" class="text-lg font-bold leading-8 text-white">Annual</h3>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-300">Maximize efficiency with absolute
                                operational access and priority updates.</p>
                            <p class="mt-6 flex items-baseline gap-x-1">
                                <span class="text-4xl font-extrabold tracking-tight text-white">$200</span>
                                <span class="text-sm font-semibold leading-6 text-slate-300">/ year</span>
                            </p>
                            <p class="mt-1.5 text-xs font-semibold text-indigo-400">Save $100 annually (~$16.60/month)
                            </p>
                            <ul role="list"
                                class="mt-8 space-y-3.5 text-sm leading-6 text-slate-300 border-t border-slate-800 pt-6">
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-400" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Multi-Venue / Location support
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-400" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Unlimited Tables & QR Codes
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-400" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Rich Menu Catalog & PDF Exporter
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-400" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Unlimited Staff & Waiter Accounts
                                </li>
                                <li class="flex gap-x-3">
                                    <svg class="h-5 w-5 flex-none text-indigo-400" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg>
                                    Priority 24/7 Support & Sound Alerts
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register', ['plan' => 'annual']) }}" aria-describedby="tier-annual"
                            class="mt-8 block rounded-xl bg-indigo-500 px-3 py-3 text-center text-sm font-bold leading-6 text-white shadow-sm hover:bg-indigo-400 transition">Subscribe
                            Annually</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white border-t border-b border-slate-200/50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Compare Plan Features</h2>
                    <p class="mt-3 text-sm text-slate-500">Find the right plan matching your restaurant scale.</p>
                </div>

                <div class="mt-12 overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[640px]">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="py-4 text-sm font-bold text-slate-900 w-1/4">Features</th>
                                <th class="py-4 text-sm font-bold text-slate-900 w-1/4">7-Day Trial</th>
                                <th class="py-4 text-sm font-bold text-slate-900 w-1/4">Monthly</th>
                                <th class="py-4 text-sm font-bold text-indigo-600 w-1/4">Annual</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr>
                                <td colspan="4"
                                    class="py-4 text-xs font-extrabold uppercase tracking-wider text-slate-400 bg-slate-50/50 px-2">
                                    Operations</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Venues / Locations</td>
                                <td class="py-4 text-sm text-slate-600">1</td>
                                <td class="py-4 text-sm text-slate-600">Multiple Locations</td>
                                <td class="py-4 text-sm font-semibold text-slate-900">Multiple Locations</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Table Capacity</td>
                                <td class="py-4 text-sm text-slate-600">Up to 5</td>
                                <td class="py-4 text-sm text-slate-600">Unlimited</td>
                                <td class="py-4 text-sm text-slate-600">Unlimited</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Real-time Updates</td>
                                <td class="py-4 text-sm text-slate-400">Polling fallback</td>
                                <td class="py-4 text-sm text-slate-600">WebSockets sync</td>
                                <td class="py-4 text-sm font-semibold text-slate-900">WebSockets + Sound Alerts</td>
                            </tr>
                            <tr>
                                <td colspan="4"
                                    class="py-4 text-xs font-extrabold uppercase tracking-wider text-slate-400 bg-slate-50/50 px-2">
                                    Menu & Catalog</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Product Categories</td>
                                <td class="py-4 text-sm text-slate-600">Up to 3</td>
                                <td class="py-4 text-sm text-slate-600">Unlimited</td>
                                <td class="py-4 text-sm text-slate-600">Unlimited</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Menu Images</td>
                                <td class="py-4 text-sm text-slate-400">Up to 10 Images</td>
                                <td class="py-4 text-sm text-slate-600">Supported</td>
                                <td class="py-4 text-sm text-slate-600">Supported</td>
                            </tr>
                            <tr>
                                <td colspan="4"
                                    class="py-4 text-xs font-extrabold uppercase tracking-wider text-slate-400 bg-slate-50/50 px-2">
                                    Staffing & Support</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Staff Accounts</td>
                                <td class="py-4 text-sm text-slate-400">Up to 2 waiters</td>
                                <td class="py-4 text-sm text-slate-600">Up to 4 waiters</td>
                                <td class="py-4 text-sm font-semibold text-slate-900">Unlimited</td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm font-medium text-slate-700">Support Level</td>
                                <td class="py-4 text-sm text-slate-600">Documentation only</td>
                                <td class="py-4 text-sm text-slate-600">Standard Email</td>
                                <td class="py-4 text-sm font-semibold text-slate-900">Priority 24/7 Support</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="faq" class="bg-slate-50 py-20 sm:py-28">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-[0.8fr_1.2fr]">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">FAQ</p>
                        <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Questions
                            restaurant teams usually ask</h2>
                        <p class="mt-4 text-lg leading-8 text-slate-600">Everything you need to know about our billing
                            and plans.</p>
                    </div>

                    <div class="space-y-4">
                        <details
                            class="group rounded-2xl border border-slate-200 bg-white p-6 [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex w-full cursor-pointer items-center justify-between gap-4 text-left focus:outline-none">
                                <span class="text-base font-bold text-slate-900">How do QR codes work for tables?</span>
                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 shadow-sm transition duration-300 group-open:rotate-180">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" aria-hidden="true">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="mt-4 text-sm leading-6 text-slate-600">
                                Each table receives a unique, secure QR code. When a customer scans it using their
                                smartphone camera, they open a session in their mobile web browser. They can call a
                                waiter, notify staff they need water or a bill, and browse your menu instantly.
                            </div>
                        </details>

                        <details
                            class="group rounded-2xl border border-slate-200 bg-white p-6 [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex w-full cursor-pointer items-center justify-between gap-4 text-left focus:outline-none">
                                <span class="text-base font-bold text-slate-900">Can I upgrade or downgrade my plan
                                    later?</span>
                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 shadow-sm transition duration-300 group-open:rotate-180">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" aria-hidden="true">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="mt-4 text-sm leading-6 text-slate-600">
                                Yes. You can change your plan at any time through the Billing section in your Owner
                                Dashboard. Upgrades apply immediately, while downgrades or cancellations will take
                                effect at the end of your current billing cycle.
                            </div>
                        </details>

                        <details
                            class="group rounded-2xl border border-slate-200 bg-white p-6 [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex w-full cursor-pointer items-center justify-between gap-4 text-left focus:outline-none">
                                <span class="text-base font-bold text-slate-900">Do guests need to download any
                                    application?</span>
                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 shadow-sm transition duration-300 group-open:rotate-180">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" aria-hidden="true">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="mt-4 text-sm leading-6 text-slate-600">
                                No. Smart Table is designed for minimum friction. Customers scan the QR code and
                                interact using their native browser (Safari, Chrome, etc.) on iOS or Android. No
                                installation, login, or setup is required on the guest's part.
                            </div>
                        </details>

                        <details
                            class="group rounded-2xl border border-slate-200 bg-white p-6 [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex w-full cursor-pointer items-center justify-between gap-4 text-left focus:outline-none">
                                <span class="text-base font-bold text-slate-900">Can I add multiple restaurant locations
                                    under one account?</span>
                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 shadow-sm transition duration-300 group-open:rotate-180">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" aria-hidden="true">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="mt-4 text-sm leading-6 text-slate-600">
                                Yes. Our Annual plan supports multiple locations. This allows you to manage different
                                staff lists, separate table configurations, and distinctive menus under a single
                                centralized dashboard.
                            </div>
                        </details>

                        <details
                            class="group rounded-2xl border border-slate-200 bg-white p-6 [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex w-full cursor-pointer items-center justify-between gap-4 text-left focus:outline-none">
                                <span class="text-base font-bold text-slate-900">What happens after my 7-day trial
                                    ends?</span>
                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 shadow-sm transition duration-300 group-open:rotate-180">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" aria-hidden="true">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <div class="mt-4 text-sm leading-6 text-slate-600">
                                Once your 7-day trial expires, your table sessions will be deactivated. You will be
                                prompted to subscribe to either the Monthly or Annual plan inside the Billing dashboard
                                to resume operation. No credit card is required to sign up for the initial trial.
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative overflow-hidden rounded-[3rem] bg-slate-900 px-8 py-16 text-center shadow-2xl sm:px-16 sm:py-20 lg:px-24 text-white">
                    <div
                        class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-indigo-900/40 via-slate-900 to-slate-900">
                    </div>

                    <h2 class="mx-auto max-w-2xl text-3xl font-extrabold tracking-tight sm:text-5xl">Ready to elevate
                        your table service?</h2>
                    <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-slate-300">Launch Smart Table for your venue
                        today. Setting up takes less than 5 minutes, with no credit card required to start.</p>

                    <div class="mt-10 flex items-center justify-center gap-4">
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-sm font-bold text-slate-900 shadow-lg transition hover:bg-slate-50 hover:scale-105">
                            Create Your Account
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div
            class="container mx-auto flex flex-col gap-8 px-4 py-12 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <div>
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-sm">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true">
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
                <a href="#" class="transition hover:text-indigo-600">Privacy Policy</a>
                <a href="#" class="transition hover:text-indigo-600">Terms of Service</a>
                <a href="mailto:support@smartable.com" class="transition hover:text-indigo-600">Contact Support</a>
            </div>
        </div>
    </footer>
</div>
@endsection