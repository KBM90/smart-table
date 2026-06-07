<div x-data="{
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
    class="space-y-6">

    <div class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 backdrop-blur-xl shadow-xl shadow-slate-200/50">
        {{-- Header Section --}}
        <div class="flex items-center justify-between pb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <span class="relative flex h-3.5 w-3.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
                </span>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">Live Table Requests</h2>
                    <p class="text-xs font-semibold text-slate-500 mt-0.5">Real-time floor service queue</p>
                </div>
            </div>
            <a href="{{ route('owner.requests.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors bg-indigo-50 hover:bg-indigo-100/80 px-3.5 py-2 rounded-xl border border-indigo-100/50 shadow-sm">
                <span>View Full Queue</span>
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- Table/List Section --}}
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100">
                        <th scope="col" class="pb-3 pr-4">Table & Session</th>
                        <th scope="col" class="pb-3 px-4">Status</th>
                        <th scope="col" class="pb-3 px-4">Wait Time</th>
                        <th scope="col" class="pb-3 pl-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($requests as $request)
                        <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                            {{-- Table & Session Info --}}
                            <td class="py-4 pr-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 border border-slate-200 text-slate-600 group-hover/row:bg-indigo-50 group-hover/row:border-indigo-100 group-hover/row:text-indigo-600 transition-colors">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $request->tableSession->table->name }}</p>
                                        <p class="mt-0.5 flex items-center gap-1 text-[10px] text-slate-400 font-mono" title="Session {{ $request->tableSession->id }}">
                                            {{ str($request->tableSession->session_token)->limit(8) }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status Badge --}}
                            <td class="py-4 px-4 align-middle">
                                <div class="flex items-center">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm" title="Accepted by {{ $request->acceptedBy?->name ?? 'Staff' }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Accepted
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Wait Time --}}
                            <td class="py-4 px-4 align-middle" x-data="{ 
                                    elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at) }}')) || 0,
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
                                        return `${m}m ${s.toString().padStart(2, '0')}s`;
                                    }
                                }">
                                <div class="inline-flex items-center gap-1.5 rounded-lg bg-slate-50 px-2.5 py-1 border border-slate-100 font-mono text-xs font-semibold text-slate-600">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span x-text="formatTime(elapsed)"></span>
                                </div>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="py-4 pl-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <button wire:click="acceptRequest({{ $request->id }})" type="button" class="inline-flex items-center gap-1.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <span>Accept</span>
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    @elseif ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                        <button wire:click="resolveRequest({{ $request->id }})" type="button" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>Resolve</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800">No Active Requests</h3>
                                    <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">
                                        All clean! When customers call for assistance at their tables, they will show up here.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
