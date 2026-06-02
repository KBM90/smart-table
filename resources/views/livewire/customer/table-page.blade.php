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
    class="flex min-h-[70vh] flex-col items-center justify-center space-y-10 py-8 relative z-10">

    @if($blocked)
        <!-- Blocked State -->
        <div class="flex flex-col items-center justify-center space-y-5 text-center animate-fade-in-up">
            <div
                class="flex h-24 w-24 items-center justify-center rounded-full bg-red-50 border border-red-100 shadow-lg shadow-red-100/50">
                <svg class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Table Restricted</h2>
                <p class="mt-2 text-slate-500 font-medium max-w-sm leading-relaxed">This table session has been temporarily
                    paused. Please see a staff member for assistance.</p>
            </div>
        </div>
    @else
        <!-- Header Info -->
        <div class="text-center space-y-2">
            <h2 class="text-indigo-500 font-bold tracking-[0.25em] uppercase text-3xl">{{ $tenantName }}</h2>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight drop-shadow-sm">Table N° : {{ $tableName }}</h2>
        </div>

        @if($activeRequest)
            <!-- Active Request State (Glassmorphism Card) -->
            <div
                class="w-full max-w-sm overflow-hidden rounded-[2rem] border border-white/60 bg-white/70 p-8 shadow-2xl shadow-indigo-100/60 backdrop-blur-xl relative transition-all duration-500">

                <!-- Ambient Card Glow -->
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-amber-200/30 blur-[60px] pointer-events-none">
                </div>
                <div
                    class="absolute -left-10 -bottom-10 h-48 w-48 rounded-full bg-indigo-200/30 blur-[60px] pointer-events-none">
                </div>

                <div class="flex flex-col items-center justify-center space-y-8 relative z-10">

                    <!-- Status Badge -->
                    <div class="flex flex-col items-center space-y-3 text-center">
                        <span class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md transition-colors duration-300
                                                                                                    {{ $activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING
                    ? 'border-amber-200 bg-amber-50 text-amber-600'
                    : 'border-emerald-200 bg-emerald-50 text-emerald-600' }}">
                            @if($activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                <span class="relative flex h-2.5 w-2.5">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                                </span>
                            @else
                                <span class="relative flex h-2.5 w-2.5">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-40"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                            @endif
                            {{ $activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING ? 'Waiter Alerted' : 'Waiter Approaching' }}
                        </span>
                        <p class="text-slate-500 text-sm font-medium">
                            {{ $activeRequest->status === \App\Models\ServiceRequest::STATUS_PENDING
                    ? 'Your request has been broadcasted to the staff.'
                    : 'A staff member is heading to your table now.' }}
                        </p>
                    </div>

                    <!-- Queue Position Indicator -->
                    @if($requestsAhead > 0)
                        <div
                            class="flex w-full items-center justify-center gap-3 rounded-2xl bg-amber-50/50 border border-amber-100/80 py-3.5 px-4 shadow-inner">
                            <svg class="h-5 w-5 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span class="text-sm font-medium text-slate-600">
                                <strong class="text-slate-900 text-base font-black">{{ $requestsAhead }}</strong> request(s) ahead
                                of you
                            </span>
                        </div>
                    @else
                        <div
                            class="flex w-full items-center justify-center gap-2.5 rounded-2xl bg-emerald-50 border border-emerald-100 py-3.5 px-4 shadow-inner">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-black tracking-wide text-emerald-600 uppercase">You are next!</span>
                        </div>
                    @endif

                    <!-- Timer -->
                    <div class="w-full bg-slate-50/80 rounded-2xl p-6 border border-slate-200/60 shadow-inner flex flex-col items-center justify-center gap-2"
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
                        <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">Wait Time</span>
                        <span class="text-4xl font-light text-slate-800 font-mono tracking-tight drop-shadow-sm"
                            x-text="formatTime(elapsed)"></span>
                    </div>

                    <!-- Cancel Action -->
                    <button wire:click="cancelRequest" type="button"
                        class="group relative inline-flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-bold text-red-600 transition-all hover:bg-red-100 hover:border-red-300 hover:text-red-700 hover:shadow-md focus:outline-none active:scale-95">
                        <svg class="h-4 w-4 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Cancel Request</span>
                    </button>
                </div>
            </div>
        @else
            <!-- Premium Golden Hotel Ring Button -->
            <div class="flex flex-col items-center justify-center mt-4">

                <!-- Scoped Animation Styles -->
                <style>
                    @keyframes premium-bell-vibrate {

                        0%,
                        65%,
                        100% {
                            transform: scale(1) rotate(0deg);
                        }

                        68% {
                            transform: scale(1.04) rotate(-4deg);
                        }

                        71% {
                            transform: scale(0.96) rotate(5deg);
                        }

                        74% {
                            transform: scale(1.04) rotate(-4deg);
                        }

                        77% {
                            transform: scale(0.96) rotate(4deg);
                        }

                        80% {
                            transform: scale(1.02) rotate(-2deg);
                        }

                        83% {
                            transform: scale(0.98) rotate(2deg);
                        }

                        86% {
                            transform: scale(1) rotate(0deg);
                        }
                    }

                    .animate-bell-vibrate {
                        animation: premium-bell-vibrate 2.5s infinite ease-in-out;
                    }
                </style>

                <button wire:click="callWaiter" type="button"
                    class="group relative flex h-72 w-72 items-center justify-center rounded-full bg-gradient-to-br from-yellow-200 via-amber-400 to-amber-600 shadow-[0_20px_50px_-12px_rgba(217,119,6,0.5)] transition-all duration-500 hover:shadow-[0_20px_60px_-10px_rgba(217,119,6,0.7)] hover:-translate-y-2 active:scale-95 border border-yellow-300/50">

                    <!-- Orbiting Light Track & Particle -->
                    <div class="absolute -inset-4 rounded-full border border-amber-400/20 pointer-events-none"></div>
                    <div class="absolute -inset-4 rounded-full pointer-events-none animate-spin"
                        style="animation-duration: 3s;">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 h-4 w-4 rounded-full bg-white shadow-[0_0_15px_5px_rgba(255,255,255,0.9),0_0_25px_10px_rgba(245,158,11,0.7)]">
                        </div>
                    </div>

                    <!-- Outer Rim Highlight (Adds a glossy reflection to the outermost edge) -->
                    <div class="absolute inset-0 rounded-full border-4 border-white/40 mix-blend-overlay pointer-events-none">
                    </div>

                    <!-- Inner Bevel (Creates the main "Ring" depth) -->
                    <div
                        class="absolute inset-4 rounded-full bg-gradient-to-tl from-amber-600 via-amber-400 to-yellow-200 shadow-[inset_0_10px_20px_rgba(180,83,9,0.5)] flex flex-col items-center justify-center transition-transform duration-500 group-hover:scale-105 border border-amber-600/30">

                        <!-- Center Dome (The pushable center of the bell) -->
                        <div
                            class="absolute inset-6 rounded-full bg-gradient-to-br from-yellow-100 via-amber-300 to-amber-500 shadow-[0_15px_30px_rgba(180,83,9,0.6),inset_0_4px_10px_rgba(255,255,255,0.8)] flex flex-col items-center justify-center border border-yellow-200/80">

                            <!-- Vibrating Content Group (Simulates periodic concierge bell ringing) -->
                            <div class="flex flex-col items-center justify-center animate-bell-vibrate select-none">
                                <!-- Icon embedded in the gold -->
                                <div
                                    class="rounded-full bg-amber-900/10 p-4 mb-2 shadow-[inset_0_4px_8px_rgba(180,83,9,0.3)] transition-colors group-hover:bg-amber-900/20">
                                    <svg class="h-12 w-12 text-amber-950 drop-shadow-md" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>
                                </div>

                                <span
                                    class="text-md font-black text-amber-950 tracking-widest uppercase drop-shadow-[0_2px_2px_rgba(255,255,255,0.4)]">
                                    Call Waiter
                                </span>
                            </div>

                        </div>
                    </div>
                </button>

                <p
                    class="mt-12 text-slate-500 text-sm font-medium text-center max-w-xs leading-relaxed bg-white/50 backdrop-blur-sm px-6 py-3 rounded-2xl border border-white/60 shadow-sm">
                    Tap the golden ring above to immediately notify a staff member to assist you.
                </p>
            </div>
        @endif
    @endif
</div>