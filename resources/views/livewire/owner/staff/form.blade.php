<form wire:submit="save" class="space-y-5">
    <div>
        <label for="waiter-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Name</label>
        <input wire:model.blur="name" id="waiter-name" type="text" placeholder="e.g. John Doe" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('name')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-email" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Email</label>
        <input wire:model.blur="email" id="waiter-email" type="email" placeholder="e.g. john@example.com" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('email')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-password" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Password</label>
        <input wire:model.blur="password" id="waiter-password" type="password" placeholder="••••••••" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('password')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-password-confirmation" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Confirm Password</label>
        <input wire:model.blur="password_confirmation" id="waiter-password-confirmation" type="password" placeholder="••••••••" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-xs text-slate-500 font-semibold leading-relaxed shadow-inner">
        New waiter accounts are marked email-verified immediately because the owner provisions the login directly.
    </div>

    <button type="submit" data-show-page-loader class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        Create Waiter
    </button>
</form>
