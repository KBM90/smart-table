@extends('layouts.owner')

@section('content')
    <div
        class="space-y-6"
        x-data="waiterDetail()"
        x-init="load()"
    >
        {{-- Back link --}}
        <a
            href="{{ route('owner.waiters.index') }}"
            class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors"
        >
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Waiter Performance</span>
        </a>

        {{-- Profile header — always rendered from server-side Waiter model --}}
        <section
            class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl"
        >
            <div class="flex flex-wrap items-center gap-5">
                @if ($waiter->photo)
                    <img
                        src="{{ $waiter->photo }}"
                        alt="{{ $waiter->name }}"
                        class="h-16 w-16 rounded-2xl object-cover border border-slate-100 shadow-sm"
                    >
                @else
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-100 text-xl font-black text-indigo-600 border border-indigo-200">
                        {{ collect(explode(' ', $waiter->name))->filter()->take(2)->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('') }}
                    </div>
                @endif

                <div class="min-w-0">
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">{{ $waiter->name }}</h1>

                    @if ($waiter->joined_at)
                        <p class="mt-0.5 text-xs font-semibold text-slate-400">
                            Joined {{ $waiter->joined_at->format('M j, Y') }}
                        </p>
                    @endif

                    <span class="mt-1.5 inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[10px] font-bold
                        {{ $waiter->is_active
                            ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                            : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                        <span class="h-1.5 w-1.5 rounded-full {{ $waiter->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                        {{ $waiter->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        </section>

        {{-- Loading skeleton --}}
        <template x-if="loading">
            <div class="grid gap-4 sm:grid-cols-3">
                <template x-for="i in 3">
                    <div class="h-28 animate-pulse rounded-2xl border border-slate-200 bg-slate-100/60"></div>
                </template>
            </div>
        </template>

        {{-- Error state --}}
        <template x-if="!loading && error">
            <div class="flex items-center justify-between rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700">
                <span x-text="error"></span>
                <button type="button" @click="load()" class="ml-3 shrink-0 underline hover:text-red-900">Retry</button>
            </div>
        </template>

        {{-- Stats blocks --}}
        <template x-if="!loading && !error && stats">
            <div class="grid gap-4 sm:grid-cols-3">

                {{-- Avg Response Time --}}
                <div class="relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-md">
                    <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-100/40 blur-2xl pointer-events-none"></div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-500">Avg Response</p>
                    <p class="mt-3 text-3xl font-black tracking-tight text-slate-900" x-text="formatDuration(stats.avg_response_seconds)"></p>
                    <p class="mt-1 text-xs font-semibold text-slate-400">Per resolved request</p>
                </div>

                {{-- Total Resolved --}}
                <div class="relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-md">
                    <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-emerald-100/40 blur-2xl pointer-events-none"></div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600">Total Resolved</p>
                    <p class="mt-3 text-3xl font-black tracking-tight text-slate-900" x-text="stats.resolved_count"></p>
                    <p class="mt-1 text-xs font-semibold text-slate-400">Requests closed</p>
                </div>

                {{-- Avg Rating --}}
                <div class="relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 shadow-lg shadow-slate-200/50 backdrop-blur-md">
                    <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-amber-100/40 blur-2xl pointer-events-none"></div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-600">Avg Rating</p>
                    <div class="mt-3 flex items-baseline gap-2">
                        <template x-if="stats.avg_rating !== null">
                            <p class="text-3xl font-black tracking-tight text-slate-900" x-text="Number(stats.avg_rating).toFixed(1)"></p>
                        </template>
                        <template x-if="stats.avg_rating === null">
                            <p class="text-2xl font-black tracking-tight text-slate-400">—</p>
                        </template>
                        <template x-if="stats.avg_rating !== null">
                            <span class="text-lg text-amber-400">★</span>
                        </template>
                    </div>
                    <p class="mt-1 text-xs font-semibold text-slate-400">
                        <span x-text="stats.review_count"></span> review<span x-text="stats.review_count === 1 ? '' : 's'"></span>
                    </p>
                </div>

            </div>
        </template>

        {{-- Reviews list --}}
        <template x-if="!loading && !error && stats">
            <section class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">

                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-lg font-extrabold text-slate-900">Customer Reviews</h2>
                    <p class="mt-0.5 text-xs font-semibold text-slate-400">Left by customers after their request was resolved</p>
                </div>

                {{-- Has reviews --}}
                <template x-if="stats.reviews && stats.reviews.length > 0">
                    <ul class="divide-y divide-slate-100">
                        <template x-for="review in stats.reviews" :key="review.id">
                            <li class="px-6 py-5">
                                <div class="flex items-start justify-between gap-4">

                                    {{-- Stars --}}
                                    <div class="flex items-center gap-0.5">
                                        <template x-for="n in 5" :key="n">
                                            <svg
                                                class="h-4 w-4 transition-colors"
                                                :class="n <= review.rating ? 'text-amber-400' : 'text-slate-200'"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </template>
                                        <span class="ml-2 text-xs font-bold text-slate-500" x-text="review.rating + ' / 5'"></span>
                                    </div>

                                    {{-- Date --}}
                                    <time
                                        class="shrink-0 text-[10px] font-semibold text-slate-400 font-mono"
                                        x-text="formatDate(review.created_at)"
                                    ></time>
                                </div>

                                {{-- Comment --}}
                                <template x-if="review.comment">
                                    <p class="mt-2 text-sm leading-relaxed text-slate-600" x-text="review.comment"></p>
                                </template>
                                <template x-if="!review.comment">
                                    <p class="mt-2 text-xs italic text-slate-400">No comment left.</p>
                                </template>
                            </li>
                        </template>
                    </ul>
                </template>

                {{-- No reviews empty state --}}
                <template x-if="!stats.reviews || stats.reviews.length === 0">
                    <div class="px-6 py-14 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 border border-slate-100 mb-3">
                            <svg class="h-6 w-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-slate-700">No reviews yet</h3>
                        <p class="mt-1 text-xs text-slate-400 max-w-xs mx-auto leading-relaxed">
                            Reviews will appear here once customers leave feedback after their requests are resolved.
                        </p>
                    </div>
                </template>

            </section>
        </template>

    </div>

    <script>
        function waiterDetail() {
            return {
                stats: null,
                loading: true,
                error: null,

                async load() {
                    this.loading = true;
                    this.error = null;

                    try {
                        const res = await fetch(
                            @json(route('owner.api.waiters.stats', ['waiter' => $waiter->id])),
                            { headers: { 'Accept': 'application/json' } }
                        );

                        if (!res.ok) throw new Error('request_failed');

                        const json = await res.json();
                        this.stats = json.data ?? null;
                    } catch (e) {
                        this.error = 'Unable to load stats for this waiter.';
                    } finally {
                        this.loading = false;
                    }
                },

                formatDuration(seconds) {
                    if (seconds === null || seconds === undefined) return '—';
                    const total = Math.max(0, Math.round(seconds));
                    if (total < 60) return `${total}s`;
                    const m = Math.floor(total / 60);
                    const s = total % 60;
                    return s > 0 ? `${m}m ${s}s` : `${m}m`;
                },

                formatDate(iso) {
                    if (!iso) return '';
                    const d = new Date(iso);
                    return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
                },
            };
        }
    </script>
@endsection