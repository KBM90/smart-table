<x-app-layout>
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50/40 to-emerald-50/30 text-slate-800 antialiased relative overflow-hidden">

        <div
            class="absolute top-0 right-0 -mr-32 -mt-32 h-[30rem] w-[30rem] rounded-full bg-indigo-200/30 blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 -ml-32 -mb-32 h-[25rem] w-[25rem] rounded-full bg-emerald-200/30 blur-[100px] pointer-events-none">
        </div>
        <div
            class="absolute top-1/2 left-1/3 h-[20rem] w-[20rem] rounded-full bg-amber-200/20 blur-[100px] pointer-events-none">
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 space-y-10">

            {{-- ── Hero / Welcome ─────────────────────────────────────────────────── --}}
            <section
                class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-8 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl transition-all duration-300">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-indigo-100 border border-indigo-200 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-indigo-700 shadow-sm">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                                </span>
                                Control Center
                            </span>
                        </div>
                        <h1 class="mt-5 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl drop-shadow-sm">
                            Welcome back, <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-500">{{ Auth::user()->name }}</span>
                        </h1>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600 max-w-xl font-medium">
                            Everything is running smoothly. Monitor live floor activity, answer client calls instantly,
                            and track today's turnover rates from your central hub.
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('owner.requests.index') }}"
                            class="group relative inline-flex items-center gap-2.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-7 py-4 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                            <span>Open Live Queue</span>
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            {{-- ── Stat Cards ──────────────────────────────────────────────────────── --}}
            <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Active Alerts --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-amber-100/50">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Active Alerts</span>
                        <div
                            class="rounded-xl bg-amber-50 p-3 text-amber-500 border border-amber-100 shadow-inner group-hover:bg-amber-100 transition-colors">
                            <svg class="h-6 w-6 animate-bell" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-2">
                        <span class="text-4xl font-black tracking-tight text-slate-800">
                            {{ $pendingCount }}
                        </span>
                        @if ($pendingCount > 0)
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">
                                Live
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-400">
                                All clear
                            </span>
                        @endif
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Waiting floor requests queue</p>
                </div>

                {{-- Avg Response --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/50">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Avg Response</span>
                        <div
                            class="rounded-xl bg-indigo-50 p-3 text-indigo-500 border border-indigo-100 shadow-inner group-hover:bg-indigo-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight text-slate-800">
                            {{ $avgResponseForHumans ?? '—' }}
                        </span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">
                        {{ $avgResponseForHumans ? 'Today\'s average response' : 'No accepted requests today' }}
                    </p>
                </div>

                {{-- Active Tables --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Active Tables</span>
                        <div
                            class="rounded-xl bg-emerald-50 p-3 text-emerald-500 border border-emerald-100 shadow-inner group-hover:bg-emerald-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight text-slate-800">
                            {{ $activeSessionsCount }}
                            {{ Str::plural('Session', $activeSessionsCount) }}
                        </span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Live connections verified</p>
                </div>

                {{-- Completion Rate --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-violet-100/50">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Completion Rate</span>
                        <div
                            class="rounded-xl bg-violet-50 p-3 text-violet-500 border border-violet-100 shadow-inner group-hover:bg-violet-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-4xl font-black tracking-tight text-slate-800">
                            {{ $completionRate }}%
                        </span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Calculated over past 24 hours</p>
                </div>

            </section>

            {{-- ── Quick Nav Cards ─────────────────────────────────────────────────── --}}
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <a href="{{ route('owner.requests.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/40">
                    <div class="flex items-start justify-between">
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                Manage Requests</h3>
                            <p class="text-sm text-slate-500 leading-relaxed font-medium">Accept, track, and monitor
                                response intervals for all floor calls in real-time.</p>
                        </div>
                        <div
                            class="text-slate-300 group-hover:text-indigo-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-indigo-50">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('owner.tables.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/40">
                    <div class="flex items-start justify-between">
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                                Table Setup</h3>
                            <p class="text-sm text-slate-500 leading-relaxed font-medium">Generate QR tokens, manage
                                layout names, and block or unblock sessions instantly.</p>
                        </div>
                        <div
                            class="text-slate-300 group-hover:text-emerald-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-emerald-50">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('owner.staff.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-amber-200 hover:bg-white hover:shadow-xl hover:shadow-amber-100/40">
                    <div class="flex items-start justify-between">
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                                Staff & Accounts</h3>
                            <p class="text-sm text-slate-500 leading-relaxed font-medium">Assign service agents,
                                configure operational parameters and system authorization roles.</p>
                        </div>
                        <div
                            class="text-slate-300 group-hover:text-amber-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-amber-50">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

            </section>

        </div>
    </div>
</x-app-layout>