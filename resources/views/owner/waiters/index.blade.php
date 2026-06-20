@extends('layouts.owner')

@section('content')
    <div class="space-y-6" x-data="waiterPerformanceList()" x-init="load()">
        <section
            class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
            <span
                class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                Owner Staff Performance
            </span>
            <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Waiter Performance</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">
                See each waiter's status, average rating, and resolved request count at a glance. Click a card for full
                stats.
            </p>
        </section>

        {{-- Loading state --}}
        <div x-show="loading"
            class="rounded-[2rem] border border-white/80 bg-white/60 p-12 text-center shadow-xl backdrop-blur-md">
            <p class="text-sm font-semibold text-slate-500">Loading waiters…</p>
        </div>

        {{-- Error state --}}
        <div x-show="!loading && error" x-cloak
            class="flex items-center justify-between rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700">
            <span x-text="error"></span>
            <button type="button" @click="load()" class="ml-3 shrink-0 underline hover:text-red-900">Retry</button>
        </div>

        {{-- Empty state --}}
        <div x-show="!loading && !error && waiters.length === 0" x-cloak
            class="rounded-[2rem] border border-dashed border-slate-300 bg-white/40 p-12 text-center">
            <h3 class="text-sm font-bold text-slate-700">No waiters yet</h3>
            <p class="mt-1 text-xs text-slate-400">Create waiter accounts from the Staff page to see them here.</p>
        </div>

        {{-- Cards --}}
        <div x-show="!loading && !error && waiters.length > 0" x-cloak class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <template x-for="waiter in waiters" :key="waiter.id">
                <a :href="waiterUrl(waiter.id)"
                    class="group block rounded-[1.75rem] border border-white/80 bg-white/70 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-indigo-200">
                    <div class="flex items-center gap-4">
                        <template x-if="waiter.photo">
                            <img :src="waiter.photo" :alt="waiter.name"
                                class="h-14 w-14 rounded-2xl object-cover border border-slate-100 shadow-sm">
                        </template>
                        <template x-if="!waiter.photo">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-lg font-black text-indigo-600 border border-indigo-200"
                                x-text="initials(waiter.name)"></div>
                        </template>

                        <div class="min-w-0">
                            <h3 class="truncate font-bold text-slate-900 group-hover:text-indigo-600 transition-colors"
                                x-text="waiter.name"></h3>
                            <span
                                class="mt-1 inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[10px] font-bold"
                                :class="waiter.is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200'">
                                <span class="h-1.5 w-1.5 rounded-full"
                                    :class="waiter.is_active ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                                <span x-text="waiter.is_active ? 'Active' : 'Inactive'"></span>
                            </span>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-3">
                        <div class="rounded-xl border border-amber-100 bg-amber-50/60 px-3 py-2.5">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Avg Rating</p>
                            <p class="mt-1 text-sm font-black text-amber-800">
                                <span x-show="waiter.avg_rating !== null"
                                    x-text="'★ ' + Number(waiter.avg_rating).toFixed(1)"></span>
                                <span x-show="waiter.avg_rating === null" class="text-xs font-semibold text-amber-500">No
                                    ratings yet</span>
                            </p>
                        </div>
                        <div class="rounded-xl border border-indigo-100 bg-indigo-50/60 px-3 py-2.5">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-600">Resolved</p>
                            <p class="mt-1 text-sm font-black text-indigo-800" x-text="waiter.resolved_count + ' requests'">
                            </p>
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </div>

    <script>
        function waiterPerformanceList() {
            return {
                waiters: [],
                loading: true,
                error: null,

                async load() {
                    this.loading = true;
                    this.error = null;

                    try {
                        const res = await fetch('{{ route('owner.api.waiters.index') }}', {
                            headers: { 'Accept': 'application/json' },
                        });

                        if (!res.ok) {
                            throw new Error('request_failed');
                        }

                        const json = await res.json();
                        this.waiters = json.data ?? [];
                    } catch (e) {
                        this.error = 'Unable to load waiter performance data.';
                    } finally {
                        this.loading = false;
                    }
                },

                waiterUrl(id) {
                    return @json(route('owner.waiters.show', ['waiter' => '__ID__'])).replace('__ID__', id);
                },

                initials(name) {
                    if (!name) return '?';
                    return name
                        .split(' ')
                        .filter(Boolean)
                        .slice(0, 2)
                        .map(part => part[0].toUpperCase())
                        .join('');
                },
            };
        }
    </script>
@endsection