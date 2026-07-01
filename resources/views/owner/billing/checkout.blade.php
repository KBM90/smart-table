@extends('layouts.owner')

@section('content')
<div class="mx-auto max-w-xl space-y-6">
    <div>
        <a href="{{ route('owner.billing.index') }}" class="text-sm font-bold text-indigo-600 hover:underline">
            {{ __('owner.billing.back') }}
        </a>
        <h1 class="mt-4 text-2xl font-black text-slate-900">
            {{ $plan === 'annual' ? __('owner.billing.annual_subscription') : __('owner.billing.monthly_subscription') }}
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('owner.billing.checkout_intro') }}
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-indigo-500">
                    {{ $plan === 'annual' ? __('owner.billing.annual') : __('owner.billing.monthly') }}
                </p>
                <p class="mt-2 text-3xl font-black text-slate-900">
                    {{ $plan === 'annual' ? '$250' : '$28' }}
                    <span class="text-base font-semibold text-slate-400">
                        {{ $plan === 'annual' ? __('owner.billing.per_year') : __('owner.billing.per_month') }}
                    </span>
                </p>
            </div>
        </div>

        <x-paddle-button :checkout="$checkout"
            class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-md shadow-slate-300/40 transition hover:bg-slate-700 active:scale-95">
            {{ __('owner.billing.open_checkout') }}
        </x-paddle-button>
    </div>
</div>
@endsection
