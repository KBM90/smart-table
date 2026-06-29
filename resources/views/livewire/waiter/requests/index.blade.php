<div wire:poll.3s="refreshRequests" class="space-y-6">
    {{-- Supabase Realtime subscription lives in its own inner div so Alpine
    does not share the same root element as wire:poll. When Alpine and
    Livewire both own the same root element, Livewire's morphing can
    conflict with Alpine's reactivity and prevent poll-triggered re-renders
    from reaching the DOM correctly. --}}
    <div x-data="{
            handle: null,
            init() {
                if (window.AppRealtime && typeof window.AppRealtime.onRequestChange === 'function') {
                    this.handle = window.AppRealtime.onRequestChange(
                        { tenantId: {{ auth()->user()->tenant_id }} },
                        (payload) => {
                            if (window.AppRealtimeFilters && typeof window.AppRealtimeFilters.shouldRefreshWaiterList === 'function' && window.AppRealtimeFilters.shouldRefreshWaiterList(payload)) {
                                window.dispatchEvent(new CustomEvent('waiter-requests-refresh'));
                            }
                        },
                    );
                }
            },
            destroy() {
                if (this.handle && window.AppRealtime && typeof window.AppRealtime.unsubscribe === 'function') {
                    window.AppRealtime.unsubscribe(this.handle);
                }
            },
        }" x-on:waiter-requests-refresh.window="$wire.dispatch('refresh')">
    </div>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">Waiter requests</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">My Table Requests</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">
            Active service requests for your assigned tables. Updates live when Realtime is available.
        </p>

        <div class="mt-6">
            <button type="button" x-data @click="$dispatch('open-modal', 'scan-to-assign')"
                class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-sky-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 14h2m4 0h-2m-4 4h6" />
                </svg>
                <span>Scan to Assign</span>
            </button>
        </div>
    </section>

    @if (!$hasAssignedTables)
        {{-- No-assignment callout --}}
        <section class="overflow-hidden rounded-2xl border border-amber-200 bg-amber-50 p-8 shadow-sm">
            <div class="flex flex-col items-center justify-center text-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 border border-amber-200">
                    <svg class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-amber-900">No Tables Assigned Yet</h2>
                    <p class="mt-2 text-sm text-amber-800 max-w-sm leading-relaxed">
                        You haven't been assigned to any tables. Ask your manager to assign you from the
                        <strong>Owner › Tables</strong> page. Once assigned, requests from those tables will appear here.
                    </p>
                </div>
            </div>
        </section>
    @else
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">
                        <th class="px-6 py-4">Table</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Elapsed</th>
                        <th class="px-6 py-4">Accepted by</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($requests as $request)
                        <tr class="align-top transition-all duration-300"
                            x-data="{
                                localStatus: @js($request->status),
                                busy: false,
                                justChanged: false,
                                resolveReadyAt: @js($request->status === 'accepted' && $request->accepted_at ? $request->accepted_at->copy()->addSeconds(60)->toIso8601String() : null),
                                resolveCountdown: 0,
                                resolveTimer: null,
                                init() {
                                    this.updateResolveCountdown();
                                    if (this.resolveCountdown > 0) {
                                        this.startResolveCountdown();
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
                                startResolveCountdown() {
                                    if (this.resolveTimer) clearInterval(this.resolveTimer);
                                    this.resolveTimer = setInterval(() => {
                                        this.updateResolveCountdown();
                                        if (this.resolveCountdown === 0) {
                                            clearInterval(this.resolveTimer);
                                        }
                                    }, 1000);
                                },
                                destroy() {
                                    if (this.resolveTimer) clearInterval(this.resolveTimer);
                                },
                                async doAccept() {
                                    if (this.busy) return;
                                    this.busy = true;
                                    this.localStatus = 'accepted';
                                    this.resolveReadyAt = new Date(Date.now() + 60000).toISOString();
                                    this.updateResolveCountdown();
                                    this.startResolveCountdown();
                                    this.flashChange();
                                    try {
                                        await $wire.acceptRequest({{ $request->id }});
                                    } catch (e) {
                                        this.localStatus = 'pending';
                                        this.resolveReadyAt = null;
                                        clearInterval(this.resolveTimer);
                                        this.resolveCountdown = 0;
                                    } finally {
                                        this.busy = false;
                                    }
                                },
                                async doResolve() {
                                    if (this.busy || this.resolveCountdown > 0) return;
                                    this.busy = true;
                                    this.localStatus = 'resolved';
                                    this.flashChange();
                                    try {
                                        await $wire.resolveRequest({{ $request->id }});
                                    } catch (e) {
                                        this.localStatus = 'accepted';
                                    } finally {
                                        this.busy = false;
                                    }
                                },
                                flashChange() {
                                    this.justChanged = true;
                                    setTimeout(() => this.justChanged = false, 600);
                                }
                            }"
                            x-show="localStatus !== 'resolved'"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4"
                        >
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $request->tableSession->table->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $request->tableSession->session_token }}</p>
                            </td>
                            <td class="px-6 py-4">
                                {{-- Pending badge --}}
                                <span x-show="localStatus === 'pending'" x-cloak
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold bg-amber-100 text-amber-700">
                                    Pending
                                </span>
                                {{-- Accepted badge --}}
                                <span x-show="localStatus === 'accepted'" x-cloak
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold bg-sky-100 text-sky-700 transition-all duration-300"
                                    :class="{ 'ring-2 ring-sky-300 ring-offset-1 scale-105': justChanged }">
                                    Accepted
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 font-mono" x-data="{
                                        elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at, true) }}')) || 0,
                                        timer: null,
                                        init() {
                                            this.timer = setInterval(() => this.elapsed++, 1000);
                                        },
                                        destroy() {
                                            clearInterval(this.timer);
                                        },
                                        formatTime(seconds) {
                                            const total = Math.max(0, Math.floor(Math.abs(seconds)));
                                            const m = Math.floor(total / 60);
                                            const s = total % 60;
                                            return `${m}m ${s}s`;
                                        }
                                    }">
                                <span x-text="formatTime(elapsed)"></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <span x-show="localStatus === 'pending'">{{ $request->acceptedBy?->name ?? 'Unassigned' }}</span>
                                <span x-show="localStatus === 'accepted'" x-cloak>{{ $request->acceptedBy?->name ?? auth()->user()->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    {{-- Accept button — visible only when locally pending --}}
                                    <button x-show="localStatus === 'pending'" x-cloak
                                        @click="doAccept()" type="button"
                                        :disabled="busy"
                                        class="rounded-lg border border-sky-300 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:border-sky-400 hover:text-sky-900 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!busy">Accept</span>
                                        <span x-show="busy" x-cloak class="inline-flex items-center gap-1">
                                            <svg class="h-3 w-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            Accepting…
                                        </span>
                                    </button>

                                    {{-- Resolve button — visible only when locally accepted --}}
                                    <button x-show="localStatus === 'accepted'" x-cloak
                                        @click="doResolve()" type="button"
                                        :disabled="busy || resolveCountdown > 0"
                                        class="rounded-lg border border-emerald-300 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:border-emerald-400 hover:text-emerald-900 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!busy && resolveCountdown <= 0">Resolve</span>
                                        <span x-show="!busy && resolveCountdown > 0" x-text="`Wait ${Math.max(1, Math.ceil(resolveCountdown))}s`"></span>
                                        <span x-show="busy" x-cloak class="inline-flex items-center gap-1">
                                            <svg class="h-3 w-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            Resolving…
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 border border-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">All Clear</p>
                                        <p class="mt-1 text-xs text-slate-400">No active requests for your tables right now.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    @endif
</div>
