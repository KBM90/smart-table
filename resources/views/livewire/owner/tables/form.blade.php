<form wire:submit="save" class="space-y-5">
    <div>
        <label for="table-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Name</label>
        <input wire:model.blur="name" id="table-name" type="text" placeholder="e.g. Table 5" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('name')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p class="mb-2 text-xs font-black uppercase tracking-[0.2em] text-slate-500">Status</p>
        <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 font-bold shadow-sm">
            @if ($status === \App\Models\Table::STATUS_FREE)
                <span class="inline-flex items-center gap-1.5 text-emerald-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Free
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 text-amber-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Occupied
                </span>
            @endif
        </div>
    </div>

    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        {{ $tableId ? 'Save Changes' : 'Create Table' }}
    </button>
</form>