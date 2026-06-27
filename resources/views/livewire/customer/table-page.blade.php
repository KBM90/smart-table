<div x-data="tablePage({
        sessionId:         {{ $sessionId }},
        status:            '{{ $status }}',
        requestId:         {{ $requestId ?? 'null' }},
        requestsAhead:     {{ $requestsAhead }},
        elapsedSeconds:    {{ $elapsedSeconds }},
        resolvedRequestId: {{ $resolvedRequestId ?? 'null' }},
    })" class="flex min-h-[70vh] flex-col items-center justify-center space-y-10 py-8 relative z-10">

    {{-- ── BLOCKED ──────────────────────────────────────────────────────────── --}}
    <template x-if="status === 'blocked'">
        <div class="flex flex-col items-center justify-center space-y-5 text-center animate-fade-in-up">
            <div
                class="flex h-24 w-24 items-center justify-center rounded-full bg-red-50 border border-red-100 shadow-lg shadow-red-100/50">
                <svg class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 115.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Table Restricted</h2>
                <p class="mt-2 text-slate-500 font-medium max-w-sm leading-relaxed">This table session has been
                    temporarily
                    paused. Please see a staff member for assistance.</p>
            </div>
        </div>
    </template>

    {{-- ── NOT BLOCKED: venue header (always visible when not blocked) ─────── --}}
    <template x-if="status !== 'blocked'">
        <div class="text-center space-y-2">
            <h2 class="text-indigo-500 font-bold tracking-[0.25em] uppercase text-3xl">{{ $tenantName }}</h2>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight drop-shadow-sm">Table N° : {{ $tableName }}
            </h2>
        </div>
    </template>

    {{-- ── REVIEW PROMPT (shown after request is resolved) ────────────────── --}}
    <template x-if="reviewPrompt.visible">
        <div
            class="w-full max-w-sm overflow-hidden rounded-[2rem] border border-white/60 bg-white/90 p-8 shadow-2xl shadow-indigo-100/60 backdrop-blur-xl relative transition-all duration-500">

            <!-- Ambient glow -->
            <div
                class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-amber-200/30 blur-[60px] pointer-events-none">
            </div>
            <div
                class="absolute -left-10 -bottom-10 h-48 w-48 rounded-full bg-indigo-200/20 blur-[60px] pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col items-center space-y-6 text-center">

                <!-- Icon -->
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 border border-emerald-100 shadow-md">
                    <svg class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Request Completed!</h3>
                    <p class="mt-1.5 text-sm text-slate-500 font-medium">How was the service? Rate your experience.</p>
                </div>

                <!-- Star Rating -->
                <div class="flex items-center justify-center gap-2" x-data>
                    <template x-for="star in [1,2,3,4,5]" :key="star">
                        <button type="button" @click="reviewPrompt.rating = star"
                            @mouseover="reviewPrompt.hoverRating = star" @mouseleave="reviewPrompt.hoverRating = 0"
                            class="transition-transform hover:scale-110 focus:outline-none"
                            :aria-label="'Rate ' + star + ' stars'">
                            <svg class="h-10 w-10 transition-colors duration-150"
                                :class="star <= (reviewPrompt.hoverRating || reviewPrompt.rating) ? 'text-amber-400' : 'text-slate-200'"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </button>
                    </template>
                </div>

                <!-- Label under stars -->
                <p class="text-xs font-semibold text-slate-400 -mt-2" x-text="reviewPrompt.ratingLabel()"></p>

                <!-- Optional comment -->
                <div class="w-full">
                    <textarea x-model="reviewPrompt.comment" placeholder="Optional comment…" rows="3"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none resize-none transition"
                        maxlength="1000"></textarea>
                </div>

                <!-- Feedback message -->
                <p x-show="reviewPrompt.feedbackMsg" x-text="reviewPrompt.feedbackMsg" class="text-xs font-semibold"
                    :class="reviewPrompt.feedbackOk ? 'text-emerald-600' : 'text-red-500'"></p>

                <!-- Actions -->
                <div class="flex w-full gap-3">
                    <button @click="reviewPrompt.submit(sessionId)"
                        :disabled="reviewPrompt.loading || reviewPrompt.rating === 0 || reviewPrompt.submitted"
                        type="button"
                        class="flex-1 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:translate-y-0">
                        <span
                            x-text="reviewPrompt.loading ? 'Sending…' : reviewPrompt.submitted ? 'Sent ✓' : 'Submit'"></span>
                    </button>
                    <button @click="reviewPrompt.dismiss()" type="button"
                        class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-100 active:scale-95 transition-all duration-200">
                        Skip
                    </button>
                </div>

            </div>
        </div>
    </template>

    {{-- ── ACTIVE REQUEST (pending / accepted) ─────────────────────────────── --}}
    <template x-if="(status === 'pending' || status === 'accepted') && !reviewPrompt.visible">
        <div
            class="w-full max-w-sm overflow-hidden rounded-[2rem] border border-white/60 bg-white/70 p-8 shadow-2xl shadow-indigo-100/60 backdrop-blur-xl relative transition-all duration-500">

            <!-- Ambient Card Glow -->
            <div
                class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-amber-200/30 blur-[60px] pointer-events-none">
            </div>
            <div
                class="absolute -left-10 -bottom-10 h-48 w-48 rounded-full bg-indigo-200/30 blur-[60px] pointer-events-none">
            </div>

            <div class="flex flex-col items-center justify-center space-y-8 relative z-10">

                <!-- Status Badge -->
                <div class="flex flex-col items-center space-y-3 text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md transition-colors duration-300"
                        :class="status === 'pending'
                            ? 'border-amber-200 bg-amber-50 text-amber-600'
                            : 'border-emerald-200 bg-emerald-50 text-emerald-600'">
                        <!-- Pending dot -->
                        <template x-if="status === 'pending'">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                            </span>
                        </template>
                        <!-- Accepted dot -->
                        <template x-if="status === 'accepted'">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-40"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                            </span>
                        </template>
                        <span x-text="status === 'pending' ? 'Waiter Alerted' : 'Waiter Approaching'"></span>
                    </span>
                    <p class="text-slate-500 text-sm font-medium" x-text="status === 'pending'
                            ? 'Your request has been broadcasted to the staff.'
                            : 'A staff member is heading to your table now.'">
                    </p>
                </div>

                <!-- Queue Position -->
                <template x-if="requestsAhead > 0">
                    <div
                        class="flex w-full items-center justify-center gap-3 rounded-2xl bg-amber-50/50 border border-amber-100/80 py-3.5 px-4 shadow-inner">
                        <svg class="h-5 w-5 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span class="text-sm font-medium text-slate-600">
                            <strong class="text-slate-900 text-base font-black" x-text="requestsAhead"></strong>
                            <span
                                x-text="requestsAhead === 1 ? ' request ahead of you' : ' requests ahead of you'"></span>
                        </span>
                    </div>
                </template>
                <template x-if="requestsAhead === 0">
                    <div
                        class="flex w-full items-center justify-center gap-2.5 rounded-2xl bg-emerald-50 border border-emerald-100 py-3.5 px-4 shadow-inner">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-black tracking-wide text-emerald-600 uppercase">You are next!</span>
                    </div>
                </template>

                <!-- Timer -->
                <div
                    class="w-full bg-slate-50/80 rounded-2xl p-6 border border-slate-200/60 shadow-inner flex flex-col items-center justify-center gap-2">
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">Wait Time</span>
                    <span class="text-4xl font-light text-slate-800 font-mono tracking-tight drop-shadow-sm"
                        x-text="formatTime(elapsed)"></span>
                </div>

                <!-- Cancel -->
                <button @click="cancelRequest()" :disabled="loading" type="button"
                    class="group relative inline-flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-bold text-red-600 transition-all hover:bg-red-100 hover:border-red-300 hover:text-red-700 hover:shadow-md focus:outline-none active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="h-4 w-4 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span x-text="loading ? 'Cancelling…' : 'Cancel Request'"></span>
                </button>

            </div>
        </div>
    </template>

    {{-- ── IDLE: golden call-waiter button ─────────────────────────────────── --}}
    <template x-if="status === 'idle' && !reviewPrompt.visible">
        <div class="flex flex-col items-center justify-center mt-4">

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

            <button @click="callWaiter()" :disabled="loading" type="button"
                class="group relative flex h-72 w-72 items-center justify-center rounded-full bg-gradient-to-br from-yellow-200 via-amber-400 to-amber-600 shadow-[0_20px_50px_-12px_rgba(217,119,6,0.5)] transition-all duration-500 hover:shadow-[0_20px_60px_-10px_rgba(217,119,6,0.7)] hover:-translate-y-2 active:scale-95 border border-yellow-300/50 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                <!-- Orbiting Light Track & Particle -->
                <div class="absolute -inset-4 rounded-full border border-amber-400/20 pointer-events-none"></div>
                <div class="absolute -inset-4 rounded-full pointer-events-none animate-spin"
                    style="animation-duration: 3s;">
                    <div
                        class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 h-4 w-4 rounded-full bg-white shadow-[0_0_15px_5px_rgba(255,255,255,0.9),0_0_25px_10px_rgba(245,158,11,0.7)]">
                    </div>
                </div>

                <!-- Outer Rim Highlight -->
                <div
                    class="absolute inset-0 rounded-full border-4 border-white/40 mix-blend-overlay pointer-events-none">
                </div>

                <!-- Inner Bevel -->
                <div
                    class="absolute inset-4 rounded-full bg-gradient-to-tl from-amber-600 via-amber-400 to-yellow-200 shadow-[inset_0_10px_20px_rgba(180,83,9,0.5)] flex flex-col items-center justify-center transition-transform duration-500 group-hover:scale-105 border border-amber-600/30">

                    <!-- Center Dome -->
                    <div
                        class="absolute inset-6 rounded-full bg-gradient-to-br from-yellow-100 via-amber-300 to-amber-500 shadow-[0_15px_30px_rgba(180,83,9,0.6),inset_0_4px_10px_rgba(255,255,255,0.8)] flex flex-col items-center justify-center border border-yellow-200/80">

                        <!-- Vibrating Content -->
                        <div class="flex flex-col items-center justify-center animate-bell-vibrate select-none">
                            <div
                                class="rounded-full bg-amber-900/10 p-4 mb-2 shadow-[inset_0_4px_8px_rgba(180,83,9,0.3)] transition-colors group-hover:bg-amber-900/20">
                                <svg class="h-12 w-12 text-amber-950 drop-shadow-md" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </div>
                            <span x-text="loading ? 'Sending…' : 'Call Waiter'"
                                class="text-md font-black text-amber-950 tracking-widest uppercase drop-shadow-[0_2px_2px_rgba(255,255,255,0.4)]">
                            </span>
                        </div>

                    </div>
                </div>
            </button>

            <p
                class="mt-12 text-slate-500 text-sm font-medium text-center max-w-xs leading-relaxed bg-white/50 backdrop-blur-sm px-6 py-3 rounded-2xl border border-white/60 shadow-sm">
                Tap the golden ring above to immediately notify a staff member to assist you.
            </p>

            <!-- Catalog Navigation Link -->
            <a href="{{ route('customer.catalog', ['qr_token' => $qrToken]) }}"
                class="mt-6 group inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <svg class="h-5 w-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>View Menu & Catalog</span>
            </a>
        </div>
    </template>

</div>

<script>
    function tablePage({ sessionId, status, requestId, requestsAhead, elapsedSeconds, resolvedRequestId }) {
        return {
            status,
            requestId,
            requestsAhead,
            elapsed: elapsedSeconds,
            loading: false,
            _timer: null,
            _handle: null,

            // ── Review prompt state ────────────────────────────────────────────
            reviewPrompt: {
                visible: resolvedRequestId !== null,
                requestId: resolvedRequestId,
                rating: 0,
                hoverRating: 0,
                comment: '',
                loading: false,
                submitted: false,
                feedbackMsg: '',
                feedbackOk: false,

                ratingLabel() {
                    const labels = ['', 'Poor', 'Fair', 'Good', 'Great', 'Excellent'];
                    return labels[this.hoverRating || this.rating] || 'Tap a star to rate';
                },

                async submit(sessionId) {
                    if (this.loading || this.submitted || this.rating === 0) return;
                    this.loading = true;
                    this.feedbackMsg = '';

                    try {
                        const res = await fetch('/api/reviews', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            },
                            body: JSON.stringify({
                                session_id: sessionId,
                                request_id: this.requestId,
                                rating: this.rating,
                                comment: this.comment || null,
                            }),
                        });

                        if (res.status === 409) {
                            // Already reviewed
                            this.feedbackMsg = 'You already submitted a review for this visit.';
                            this.feedbackOk = false;
                            this.submitted = true;
                            setTimeout(() => { this.visible = false; }, 2500);
                            return;
                        }

                        if (!res.ok) {
                            const data = await res.json().catch(() => ({}));
                            this.feedbackMsg = data.message || 'Something went wrong. Please try again.';
                            this.feedbackOk = false;
                            return;
                        }

                        this.submitted = true;
                        this.feedbackMsg = 'Thank you for your feedback!';
                        this.feedbackOk = true;
                        setTimeout(() => { this.visible = false; }, 2000);
                    } catch {
                        this.feedbackMsg = 'Network error. Please try again.';
                        this.feedbackOk = false;
                    } finally {
                        this.loading = false;
                    }
                },

                dismiss() {
                    this.visible = false;
                },
            },

            init() {
                if (this.status === 'pending' || this.status === 'accepted') {
                        this._startTimer();
                }

                if (window.AppRealtime && typeof window.AppRealtime.onSessionChange === 'function') {
                    this._handle = window.AppRealtime.onSessionChange(
                        { sessionId },
                        (payload) => this._handlePush(payload)
                    );
                }
            },

                    destroy() {
                        clearInterval(this._timer);
                        if (this._handle && window.AppRealtime?.unsubscribe) {
                            window.AppRealtime.unsubscribe(this._handle);
                        }
                    },

            // ── Realtime push ──────────────────────────────────────────────────
            _handlePush(payload) {
                const r = payload.new ?? payload;

                if (r.status === 'resolved') {
                    // Show review prompt before going idle
                    if (r.id && r.accepted_by) {
                        this.reviewPrompt.requestId = r.id;
                        this.reviewPrompt.rating = 0;
                        this.reviewPrompt.comment = '';
                        this.reviewPrompt.submitted = false;
                        this.reviewPrompt.feedbackMsg = '';
                        this.reviewPrompt.visible = true;
                    }
                    this._resetToIdle();
                    return;
                }

                if (r.status === 'cancelled') {
                    this._resetToIdle();
                    return;
                }

                // pending or accepted
                this.status = r.status;
                this.requestId = r.id ?? this.requestId;
                this.requestsAhead = r.requests_ahead ?? this.requestsAhead;
                this._startTimer();
            },

            // ── Actions ────────────────────────────────────────────────────────
            async callWaiter() {
                if (this.loading) return;
                this.loading = true;
                try {
                    const res = await fetch('/api/table/request', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        },
                        body: JSON.stringify({ session_id: sessionId }),
                    });
                    if (!res.ok) return;
                    const data = await res.json();
                    this.requestId = data.id;
                    this.status = 'pending';
                    this.elapsed = 0;
                    this.requestsAhead = data.requests_ahead ?? 0;
                    this._startTimer();
                } finally {
                    this.loading = false;
                }
            },

            async cancelRequest() {
                if (this.loading || !this.requestId) return;
                this.loading = true;
                try {
                    const res = await fetch(`/api/table/request/${this.requestId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        },
                        body: JSON.stringify({ session_id: sessionId }),
                    });
                    if (!res.ok) return;
                    this._resetToIdle();
                } finally {
                    this.loading = false;
                }
            },

            // ── Helpers ────────────────────────────────────────────────────────
            _resetToIdle() {
                clearInterval(this._timer);
                this.status = 'idle';
                this.requestId = null;
                this.elapsed = 0;
                this.requestsAhead = 0;
            },

            _startTimer() {
                clearInterval(this._timer);
                this._timer = setInterval(() => this.elapsed++, 1000);
            },

            formatTime(s) {
                const total = Math.max(0, Math.floor(Math.abs(s)));
                if (total < 60) return `${total}s`;
                const m = Math.floor(total / 60);
                return `${m}min ${String(total % 60).padStart(2, '0')}s`;
            },
        };
    }
</script>