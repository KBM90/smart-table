@extends('layouts.owner')

@section('content')
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-8 shadow-2xl shadow-slate-950/40">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Smart Table</p>
        <h1 class="mt-3 text-3xl font-semibold text-white">Owner Dashboard — tenant: {{ app(\App\Support\CurrentTenant::class)->tenant()?->name }}</h1>
        <p class="mt-3 max-w-2xl text-sm text-slate-300">Phase 1 foundation is active. Owner-only routes are tenant-aware and ready for the next modules.</p>
    </section>
@endsection