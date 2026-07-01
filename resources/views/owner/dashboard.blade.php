@extends('layouts.owner')

@section('content')
    <div class="relative space-y-10">

        {{-- ── Decorative ambient blobs ──────────────────────────────────────────── --}}
        <div
            class="pointer-events-none absolute -right-16 -top-16 h-[28rem] w-[28rem] rounded-full bg-indigo-200/25 blur-[100px]">
        </div>
        <div
            class="pointer-events-none absolute -bottom-16 -left-16 h-[22rem] w-[22rem] rounded-full bg-emerald-200/25 blur-[90px]">
        </div>
        <div
            class="pointer-events-none absolute left-1/3 top-1/2 h-[18rem] w-[18rem] rounded-full bg-amber-200/20 blur-[90px]">
        </div>


        {{-- ── Stat Cards ──────────────────────────────────────────────────────────── --}}
        <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Active Alerts --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-amber-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('owner.dashboard.active_alerts') }}</span>
                    <div
                        class="rounded-xl bg-amber-50 p-3 text-amber-500 border border-amber-100 shadow-inner group-hover:bg-amber-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-4xl font-black tracking-tight text-slate-800">{{ $pendingCount }}</span>
                    @if ($pendingCount > 0)
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">
                            {{ __('owner.dashboard.live') }}
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-400">
                            {{ __('owner.dashboard.all_clear') }}
                        </span>
                    @endif
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">{{ __('owner.dashboard.waiting_queue') }}</p>
            </div>

            {{-- Avg Response --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('owner.dashboard.avg_response') }}</span>
                    <div
                        class="rounded-xl bg-indigo-50 p-3 text-indigo-500 border border-indigo-100 shadow-inner group-hover:bg-indigo-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-black tracking-tight text-slate-800">
                        {{ $avgResponseForHumans ?? '—' }}
                    </span>
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">
                    {{ $avgResponseForHumans ? __('owner.dashboard.todays_average') : __('owner.dashboard.no_accepted_today') }}
                </p>
            </div>

            {{-- Active Sessions --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('owner.dashboard.active_tables') }}</span>
                    <div
                        class="rounded-xl bg-emerald-50 p-3 text-emerald-500 border border-emerald-100 shadow-inner group-hover:bg-emerald-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-black tracking-tight text-slate-800">
                        {{ $activeSessionsCount }}
                        {{ $activeSessionsCount === 1 ? __('owner.dashboard.session_singular') : __('owner.dashboard.session_plural') }}
                    </span>
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">{{ __('owner.dashboard.live_connections') }}</p>
            </div>

            {{-- Completion Rate --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-violet-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('owner.dashboard.completion_rate') }}</span>
                    <div
                        class="rounded-xl bg-violet-50 p-3 text-violet-500 border border-violet-100 shadow-inner group-hover:bg-violet-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-black tracking-tight text-slate-800">{{ $completionRate }}%</span>
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">{{ __('owner.dashboard.calculated_24h') }}</p>
            </div>

        </section>

        {{-- ── Live Table Requests ──────────────────────────────────────────────────── --}}
        <livewire:owner.dashboard-requests />

        {{-- ── Quick Nav Cards ──────────────────────────────────────────────────────── --}}
        <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <a href="{{ route('owner.requests.index') }}"
                class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/40">
                <div class="flex items-start justify-between">
                    <div class="space-y-3">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                            {{ __('owner.dashboard.manage_requests') }}
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            {{ __('owner.dashboard.manage_requests_body') }}
                        </p>
                    </div>
                    <div
                        class="text-slate-300 group-hover:text-indigo-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-indigo-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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
                            {{ __('owner.dashboard.table_setup') }}
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            {{ __('owner.dashboard.table_setup_body') }}
                        </p>
                    </div>
                    <div
                        class="text-slate-300 group-hover:text-emerald-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-emerald-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
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
                            {{ __('owner.dashboard.staff_accounts') }}
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            {{ __('owner.dashboard.staff_accounts_body') }}
                        </p>
                    </div>
                    <div
                        class="text-slate-300 group-hover:text-amber-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-amber-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </div>
            </a>

        </section>

    </div>
@endsection
