@extends('layouts.owner')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-indigo-600">{{ __('owner.verification.label') }}</p>
                    <h1 class="mt-2 text-2xl font-black text-slate-900">{{ __('owner.verification.title') }}</h1>
                    @if ($user->verification_code_sent_at)
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('owner.verification.sent_body', ['destination' => $user->verificationDestination(), 'method' => $user->verification_method === 'whatsapp' ? 'WhatsApp' : 'email']) }}
                        </p>
                    @else
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('owner.verification.send_body', ['destination' => $user->verificationDestination(), 'method' => $user->verification_method === 'whatsapp' ? 'WhatsApp' : 'email']) }}
                        </p>
                    @endif
                </div>
            </div>

            <x-input-error :messages="$errors->get('verification')" class="mt-5" />

            @if (session('status') === 'verification-code-sent')
                <div class="mt-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                    {{ __('owner.verification.code_sent') }}
                </div>
            @endif

            <form method="POST" action="{{ route('owner.account-verification.verify') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <x-input-label for="code" :value="__('owner.verification.code_label')" />
                    <x-text-input id="code" class="mt-1 block w-full text-center text-2xl font-black tracking-[0.35em]"
                        type="text" name="code" :value="old('code')" inputmode="numeric" autocomplete="one-time-code"
                        maxlength="6" required autofocus />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <x-primary-button>
                        {{ __('owner.verification.verify') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('owner.account-verification.send') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="text-sm font-bold text-indigo-600 underline-offset-4 hover:text-indigo-700 hover:underline">
                    {{ __('owner.verification.send_new') }}
                </button>
            </form>
        </div>
    </div>
@endsection
