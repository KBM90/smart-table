@extends('layouts.owner')

@section('content')
<div class="flex min-h-[60vh] flex-col items-center justify-center text-center">

    {{-- Success Checkmark Icon --}}
    <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 ring-8 ring-emerald-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
    </div>

    <h1 class="text-3xl font-black text-slate-900">You're all set!</h1>
    <p class="mt-3 max-w-sm text-slate-500">
        Your subscription has been activated. You now have full access to Smart Table.
    </p>

    <a href="{{ route('owner.dashboard') }}"
        class="mt-8 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-500 active:scale-95">
        Go to Dashboard →
    </a>

    <a href="{{ route('owner.billing.index') }}"
        class="mt-3 text-sm font-semibold text-slate-400 hover:text-slate-700 transition">
        View billing details
    </a>

</div>
@endsection
