<form wire:submit="save" class="space-y-5">
    <div>
        <label for="table-name" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Name</label>
        <input wire:model.blur="name" id="table-name" type="text" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
        @error('name')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Status</p>
        <div class="rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-300">{{ ucfirst($status) }}</div>
    </div>

    <button type="submit" class="w-full rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
        {{ $tableId ? 'Save changes' : 'Create table' }}
    </button>
</form>