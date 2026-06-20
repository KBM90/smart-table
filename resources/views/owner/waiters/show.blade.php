@extends('layouts.owner')

@section('content')
    <div class="space-y-6">
        <a href="{{ route('owner.waiters.index') }}"
            class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Waiter Performance</span>
        </a>

        <section
            class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
            <div class="flex items-center gap-4">
                @if ($waiter->photo)
                    <img src="{{ $waiter->photo }}" alt="{{ $waiter->name }}"
                        class="h-16 w-16 rounded-2xl object-cover border border-slate-100 shadow-sm">
                @else
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-100 text-xl font-black text-indigo-600 border border-indigo-200">
                        {{ collect(explode(' ', $waiter->name))->filter()->take(2)->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('') }}
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">{{ $waiter->name }}</h1>
                    <span
                        class="mt-1 inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[10px] font-bold {{ $waiter->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                        <span
                            class="h-1.5 w-1.5 rounded-full {{ $waiter->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                        {{ $waiter->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-dashed border-slate-300 bg-white/40 p-10 text-center">
            <h3 class="text-sm font-bold text-slate-700">Full performance stats coming soon</h3>
            <p class="mt-1 text-xs text-slate-400">Average response time, resolved request totals, and reviews will appear
                here.</p>
        </section>
    </div>
@endsection