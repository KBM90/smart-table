@extends('layouts.owner')

@section('content')


    <div
        class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/30 to-emerald-50/40 text-slate-800 antialiased selection:bg-indigo-200 relative overflow-hidden">

        <div
            class="absolute -right-20 top-20 h-96 w-96 rounded-full bg-gradient-to-br from-indigo-300/20 to-purple-300/20 blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute -left-20 bottom-10 h-96 w-96 rounded-full bg-gradient-to-tr from-emerald-200/20 to-teal-200/20 blur-[120px] pointer-events-none">
        </div>
        <div class="absolute left-1/3 top-1/4 h-80 w-80 rounded-full bg-amber-200/15 blur-[100px] pointer-events-none">
        </div>

        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 space-y-10 relative z-10">

            <section
                class="relative overflow-hidden rounded-3xl border border-white/60 bg-white/70 p-8 shadow-xl shadow-slate-200/50 backdrop-blur-xl transition-all duration-300">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-indigo-600 border border-indigo-100">
                                <span class="h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                                Operation Hub Active
                            </span>
                        </div>
                        <h1
                            class="mt-4 text-3xl font-black tracking-tight sm:text-4xl bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-800">
                            Welcome back, {{ Auth::user()->name }}
                        </h1>
                        <p class="mt-2 text-sm font-medium leading-relaxed text-slate-600 max-w-xl">
                            Your floor is looking wonderful today. Track client alerts instantly, oversee live table
                            activity, and monitor performance speeds seamlessly.
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('owner.requests.index') }}"
                            class="group inline-flex items-center gap-2.5 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 hover:from-indigo-500 hover:to-violet-500 hover:shadow-indigo-500/30 transition-all duration-200 active:scale-95">
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
                    class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-white/80 p-6 backdrop-blur-md shadow-lg shadow-slate-100/80 transition-all duration-300 hover:-translate-y-1 hover:border-amber-300 hover:bg-amber-50/20">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Active Alerts</span>
                        <div
                            class="rounded-xl bg-amber-50 p-2.5 text-amber-600 border border-amber-100 group-hover:bg-amber-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-2">
                        <span class="text-3xl font-black tracking-tight text-slate-900">Live</span>
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-bold text-amber-700">
                            Streaming
                        </span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Waiting floor requests queue</p>
                </div>

                <div
                    class="group relative overflow-hidden rounded-2xl border border-indigo-100 bg-white/80 p-6 backdrop-blur-md shadow-lg shadow-slate-100/80 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-300 hover:bg-indigo-50/20">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Avg Response</span>
                        <div
                            class="rounded-xl bg-indigo-50 p-2.5 text-indigo-600 border border-indigo-100 group-hover:bg-indigo-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-3xl font-black tracking-tight text-slate-900">1m 42s</span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Highly optimal standard</p>
                </div>

                <div
                    class="group relative overflow-hidden rounded-2xl border border-emerald-100 bg-white/80 p-6 backdrop-blur-md shadow-lg shadow-slate-100/80 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50/20">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Active Tables</span>
                        <div
                            class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600 border border-emerald-100 group-hover:bg-emerald-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-3xl font-black tracking-tight text-slate-900">12 Sessions</span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Live connections verified</p>
                </div>

                <div
                    class="group relative overflow-hidden rounded-2xl border border-purple-100 bg-white/80 p-6 backdrop-blur-md shadow-lg shadow-slate-100/80 transition-all duration-300 hover:-translate-y-1 hover:border-purple-300 hover:bg-purple-50/20">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Completion Rate</span>
                        <div
                            class="rounded-xl bg-purple-50 p-2.5 text-purple-600 border border-purple-100 group-hover:bg-purple-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline gap-1">
                        <span class="text-3xl font-black tracking-tight text-slate-900">99.4%</span>
                    </div>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Calculated over past 24 hours</p>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <a href="{{ route('owner.requests.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-slate-200/70 bg-white/60 p-6 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-indigo-300 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/50">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                Manage Requests</h3>
                            <p class="text-xs font-medium text-slate-600 leading-relaxed">Accept, resolve, and review
                                timeline indicators for active user floor calls dynamically.</p>
                        </div>
                        <div
                            class="text-slate-400 group-hover:text-indigo-500 transition-all group-hover:translate-x-1 shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('owner.tables.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-slate-200/70 bg-white/60 p-6 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-emerald-300 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            <h3
                                class="text-lg font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors">
                                Table Setup</h3>
                            <p class="text-xs font-medium text-slate-600 leading-relaxed">Generate physical code badges,
                                edit seating layouts, and alter table session blockages instantly.</p>
                        </div>
                        <div
                            class="text-slate-400 group-hover:text-emerald-500 transition-all group-hover:translate-x-1 shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('owner.staff.index') }}"
                    class="group relative overflow-hidden rounded-2xl border border-slate-200/70 bg-white/60 p-6 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-amber-300 hover:bg-white hover:shadow-xl hover:shadow-amber-100/50">
                    <div class="flex items-start justify-between">
                        <div class="space-y-2">
                            <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-amber-600 transition-colors">
                                Staff & Accounts</h3>
                            <p class="text-xs font-medium text-slate-600 leading-relaxed">Manage waitstaff registrations,
                                configure workspace shifts, and update security rules.</p>
                        </div>
                        <div
                            class="text-slate-400 group-hover:text-amber-500 transition-all group-hover:translate-x-1 shrink-0">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

            </section>
        </div>
    </div>


@endsection