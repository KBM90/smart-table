<form wire:submit="save" class="space-y-5">
    <div wire:loading.flex wire:target="save"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-white/60 backdrop-blur-md">
        <svg class="w-32 h-32 drop-shadow-xl" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="svg-draw-path"
                d="M 85 45 L 35 45 C 20 45 20 65 35 65 L 65 65 C 80 65 80 85 65 85 L 25 85"
                stroke="#0f766e" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
            <path class="svg-draw-path" d="M 25 85 L 35 95 L 65 95 C 85 95 90 75 75 60" stroke="#0f766e"
                stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="90" y2="35" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="105" y2="55" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="95" y2="85" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="60" y2="25" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <circle class="svg-node" cx="90" cy="35" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="105" cy="55" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="95" cy="85" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="60" cy="25" r="5" fill="#14b8a6" />
        </svg>
    </div>

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

    <button type="submit" wire:loading.attr="disabled" wire:target="save"
        class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 disabled:cursor-not-allowed disabled:opacity-70">
        {{ $tableId ? 'Save Changes' : 'Create Table' }}
    </button>
</form>
