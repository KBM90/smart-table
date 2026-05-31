<div
    x-data="{
        handle: null,
        init() {
            this.handle = window.AppRealtime.onRequestChange(
                { tableSessionId: {{ $sessionId }} },
                () => window.dispatchEvent(new CustomEvent('customer-request-status-refresh')),
            );
        },
        destroy() {
            window.AppRealtime.unsubscribe(this.handle);
        },
    }"
    x-on:customer-request-status-refresh.window="$wire.dispatch('refresh-status')"
    class="space-y-6"
>
    <section class="rounded-3xl border border-slate-800 bg-slate-900 p-8 shadow-2xl shadow-slate-950/50">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Smart Table</p>
        <h1 class="mt-4 text-3xl font-semibold text-white">{{ $tenantName }} — Table {{ $tableName }}</h1>

        @if ($blocked)
            <div class="mt-6 rounded-2xl border border-rose-500/30 bg-rose-500/10 p-5 text-sm text-rose-100">
                This table is currently in use. Please ask a waiter to free it.
            </div>
        @elseif ($activeRequest)
            <div @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s="refreshRequestStatus" @else wire:poll.3s="refreshRequestStatus" @endif class="mt-6 space-y-5">
                <div class="rounded-2xl border border-amber-500/30 bg-amber-500/10 p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-300">Request status</p>

                    <div
                        class="mt-4 flex items-end justify-between gap-4"
                        x-data="{ elapsed: {{ now()->diffInSeconds($activeRequest->created_at) }}, timer: null, init() { this.timer = setInterval(() => this.elapsed++, 1000) } }"
                    >
                        <div>
                            <p class="text-2xl font-semibold text-white">
                                @if ($activeRequest->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                    Accepted by {{ $activeRequest->acceptedBy?->name ?? 'a waiter' }}
                                @else
                                    Waiting for a waiter…
                                @endif
                            </p>
                            <p class="mt-2 text-sm text-slate-300">Elapsed time: <span x-text="elapsed"></span>s</p>
                        </div>

                        <button wire:click="cancelRequest" type="button" class="rounded-xl border border-rose-500/40 px-4 py-3 text-sm font-semibold text-rose-100 transition hover:border-rose-400 hover:text-white">
                            Cancel request
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-6 space-y-6">
                <p class="text-sm text-slate-300">Need help? Call a waiter from your table session or browse the live product catalog for this table.</p>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button wire:click="callWaiter" type="button" class="inline-flex justify-center rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
                        Call Waiter
                    </button>

                    <a href="{{ route('customer.catalog', ['qr_token' => $qrToken]) }}" class="inline-flex justify-center rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:border-amber-400 hover:text-amber-300">
                        View Catalog
                    </a>
                </div>
            </div>
        @endif
    </section>
</div>