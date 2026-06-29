@extends('layouts.guest')

@section('content')
    <!-- Guest Navigation -->
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
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
        <form method="POST" action="{{ route('register', request()->only('plan')) }}"
            class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
            @csrf

            <h2 class="text-2xl font-bold mb-6">Create Account</h2>

            <div>
                <x-input-label for="business_name" :value="__('Business Name')" />
                <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="business_name"
                    :value="old('business_name')" required autofocus autocomplete="organization" />
                <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="name" :value="__('Owner Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-5">
                <label for="terms" class="flex items-start gap-3 text-sm leading-6 text-gray-600">
                    <input id="terms" name="terms" type="checkbox" value="1" required @checked(old('terms'))
                        class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                    <span>
                        I agree to the
                        <a href="{{ route('legal.terms') }}" target="_blank" rel="noopener"
                            class="font-semibold text-indigo-600 underline-offset-4 hover:underline">
                            Terms of Service
                        </a>
                        and
                        <a href="{{ route('legal.privacy') }}" target="_blank" rel="noopener"
                            class="font-semibold text-indigo-600 underline-offset-4 hover:underline">
                            Privacy Policy
                        </a>.
                    </span>
                </label>
                <x-input-error :messages="$errors->get('terms')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
