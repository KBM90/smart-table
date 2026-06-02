<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500/30">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 space-y-10">

            <section
                class="relative overflow-hidden rounded-3xl border border-slate-800 bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 p-8 shadow-2xl shadow-slate-950/50 backdrop-blur-xl">
                <div
                    class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-indigo-500/10 blur-[90px] pointer-events-none">
                </div>
                <div
                    class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-emerald-500/5 blur-[90px] pointer-events-none">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 px-3 py-1 text-xs font-bold uppercase tracking-wider text-indigo-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                                Control Center
                            </span>
                        </div>
                        <h1
                            class="mt-4 text-3xl font-extrabold tracking-tight text-white sm:text-4xl bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400">
                            Welcome back, {{ Auth::user()->name }}
                        </h1>
                        <p class="mt-2 text-sm leading-relaxed text-slate-400 max-w-xl font-medium">
                            Everything is running smoothly. Monitor live floor activity, answer client calls instantly,
                            and track today's turnover rates here.
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('owner.requests.index') }}"
                            class="group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/30 active:scale-95 transition-all duration-200">
                            <span>Open Live Queue</span>
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-800/80 bg-slate-900/40 p-6 backdrop-blur-md shadow-xl transition-all duration-300 hover:border-amber-500/30 hover:bg-slate-900/60">
                    <div class="flex items-center justify-between">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-slate-500 group-hover:text-slate-400 transition-colors">Active
                            Alerts</span>
                        <div
                            class="rounded-xl bg-amber-500/10 p-2.5 text-amber-400 border border-amber-500/20 group-hover:bg-amber-500/20 transition-colors">
                            <svg class="h-5 w-5 animate-bell" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold tracking-tight text-white">Live</span>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-amber-500/10 px-2 py-0.5 text-xs font-bold text-amber-400 border border-amber-500/20">
                            Realtime
                        </span>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-500 group-hover:text-slate-400 transition-colors">
                        Waiting floor requests queue</p>
                </div>

                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-800/80 bg-slate-900/40 p-6 backdrop-blur-md shadow-xl transition-all duration-300 hover:border-indigo-500/30 hover:bg-slate-900/60">
                    <div class="flex items-center justify-between">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-slate-500 group-hover:text-slate-400 transition-colors">Avg
                            Response</span>
                        <div
                            class="rounded-xl bg-indigo-500/10 p-2.5 text-indigo-400 border border-indigo-500/20 group-hover:bg-indigo-500/20 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-3xl font-extrabold tracking-tight text-white">1m 42s</span>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-500 group-hover:text-slate-400 transition-colors">
                        Highly optimal standard</p>
                </div>

                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-800/80 bg-slate-900/40 p-6 backdrop-blur-md shadow-xl transition-all duration-300 hover:border-emerald-500/30 hover:bg-slate-900/60">
                    <div class="flex items-center justify-between">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-slate-500 group-hover:text-slate-400 transition-colors">Active
                            Tables</span>
                        <div
                            class="rounded-xl bg-emerald-500/10 p-2.5 text-emerald-400 border border-emerald-500/20 group-hover:bg-emerald-500/20 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-3xl font-extrabold tracking-tight text-white">12 Sessions</span>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-500 group-hover:text-slate-400 transition-colors">Live
                        connections verified</p>
                </div>

                <div
                    class="group relative overflow-hidden rounded-2xl border border-slate-800/80 bg-slate-900/40 p-6 backdrop-blur-md shadow-xl transition-all duration-300 hover:border-violet-500/30 hover:bg-slate-900/60">
                    <div class="flex items-center justify-between">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-slate-500 group-hover:text-slate-400 transition-colors">Completion
                            Rate</span>
                        <div
                            class="rounded-xl bg-violet-500/10 p-2.5 text-violet-400 border border-violet-500/20 group-hover:bg-violet-500/20 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-3xl font-extrabold tracking-tight text-white">99.4%</span>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-500 group-hover:text-slate-400 transition-colors">
                        Calculated over past 24 hours</p>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <a href="{{ route('owner.requests.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/20 p-6 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-slate-700 hover:bg-slate-900/40">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors">
                                Manage Requests</h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-medium">Accept, track, and monitor
                                response intervals for all floor calls in real-time.</p>
                        </div>
                        <div class="text-slate-600 group-hover:text-indigo-400 transition-colors shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('owner.tables.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/20 p-6 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-slate-700 hover:bg-slate-900/40">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">
                                Table Setup</h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-medium">Generate QR tokens, manage
                                layout names, and block or unblock sessions instantly.</p>
                        </div>
                        <div class="text-slate-600 group-hover:text-emerald-400 transition-colors shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('owner.staff.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/20 p-6 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-slate-700 hover:bg-slate-900/40">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors">Staff
                                & Accounts</h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-medium">Assign service agents,
                                configure custom operational parameters and system authorization roles.</p>
                        </div>
                        <div class="text-slate-600 group-hover:text-amber-400 transition-colors shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

            </section>
        </div>
    </div>
</x-app-layout>