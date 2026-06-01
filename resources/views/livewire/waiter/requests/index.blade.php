<div
    x-data="{
        handle: null,
        init() {
            this.handle = window.AppRealtime.onRequestChange(
                { tenantId: {{ auth()->user()->tenant_id }} },
                (payload) => {
                    if (window.AppRealtimeFilters.shouldRefreshWaiterList(payload)) {
                        window.dispatchEvent(new CustomEvent('waiter-requests-refresh'));
                    }
                },
            );
        },
        destroy() {
            window.AppRealtime.unsubscribe(this.handle);
        },
    }"
    x-on:waiter-requests-refresh.window="$wire.dispatch('refresh')"
    @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif
    class="space-y-6"
>
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">Waiter requests</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Active floor requests</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">Pending and accepted service requests for your tenant update live when Realtime is available.</p>
    </section>

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
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $request->status === \App\Models\ServiceRequest::STATUS_PENDING ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td 
                            class="px-6 py-4 text-sm text-slate-600 font-mono"
                            x-data="{ 
                                elapsed: {{ now()->diffInSeconds($request->created_at) }},
                                timer: null,
                                init() { 
                                    this.timer = setInterval(() => this.elapsed++, 1000); 
                                },
                                destroy() { 
                                    clearInterval(this.timer); 
                                },
                                formatTime(seconds) {
                                    const m = Math.floor(seconds / 60);
                                    const s = seconds % 60;
                                    return `${m}m ${s}s`;
                                }
                            }"
                        >
                            <span x-text="formatTime(elapsed)"></span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $request->acceptedBy?->name ?? 'Unassigned' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap justify-end gap-2">
                                @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                    <button wire:click="acceptRequest({{ $request->id }})" type="button" class="rounded-lg border border-sky-300 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:border-sky-400 hover:text-sky-900">
                                        Accept
                                    </button>
                                @endif

                                @if ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                    <button wire:click="resolveRequest({{ $request->id }})" type="button" class="rounded-lg border border-emerald-300 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:border-emerald-400 hover:text-emerald-900">
                                        Resolved
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">No active requests right now.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>