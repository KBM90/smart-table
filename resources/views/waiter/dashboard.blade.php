@extends('layouts.waiter')

@section('content')
    <section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">{{ __('waiter.dashboard.label') }}</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ __('waiter.dashboard.title') }}</h1>
        <p class="mt-3 max-w-2xl text-sm text-slate-600">{{ __('waiter.dashboard.intro') }}</p>

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
    @yield('requests')

    <x-modal name="scan-to-assign" :show="false" maxWidth="md" focusable>
        <div class="p-6" x-data="scanToAssign()" x-init="init()"
            x-on:open-modal.window="$event.detail === 'scan-to-assign' && start()"
            x-on:close-modal.window="$event.detail === 'scan-to-assign' && stop()">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">{{ __('waiter.dashboard.scan_title') }}</h2>
                <button type="button" @click="$dispatch('close')" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <p class="mt-2 text-sm text-slate-500">{{ __('waiter.dashboard.scan_body') }}</p>

            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-950 aspect-square relative">
                <video x-ref="video" class="h-full w-full object-cover" playsinline muted></video>
                <canvas x-ref="canvas" class="hidden"></canvas>

                <div x-show="!cameraReady && !error"
                    class="absolute inset-0 flex items-center justify-center text-sm text-slate-300">
                    {{ __('waiter.dashboard.starting_camera') }}
                </div>
            </div>

            <div x-show="error"
                class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700"
                x-text="error"></div>

            <div x-show="loading"
                class="mt-4 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-600">
                {{ __('waiter.dashboard.processing') }}
            </div>

            <div x-show="result" class="mt-4 rounded-xl border px-4 py-3 text-sm font-medium" :class="result?.status === 'already_assigned'
                                ? 'border-amber-200 bg-amber-50 text-amber-700'
                                : 'border-emerald-200 bg-emerald-50 text-emerald-700'" x-text="result?.message">
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" @click="$dispatch('close')"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    {{ __('waiter.dashboard.close') }}
                </button>
                <button type="button" x-show="result || error" @click="reset(); start()"
                    class="rounded-xl border border-sky-300 bg-sky-50 px-4 py-2 text-sm font-semibold text-sky-700 hover:bg-sky-100">
                    {{ __('waiter.dashboard.scan_again') }}
                </button>
            </div>
        </div>
    </x-modal>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsQR/1.4.0/jsQR.min.js"></script>


    <script>
        function scanToAssign() {
            return {
                stream: null,
                cameraReady: false,
                loading: false,
                error: null,
                result: null,
                _rafId: null,

                init() {
                    // nothing on init — camera starts when modal opens
                },

                async start() {
                    this.reset();

                    if (!navigator.mediaDevices?.getUserMedia) {
                        this.error = @js(__('waiter.dashboard.camera_not_supported'));
                        return;
                    }

                    try {
                        this.stream = await navigator.mediaDevices.getUserMedia({
                            video: { facingMode: 'environment' },
                        });
                        this.$refs.video.srcObject = this.stream;
                        await this.$refs.video.play();
                        this.cameraReady = true;
                        this._scanLoop();
                    } catch (e) {
                        this.error = @js(__('waiter.dashboard.camera_denied'));
                    }
                },

                stop() {
                    if (this._rafId) {
                        cancelAnimationFrame(this._rafId);
                        this._rafId = null;
                    }
                    if (this.stream) {
                        this.stream.getTracks().forEach(track => track.stop());
                        this.stream = null;
                    }
                    this.cameraReady = false;
                },

                reset() {
                    this.error = null;
                    this.result = null;
                    this.loading = false;
                },

                _scanLoop() {
                    if (!this.cameraReady || this.result) {
                        return;
                    }

                    const video = this.$refs.video;
                    const canvas = this.$refs.canvas;

                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;

                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        const code = window.jsQR
                            ? window.jsQR(imageData.data, imageData.width, imageData.height)
                            : null;

                        if (code && code.data) {
                            this._handleCode(code.data);
                            return;
                        }
                    }

                    this._rafId = requestAnimationFrame(() => this._scanLoop());
                },

                async _handleCode(rawValue) {
                    this.stop();
                    this.loading = true;

                    try {
                        const res = await fetch('{{ route('waiter.tables.assign-via-qr') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            },
                            body: JSON.stringify({ qr_token: rawValue }),
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            this.error = data.message ?? @js(__('waiter.dashboard.something_wrong'));
                            return;
                        }

                        this.result = data;
                    } catch (e) {
                        this.error = @js(__('waiter.dashboard.network_error'));
                    } finally {
                        this.loading = false;
                    }
                },
            };
        }
    </script>
@endpush
