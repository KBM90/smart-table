<div x-data="{
        handle: null,
        init() {
            if (window.AppRealtime && typeof window.AppRealtime.onSessionChange === 'function') {
                this.handle = window.AppRealtime.onSessionChange(
                    { sessionId: {{ $sessionId }} },
                    () => window.dispatchEvent(new CustomEvent('refresh-status'))
                );
            }
        },
        destroy() {
            if (this.handle && window.AppRealtime && typeof window.AppRealtime.unsubscribe === 'function') {
                window.AppRealtime.unsubscribe(this.handle);
            }
        }
    }" x-on:refresh-status.window="$wire.refreshStatusFromRealtime()" @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif
    class="flex min-h-[70vh] flex-col items-center justify-center space-y-8 py-8">

    @if($blocked)
        <div class="flex flex-col items-center justify-center space-y-4 text-center">
            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-red-500/10 border border-red-500/20">
                <svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Table Blocked</h2>
            <p class="text-slate-400 max-w-sm">This table session has been temporarily restricted. Please see a staff member
                for assistance.</p>
        </div>
    @else
        <div class="text-center space-y-2">
            <h2 class="text-amber-400 font-bold tracking-[0.2em] uppercase text-xs">{{ $tenantName }}</h2>
            <h1 class="text-4xl font-extrabold text-white tracking-tight">{{ $tableName }}</h1>
        </div>

        @if($activeRequest)
            <div
                class="w-full max-w-sm overflow-hidden rounded-3xl border border-slate-700/50 bg-gradient-to-br from-slate-900/90 via-slate-900 to-slate-950 p-8 shadow-2xl shadow-slate-900/80 backdrop-blur-xl relative">
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-amber-500/10 blur-[80px] pointer-events-none">
                </div>

                <div class="flex flex-col items-center justify-center space-y-6 relative z-10">

                    <div class="flex flex-col items-center space-y-3 text-center">
                        <span class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md
                                    {{ $activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING
                    ? 'border-amber-500/30 bg-amber-500/10 text-amber-400'
                    : 'border-emerald-500/30 bg-emerald-500/10 text-emerald-400' }}">
                            @if($activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                </span>
                            @else
                                <span class="h-2 w-2 rounded-full bg-emerald-500 shadow-[0_0_5px_#10b981]"></span>
                            @endif
                            {{ $activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING ? 'Waiter Alerted' : 'Waiter on the way' }}
                        </span>
                        <p class="text-slate-400 text-sm">
                            {{ $activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING
                    ? 'Your request has been sent to the staff.'
                    : 'A staff member is heading to your table now.' }}
                        </p>
                    </div>

                    @if($requestsAhead > 0)
                        <div
                            class="flex w-full items-center justify-center gap-2.5 rounded-xl bg-slate-800/40 border border-slate-700/50 py-3 px-4 shadow-inner">
                            <svg class="h-5 w-5 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span class="text-sm font-medium text-slate-300">
                                <strong class="text-white text-base">{{ $requestsAhead }}</strong> request(s) ahead of you
                            </span>
                        </div>
                    @else
                        <div
                            class="flex w-full items-center justify-center gap-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 py-3 px-4 shadow-inner">
                            <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-bold tracking-wide text-emerald-400">You are next!</span>
                        </div>
                    @endif

                    <div class="w-full bg-slate-950/80 rounded-2xl p-6 border border-slate-800/80 shadow-inner flex flex-col items-center justify-center gap-2"
                        x-data="{ 
                                    elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($activeRequest->created_at) }}')) || 0,
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
                                        const formattedSeconds = s.toString().padStart(2, '0');
                                        return `${m}min ${formattedSeconds}s`;
                                    }
                                }">
                        <span class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Elapsed Time</span>
                        <span class="text-4xl font-light text-white font-mono tracking-wide drop-shadow-md"
                            x-text="formatTime(elapsed)"></span>
                    </div>

                    <button wire:click="cancelRequest" type="button"
                        class="group relative inline-flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl border border-red-500/30 bg-red-500/10 px-5 py-3.5 text-sm font-bold text-red-400 transition-all hover:bg-red-500/20 hover:border-red-500/50 hover:text-red-300 focus:outline-none active:scale-95">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Cancel Request</span>
                    </button>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center mt-6">
                <button wire:click="callWaiter" type="button"
                    class="group relative flex h-64 w-64 items-center justify-center overflow-hidden rounded-full border border-amber-500/40 bg-gradient-to-b from-amber-500/10 to-transparent shadow-[0_0_40px_rgba(251,191,36,0.1)] transition-all duration-300 hover:shadow-[0_0_60px_rgba(251,191,36,0.25)] hover:border-amber-400/60 active:scale-95">
                    <div
                        class="absolute inset-0 rounded-full bg-amber-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="relative flex flex-col items-center justify-center space-y-4">
                        <div
                            class="rounded-full bg-amber-500/10 p-4 mb-2 shadow-inner border border-amber-500/20 group-hover:bg-amber-500/20 transition-colors">
                            <svg class="h-10 w-10 text-amber-400 drop-shadow-lg group-hover:text-amber-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                        <span
                            class="text-xl font-extrabold text-amber-400 tracking-wide uppercase drop-shadow-md group-hover:text-amber-300 transition-colors">Call
                            Waiter</span>
                    </div>
                </button>
                <p class="mt-10 text-slate-500 text-sm font-medium text-center max-w-xs leading-relaxed">
                    Tap the button above to immediately notify a staff member to assist you.
                </p>
            </div>
        @endif
    @endif
</div>