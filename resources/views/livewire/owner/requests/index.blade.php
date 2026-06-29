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
    }" x-on:owner-requests-refresh.window="$wire.dispatch('refresh')" @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif class="space-y-6">
    <section
        class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-8 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-amber-200/20 blur-3xl"></div>
        <div class="relative">
            <div class="flex items-center gap-3">
                <span class="relative flex h-3.5 w-3.5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
                </span>
                <span
                    class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700 bg-amber-50 px-2.5 py-1.5 rounded-xl border border-amber-100 shadow-sm inline-block">
                    Owner Requests
                </span>
            </div>
            <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Active Service Requests</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">
                Requests update live with Supabase Realtime when configured. Livewire polling is kept as a fallback to
                ensure you never miss a request.
            </p>
        </div>
    </section>

    <section
        class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead>
                    <tr
                        class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                        <th scope="col" class="px-6 py-5">Table & Session</th>
                        <th scope="col" class="px-6 py-5">Status</th>
                        <th scope="col" class="px-6 py-5">Wait Time</th>
                        <th scope="col" class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($requests as $request)
                        <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                            <td class="px-6 py-5 align-middle">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 border border-slate-200 text-slate-600 group-hover/row:bg-indigo-50 group-hover/row:border-indigo-100 group-hover/row:text-indigo-600 transition-colors">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $request->tableSession->table->name }}</p>
                                        <p class="mt-0.5 flex items-center gap-1 text-[10px] text-slate-400 font-mono"
                                            title="Session {{ $request->tableSession->id }}">
                                            <svg class="h-3 w-3 text-slate-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            </svg>
                                            {{ str($request->tableSession->session_token)->limit(12) }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 align-middle">
                                <div class="flex items-center">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm"
                                            title="Accepted by {{ $request->acceptedBy?->name ?? 'Staff' }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Accepted
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-5 align-middle" x-data="{ 
                                        elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at, true) }}')) || 0,
                                        timer: null,
                                        init() { 
                                            this.timer = setInterval(() => this.elapsed++, 1000); 
                                        },
                                        destroy() { 
                                            clearInterval(this.timer); 
                                        },
                                        formatTime(rawSeconds) {
                                            const total = Math.floor(rawSeconds);
                                            if (total < 60) return `${total}s`;
                                            const m = Math.floor(total / 60);
                                            const s = total % 60;
                                            return `${m}m ${s.toString().padStart(2, '0')}s`;
                                        }
                                    }">
                                <div
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-50 px-2.5 py-1 border border-slate-100 font-mono text-xs font-semibold text-slate-600">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span x-text="formatTime(elapsed)"></span>
                                </div>
                            </td>

                            <td class="px-6 py-5 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <button wire:click="acceptRequest({{ $request->id }})" type="button"
                                            class="inline-flex items-center gap-1.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <span>Accept</span>
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    @elseif ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                        <button
                                            x-data="{
                                                resolveReadyAt: @js($request->accepted_at ? $request->accepted_at->copy()->addSeconds(60)->toIso8601String() : null),
                                                resolveCountdown: 0,
                                                resolveTimer: null,
                                                init() {
                                                    this.updateResolveCountdown();
                                                    if (this.resolveCountdown > 0) {
                                                        this.resolveTimer = setInterval(() => {
                                                            this.updateResolveCountdown();
                                                            if (this.resolveCountdown === 0) {
                                                                clearInterval(this.resolveTimer);
                                                            }
                                                        }, 1000);
                                                    }
                                                },
                                                updateResolveCountdown() {
                                                    if (!this.resolveReadyAt) {
                                                        this.resolveCountdown = 0;
                                                        return;
                                                    }

                                                    const readyAt = Date.parse(this.resolveReadyAt);

                                                    if (Number.isNaN(readyAt)) {
                                                        this.resolveCountdown = 0;
                                                        return;
                                                    }

                                                    this.resolveCountdown = Math.max(0, Math.ceil((readyAt - Date.now()) / 1000));
                                                },
                                                destroy() {
                                                    if (this.resolveTimer) clearInterval(this.resolveTimer);
                                                },
                                            }"
                                            wire:click="resolveRequest({{ $request->id }})" type="button"
                                            :disabled="resolveCountdown > 0"
                                            class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:translate-y-0">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span x-show="resolveCountdown <= 0" x-cloak>Resolve</span>
                                            <span x-show="resolveCountdown > 0" x-cloak x-text="`Wait ${Math.max(1, Math.ceil(resolveCountdown))}s`"></span>
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
                                        class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800">No Active Requests</h3>
                                    <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">You're all caught up!
                                        New requests will appear here instantly.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
