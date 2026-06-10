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
    }" x-on:waiter-requests-refresh.window="$wire.dispatch('refresh')" @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif class="space-y-6">

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

    {{-- ... rest of the existing view (no-assignment callout / table) stays unchanged ... --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">Waiter requests</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">My Table Requests</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">
            Active service requests for your assigned tables. Updates live when Realtime is available.
        </p>
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
                        <tr class="align-top">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $request->tableSession->table->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $request->tableSession->session_token }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $request->status === \App\Models\ServiceRequest::STATUS_PENDING ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                                    {{ ucfirst($request->status) }}
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
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $request->acceptedBy?->name ?? 'Unassigned' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <button wire:click="acceptRequest({{ $request->id }})" type="button"
                                            class="rounded-lg border border-sky-300 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:border-sky-400 hover:text-sky-900">
                                            Accept
                                        </button>
                                    @endif

                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                        <button wire:click="resolveRequest({{ $request->id }})" type="button"
                                            class="rounded-lg border border-emerald-300 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:border-emerald-400 hover:text-emerald-900">
                                            Resolved
                                        </button>
                                    @endif
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