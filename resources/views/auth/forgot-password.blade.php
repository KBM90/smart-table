@extends('layouts.guest')

@section('content')
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="/" class="flex items-center gap-3 transition hover:opacity-80"
                            aria-label="Smart Table home">

                            <img src="{{ asset('img/system/logo_with_text.png') }}" alt="Smart Table"
                                class="h-14 md:h-20 w-auto object-contain" />
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-md mx-auto mt-10 mb-20">
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold mb-4">Reset Password</h2>

            <div class="mb-6 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection