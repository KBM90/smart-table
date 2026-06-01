<div
    x-data="{
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
    }"
    x-on:owner-requests-refresh.window="$wire.dispatch('refresh')"
    @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif
    class="space-y-6"
>
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-6 shadow-2xl shadow-slate-950/40">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Owner requests</p>
        <h1 class="mt-3 text-3xl font-semibold text-white">Active service requests</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-300">Requests update live with Supabase Realtime when configured, with Livewire polling kept as fallback.</p>
    </section>

    <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
        <table class="min-w-full divide-y divide-slate-800">
            <thead class="bg-slate-950/70">
                <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">
                    <th class="px-6 py-4">Table</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Elapsed</th>
                    <th class="px-6 py-4">Session</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse ($requests as $request)
                    <tr class="align-top">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-white">{{ $request->tableSession->table->name }}</p>
                            <p class="mt-1 text-xs text-slate-400">{{ $request->tableSession->session_token }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $request->status === \App\Models\ServiceRequest::STATUS_PENDING ? 'bg-amber-500/15 text-amber-300' : 'bg-sky-500/15 text-sky-300' }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td 
                            class="px-6 py-4 text-sm text-slate-300 font-mono"
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
                        <td class="px-6 py-4 text-xs text-slate-400" title="Session {{ $request->tableSession->id }}">
                            View session
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap justify-end gap-2">
                                @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                    <button wire:click="acceptRequest({{ $request->id }})" type="button" class="rounded-lg border border-amber-500/40 px-3 py-2 text-xs font-semibold text-amber-200 hover:border-amber-400 hover:text-amber-100">
                                        Accept
                                    </button>
                                @endif

                                @if ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                    <button wire:click="resolveRequest({{ $request->id }})" type="button" class="rounded-lg border border-emerald-500/40 px-3 py-2 text-xs font-semibold text-emerald-200 hover:border-emerald-400 hover:text-emerald-100">
                                        Resolved
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">No active requests right now.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>