@extends('layouts.owner')

@section('content')
    <div class="space-y-8">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900">Subscription & Billing</h1>
                <p class="mt-1 text-sm text-slate-500">Manage your plan, invoices, and payment method.</p>
            </div>

            @if ($tenant->subscribed('default'))
                <a href="{{ route('owner.billing.portal') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-slate-300/40 transition hover:bg-slate-700 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Update payment method
                </a>
            @endif
        </div>

        @if (session('billing_error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ session('billing_error') }}
            </div>
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100">
            <p class="mb-4 text-xs font-black uppercase tracking-widest text-slate-400">Current Status</p>

            @if ($tenant->subscribed('default') && $subscription)
                @php
                    $isGrace = $subscription->onGracePeriod();
                    $isPastDue = $subscription->pastDue();
                    $isPaused = $subscription->paused();
                    $badgeClass = match (true) {
                        $isPastDue => 'bg-red-50 text-red-700 border-red-200',
                        $isPaused => 'bg-slate-50 text-slate-700 border-slate-200',
                        $isGrace => 'bg-amber-50 text-amber-700 border-amber-200',
                        default => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    };
                    $badgeLabel = match (true) {
                        $isPastDue => 'Past Due',
                        $isPaused => 'Paused',
                        $isGrace => 'Cancelling - Grace Period',
                        default => 'Active',
                    };
                    $planLabel = match (true) {
                        $subscription->hasPrice(config('services.paddle.price_annual')) => 'Annual - $250 / yr',
                        $subscription->hasPrice(config('services.paddle.price_monthly')) => 'Monthly - $28 / mo',
                        default => 'Paddle subscription',
                    };
                @endphp

                <div class="flex flex-wrap items-center gap-4">
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-bold {{ $badgeClass }}">
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        {{ $badgeLabel }}
                    </span>
                    <p class="text-sm text-slate-700">
                        Plan: <span class="font-semibold">{{ $planLabel }}</span>
                    </p>
                    @if ($isGrace && $subscription->ends_at)
                        <p class="text-sm text-slate-500">
                            Access ends:
                            <span class="font-semibold text-amber-700">{{ $subscription->ends_at->format('M j, Y') }}</span>
                        </p>
                    @endif
                </div>

            @elseif ($tenant->isTrialActive())
                <div class="flex flex-wrap items-center gap-4">
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        Free Trial
                    </span>
                    <p class="text-sm text-slate-700">
                        Expires: <span class="font-semibold">{{ $tenant->trial_ends_at->format('M j, Y') }}</span>
                        <span class="ml-1 text-slate-400">({{ $tenant->trial_ends_at->diffForHumans() }})</span>
                    </p>
                </div>

            @else
                <div class="flex items-center gap-2">
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full border border-red-200 bg-red-50 px-3 py-1 text-xs font-bold text-red-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        Inactive
                    </span>
                    <p class="text-sm text-slate-500">No active subscription. Choose a plan below to continue.</p>
                </div>
            @endif
        </div>

        @unless ($tenant->subscribed('default') && $subscription && !$subscription->onGracePeriod())
            <div>
                <p class="mb-4 text-xs font-black uppercase tracking-widest text-slate-400">Choose a Plan</p>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <a href="{{ route('owner.billing.checkout', ['plan' => 'monthly']) }}"
                        class="group relative flex flex-col gap-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md hover:shadow-indigo-100 active:scale-[0.99]">
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-500">Monthly</p>
                        <p class="text-3xl font-black text-slate-900">
                            $28 <span class="text-base font-semibold text-slate-400">/ month</span>
                        </p>
                        <p class="text-sm text-slate-500">Full access billed monthly. Cancel any time.</p>
                        <span
                            class="mt-2 inline-flex items-center gap-1 text-sm font-bold text-indigo-600 group-hover:underline">
                            Subscribe monthly ->
                        </span>
                    </a>

                    <a href="{{ route('owner.billing.checkout', ['plan' => 'annual']) }}"
                        class="group relative flex flex-col gap-2 rounded-2xl border-2 border-indigo-400 bg-gradient-to-br from-indigo-50 to-white p-6 shadow-md shadow-indigo-100 transition hover:border-indigo-500 hover:shadow-lg hover:shadow-indigo-200 active:scale-[0.99]">
                        <div class="flex items-center gap-2">
                            <p class="text-[10px] font-black uppercase tracking-widest text-indigo-500">Annual</p>
                            <span
                                class="rounded-full bg-indigo-600 px-2 py-0.5 text-[10px] font-black uppercase tracking-wide text-white">
                                Save 33%
                            </span>
                        </div>
                        <p class="text-3xl font-black text-slate-900">
                            $250 <span class="text-base font-semibold text-slate-400">/ year</span>
                        </p>
                        <p class="text-sm text-slate-500">Full access billed annually. Best value.</p>
                        <span
                            class="mt-2 inline-flex items-center gap-1 text-sm font-bold text-indigo-600 group-hover:underline">
                            Subscribe annually ->
                        </span>
                    </a>
                </div>
            </div>
        @endunless
    </div>
@endsection