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
    @if ($blocked)
        <section class="rounded-3xl border border-rose-500/30 bg-rose-500/10 p-8 shadow-2xl shadow-rose-950/20">
            <p class="text-sm font-medium uppercase tracking-[0.3em] text-rose-400">Smart Table</p>
            <h1 class="mt-4 text-3xl font-semibold text-white">{{ $tenantName }} — Table {{ $tableName }}</h1>
            <div class="mt-6 rounded-2xl border border-rose-500/30 bg-rose-500/20 p-5 text-sm text-rose-100">
                This table is currently in use. Please ask a waiter to free it.
            </div>
        </section>
    @elseif ($activeRequest)
        <section 
            @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s="refreshRequestStatus" @else wire:poll.3s="refreshRequestStatus" @endif 
            class="rounded-3xl border border-amber-500/40 bg-gradient-to-br from-amber-600/25 to-amber-950/30 p-8 shadow-2xl shadow-amber-950/30 backdrop-blur-md transition-all duration-500"
        >
            <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Smart Table</p>
            <h1 class="mt-4 text-3xl font-semibold text-white">{{ $tenantName }} — Table {{ $tableName }}</h1>
            
            <div class="mt-6 space-y-6">
                <div class="rounded-2xl border border-amber-500/30 bg-amber-500/10 p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-300">Request status</p>

                    <div
                        class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6"
                        x-data="{ elapsed: {{ now()->diffInSeconds($activeRequest->created_at) }}, timer: null, init() { this.timer = setInterval(() => this.elapsed++, 1000) }, destroy() { clearInterval(this.timer) } }"
                    >
                        <div>
                            <p class="text-2xl font-semibold text-white">
                                @if ($activeRequest->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                    Accepted by {{ $activeRequest->acceptedBy?->name ?? 'a waiter' }}
                                @else
                                    Please wait, a waiter has been called…
                                @endif
                            </p>
                            <p class="mt-2 text-sm text-amber-200/80">
                                Time waiting: 
                                <span class="font-mono text-base font-bold text-white bg-amber-500/20 px-2 py-0.5 rounded">
                                    <span x-text="Math.floor(elapsed / 60)"></span>m <span x-text="elapsed % 60"></span>s
                                </span>
                            </p>
                        </div>

                        <button wire:click="cancelRequest" type="button" class="rounded-xl border border-rose-500/40 bg-rose-950/20 px-5 py-3 text-sm font-semibold text-rose-100 transition hover:border-rose-400 hover:bg-rose-950/40 hover:text-white">
                            Cancel request
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="rounded-3xl border border-slate-800 bg-slate-900 p-8 shadow-2xl shadow-slate-950/50 transition-all duration-500">
            <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Smart Table</p>
            <h1 class="mt-4 text-3xl font-semibold text-white">{{ $tenantName }} — Table {{ $tableName }}</h1>

            <div class="mt-6 space-y-6">
                <p class="text-sm text-slate-300">Need help? Call a waiter from your table session.</p>

                <div class="flex flex-col gap-3">
                    <button wire:click="callWaiter" type="button" class="inline-flex justify-center rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400 shadow-lg shadow-amber-500/20 active:scale-95">
                        Call Waiter
                    </button>
                </div>
            </div>
        </section>
    @endif

    @if (!$blocked)
        <section class="rounded-3xl border border-slate-800/60 bg-slate-900/40 p-8 shadow-xl shadow-slate-950/20 backdrop-blur-sm transition duration-300 hover:border-amber-500/30 hover:bg-slate-900/60">
            <div class="flex flex-col gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-white">Menu Catalog</h2>
                    <p class="mt-2 text-sm text-slate-300">Browse the live product catalog and view our menu offerings for this table.</p>
                </div>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('customer.catalog', ['qr_token' => $qrToken]) }}" class="inline-flex justify-center rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:border-amber-400 hover:text-amber-300">
                        View Catalog
                    </a>
                </div>
            </div>
        </section>
    @endif
</div>