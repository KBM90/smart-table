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
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">{{ __('waiter.requests.label') }}</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ __('waiter.requests.title') }}</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">
            {{ __('waiter.requests.intro') }}
        </p>

        <div class="mt-6">
            <button type="button" x-data @click="$dispatch('open-modal', 'scan-to-assign')"
                class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-sky-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 14h2m4 0h-2m-4 4h6" />
                </svg>
                <span>{{ __('waiter.dashboard.scan_to_assign') }}</span>
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
                    <h2 class="text-lg font-bold text-amber-900">{{ __('waiter.requests.no_tables_title') }}</h2>
                    <p class="mt-2 text-sm text-amber-800 max-w-sm leading-relaxed">
                        {{ __('waiter.requests.no_tables_body') }}
                    </p>
                </div>
            </div>
        </section>
    @else
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">
                        <th class="px-6 py-4">{{ __('waiter.requests.table') }}</th>
                        <th class="px-6 py-4">{{ __('waiter.requests.status') }}</th>
                        <th class="px-6 py-4">{{ __('waiter.requests.elapsed') }}</th>
                        <th class="px-6 py-4">{{ __('waiter.requests.accepted_by') }}</th>
                        <th class="px-6 py-4 text-right">{{ __('waiter.requests.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($requests as $request)
                        <tr wire:key="request-{{ $request->id }}" class="align-top transition-all duration-300"
                            x-data="{
                                localStatus: @js($request->status),
                                busy: false,
                                justChanged: false,
                               resolveCountdown: {{ $request->status === 'accepted' && $request->accepted_at ? max(0, 60 - now()->diffInSeconds($request->accepted_at)) : 0 }},
resolveTimer: null,
init() {
    if (this.resolveCountdown > 0) {
        this.resolveTimer = setInterval(() => {
            this.resolveCountdown = Math.max(0, this.resolveCountdown - 1);
            if (this.resolveCountdown === 0) clearInterval(this.resolveTimer);
        }, 1000);
    }
},
destroy() { if (this.resolveTimer) clearInterval(this.resolveTimer); },
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
                            @if ($request->order)
    <div class="mt-2 max-w-xs rounded-lg border border-indigo-100 bg-indigo-50/60 px-2.5 py-2">
        <p class="flex items-center gap-1 text-[10px] font-black uppercase tracking-wide text-indigo-600">
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
            {{ __('owner.requests.order_label') }}
        </p>
        <ul class="mt-1 space-y-0.5 text-[11px] text-slate-600">
            @foreach ($request->order->items as $item)
                <li class="flex justify-between gap-2">
                    <span class="truncate">{{ $item->quantity }}x {{ $item->product_name }}</span>
                    <span class="shrink-0 font-semibold text-slate-700">${{ $item->subtotalFormatted() }}</span>
                </li>
            @endforeach
        </ul>
        <p class="mt-1 flex justify-between border-t border-indigo-100 pt-1 text-[11px] font-black text-indigo-700">
            <span>{{ __('owner.requests.order_total') }}</span>
            <span>${{ $request->order->totalFormatted() }}</span>
        </p>
        @if ($request->order->note)
            <p class="mt-1 text-[10px] italic text-slate-500">&ldquo;{{ $request->order->note }}&rdquo;</p>
        @endif
    </div>
@endif
                            </td>
                           
                            <td class="px-6 py-4">
                                {{-- Pending badge --}}
                                <span x-show="localStatus === 'pending'" x-cloak
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold bg-amber-100 text-amber-700">
                                    {{ __('waiter.requests.pending') }}
                                </span>
                                {{-- Accepted badge --}}
                                <span x-show="localStatus === 'accepted'" x-cloak
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold bg-sky-100 text-sky-700 transition-all duration-300"
                                    :class="{ 'ring-2 ring-sky-300 ring-offset-1 scale-105': justChanged }">
                                    {{ __('waiter.requests.accepted') }}
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
                                <span x-show="localStatus === 'pending'">{{ $request->acceptedBy?->name ?? __('waiter.requests.unassigned') }}</span>
                                <span x-show="localStatus === 'accepted'" x-cloak>{{ $request->acceptedBy?->name ?? auth()->user()->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    {{-- Accept button — visible only when locally pending --}}
                                    <button x-show="localStatus === 'pending'" x-cloak
                                        @click="doAccept()" type="button"
                                        :disabled="busy"
                                        class="rounded-lg border border-sky-300 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:border-sky-400 hover:text-sky-900 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!busy">{{ __('waiter.requests.accept') }}</span>
                                        <span x-show="busy" x-cloak class="inline-flex items-center gap-1">
                                            <svg class="h-3 w-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            {{ __('waiter.requests.accepting') }}
                                        </span>
                                    </button>

                                    {{-- Resolve button — visible only when locally accepted --}}
                                    <button x-show="localStatus === 'accepted'" x-cloak
                                        @click="doResolve()" type="button"
                                        :disabled="busy || resolveCountdown > 0"
                                        class="rounded-lg border border-emerald-300 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:border-emerald-400 hover:text-emerald-900 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!busy && resolveCountdown <= 0">{{ __('waiter.requests.resolve') }}</span>
                                        <span x-show="!busy && resolveCountdown > 0" x-text="@js(__('waiter.requests.wait_seconds', ['seconds' => '__SECONDS__'])).replace('__SECONDS__', Math.max(1, Math.ceil(resolveCountdown)))"></span>
                                        <span x-show="busy" x-cloak class="inline-flex items-center gap-1">
                                            <svg class="h-3 w-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            {{ __('waiter.requests.resolving') }}
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
                                        <p class="text-sm font-bold text-slate-800">{{ __('waiter.requests.all_clear') }}</p>
                                        <p class="mt-1 text-xs text-slate-400">{{ __('waiter.requests.all_clear_body') }}</p>
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
