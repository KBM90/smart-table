<form wire:submit="save" class="space-y-5">
    <div>
        <label for="waiter-name" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Name</label>
        <input wire:model.blur="name" id="waiter-name" type="text" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
        @error('name')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-email" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Email</label>
        <input wire:model.blur="email" id="waiter-email" type="email" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
        @error('email')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-password" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Password</label>
        <input wire:model.blur="password" id="waiter-password" type="password" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
        @error('password')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-password-confirmation" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Confirm password</label>
        <input wire:model.blur="password_confirmation" id="waiter-password-confirmation" type="password" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
        @error('password_confirmation')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <p class="rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-300">
        New waiter accounts are marked email-verified immediately because the owner provisions the login directly.
    </p>

    <button type="submit" class="w-full rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
        Create waiter
    </button>
</form>