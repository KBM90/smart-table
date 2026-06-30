@extends('layouts.owner')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-black text-slate-900">Account Settings</h1>
                <p class="mt-1 text-sm text-slate-500">Keep the business details used across your Smart Table workspace up to date.</p>
            </div>
        </div>

        @if (session('status') === 'business-settings-updated')
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-800">
                Business information updated.
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">
            <form method="POST" action="{{ route('owner.settings.update') }}"
                class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm shadow-slate-100">
                @csrf
                @method('PATCH')

                <div class="border-b border-slate-100 pb-5">
                    <p class="text-xs font-black uppercase tracking-widest text-indigo-500">Business Information</p>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        These details identify your restaurant or venue for operational and customer-facing use.
                    </p>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="text-sm font-bold text-slate-700">Business name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $tenant->name) }}" required
                            class="mt-2 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="contact_email" class="text-sm font-bold text-slate-700">Business email</label>
                        <input id="contact_email" name="contact_email" type="email"
                            value="{{ old('contact_email', $tenant->contact_email) }}"
                            placeholder="{{ auth()->user()->email }}"
                            class="mt-2 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="phone" class="text-sm font-bold text-slate-700">Business phone</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone', $tenant->phone) }}"
                            class="mt-2 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="sm:col-span-2">
                        <label for="address" class="text-sm font-bold text-slate-700">Street address</label>
                        <input id="address" name="address" type="text" value="{{ old('address', $tenant->address) }}"
                            class="mt-2 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <label for="city" class="text-sm font-bold text-slate-700">City</label>
                        <input id="city" name="city" type="text" value="{{ old('city', $tenant->city) }}"
                            class="mt-2 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <div>
                        <label for="country" class="text-sm font-bold text-slate-700">Country</label>
                        <input id="country" name="country" type="text" value="{{ old('country', $tenant->country) }}"
                            class="mt-2 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end border-t border-slate-100 pt-5">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-black text-white shadow-sm transition hover:bg-slate-700 active:scale-95">
                        Save changes
                    </button>
                </div>
            </form>

            <aside class="space-y-4">
                <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm shadow-slate-100">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Owner Account</p>
                    <div class="mt-4 space-y-3 text-sm">
                        <div>
                            <p class="font-bold text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="mt-1 text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                        @if (auth()->user()->phone)
                            <p class="text-slate-500">{{ auth()->user()->phone }}</p>
                        @endif
                    </div>
                    <a href="{{ route('profile.edit') }}"
                        class="mt-5 inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600">
                        Edit profile
                    </a>
                </div>

                <div class="rounded-lg border border-indigo-100 bg-indigo-50 p-5">
                    <p class="text-sm font-black text-indigo-950">Business data scope</p>
                    <p class="mt-2 text-sm leading-6 text-indigo-900/80">
                        This page stores details for the business workspace. Personal login credentials stay in your profile.
                    </p>
                </div>
            </aside>
        </div>
    </div>
@endsection
