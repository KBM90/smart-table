<div x-data="{
        handle: null,
        init() {
            if (window.AppRealtime && typeof window.AppRealtime.onRequestChange === 'function') {
                this.handle = window.AppRealtime.onRequestChange(
                    { tenantId: {{ auth()->user()->tenant_id }} },
                    () => window.dispatchEvent(new CustomEvent('owner-requests-refresh')),
                );
            }
        },
        destroy() {
            if (this.handle && window.AppRealtime && typeof window.AppRealtime.unsubscribe === 'function') {
                window.AppRealtime.unsubscribe(this.handle);
            }
        },
    }" x-on:owner-requests-refresh.window="$wire.dispatch('refresh')" @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif class="space-y-8">
    <section
        class="relative overflow-hidden rounded-2xl border border-slate-700/60 bg-gradient-to-br from-slate-900 to-slate-950 p-8 shadow-2xl shadow-slate-900/50">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-amber-500/5 blur-3xl"></div>
        <div class="relative">
            <div class="flex items-center gap-3">
                <span class="flex h-2 w-2 rounded-full bg-amber-400 shadow-[0_0_8px_rgba(251,191,36,0.8)]"></span>
                <p class="text-xs font-bold uppercase tracking-[0.25em] text-amber-400">Owner Requests</p>
            </div>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">Active Service Requests</h1>
            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-400">
                Requests update live with Supabase Realtime when configured. Livewire polling is kept as a fallback to
                ensure you never miss a request.
            </p>
        </div>
    </section>

    <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/80 shadow-xl backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-800/60 text-left">
                <thead class="bg-slate-950/50">
                    <tr class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">
                        <th scope="col" class="px-6 py-5">Table & Session</th>
                        <th scope="col" class="px-6 py-5">Status</th>
                        <th scope="col" class="px-6 py-5">Wait Time</th>
                        <th scope="col" class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse ($requests as $request)
                                        <tr class="transition-colors duration-200 hover:bg-slate-800/40">
                                            <td class="px-6 py-5 align-middle">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-slate-800/80 border border-slate-700 text-slate-300">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-slate-100">{{ $request->tableSession->table->name }}
                                                        </p>
                                                        <p class="mt-1 flex items-center gap-1 text-xs text-slate-500 font-mono"
                                                            title="Session {{ $request->tableSession->id }}">
                                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                            </svg>
                                                            {{ str($request->tableSession->session_token)->limit(12) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-5 align-middle">
                                                <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-semibold shadow-sm
                                                                        {{ $request->status === \App\Models\ServiceRequest::STATUS_PENDING
                            ? 'border-amber-500/20 bg-amber-500/10 text-amber-400'
                            : 'border-emerald-500/20 bg-emerald-500/10 text-emerald-400' }}">
                                                    @if($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                    @else
                                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    @endif
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-5 align-middle" x-data="{ 
                            // Math.abs and parseInt ensure we never get negative or decimal numbers
                            // even if the database and server times are slightly out of sync.
                            elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at) }}')) || 0,
                            timer: null,
                            init() { 
                                this.timer = setInterval(() => this.elapsed++, 1000); 
                            },
                            destroy() { 
                                clearInterval(this.timer); 
                            },
                            formatTime(rawSeconds) {
                                // Drop any lingering decimals
                                const total = Math.floor(rawSeconds);

                                if (total < 60) {
                                    return `${total}s`;
                                }

                                const m = Math.floor(total / 60);
                                const s = total % 60;

                                // Pad seconds with a leading zero so 5 shows as '05'
                                const formattedSeconds = s.toString().padStart(2, '0');

                                return `${m}min ${formattedSeconds}s`;
                            }
                        }">
                                                <div
                                                    class="inline-flex items-center gap-2 rounded-lg bg-slate-950/50 px-3 py-1.5 border border-slate-800">
                                                    <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="text-sm font-medium tracking-widest text-slate-300 font-mono"
                                                        x-text="formatTime(elapsed)"></span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-5 align-middle text-right">
                                                <div class="flex justify-end gap-3">
                                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                                        <button wire:click="acceptRequest({{ $request->id }})" type="button"
                                                            class="group inline-flex items-center gap-2 rounded-lg border border-amber-500/30 bg-amber-500/5 px-4 py-2 text-sm font-semibold text-amber-300 transition-all hover:border-amber-400 hover:bg-amber-500/15 hover:text-amber-200 focus:ring-2 focus:ring-amber-500/20">
                                                            <span>Accept</span>
                                                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </button>
                                                    @endif

                                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                                        <button wire:click="resolveRequest({{ $request->id }})" type="button"
                                                            class="group inline-flex items-center gap-2 rounded-lg border border-emerald-500/30 bg-emerald-500/5 px-4 py-2 text-sm font-semibold text-emerald-300 transition-all hover:border-emerald-400 hover:bg-emerald-500/15 hover:text-emerald-200 focus:ring-2 focus:ring-emerald-500/20">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            <span>Resolve</span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-800/50 mb-4">
                                        <svg class="h-8 w-8 text-slate-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-slate-300">No active requests</h3>
                                    <p class="mt-1 text-sm text-slate-500">You're all caught up! New requests will appear
                                        here instantly.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>