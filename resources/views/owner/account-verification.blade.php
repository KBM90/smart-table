@extends('layouts.owner')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-indigo-600">Account verification</p>
                    <h1 class="mt-2 text-2xl font-black text-slate-900">Enter your verification code</h1>
                    @if ($user->verification_code_sent_at)
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            We sent a 6-digit code to
                            <span class="font-semibold text-slate-900">{{ $user->verificationDestination() }}</span>
                            by {{ $user->verification_method === 'whatsapp' ? 'WhatsApp' : 'email' }}.
                        </p>
                    @else
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Send a 6-digit code to
                            <span class="font-semibold text-slate-900">{{ $user->verificationDestination() }}</span>
                            by {{ $user->verification_method === 'whatsapp' ? 'WhatsApp' : 'email' }}.
                        </p>
                    @endif
                </div>
            </div>

            <x-input-error :messages="$errors->get('verification')" class="mt-5" />

            @if (session('status') === 'verification-code-sent')
                <div class="mt-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                    A new verification code has been sent.
                </div>
            @endif

            <form method="POST" action="{{ route('owner.account-verification.verify') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <x-input-label for="code" :value="__('Verification Code')" />
                    <x-text-input id="code" class="mt-1 block w-full text-center text-2xl font-black tracking-[0.35em]"
                        type="text" name="code" :value="old('code')" inputmode="numeric" autocomplete="one-time-code"
                        maxlength="6" required autofocus />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <x-primary-button>
                        {{ __('Verify Account') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('owner.account-verification.send') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="text-sm font-bold text-indigo-600 underline-offset-4 hover:text-indigo-700 hover:underline">
                    Send a new code
                </button>
            </form>
        </div>
    </div>
@endsection
