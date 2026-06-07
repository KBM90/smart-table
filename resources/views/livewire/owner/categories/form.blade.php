<form wire:submit="save" class="space-y-5">
    <div class="grid gap-5">
        <div>
            <label for="category-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">
                Name
            </label>
            <input wire:model.blur="name" id="category-name" type="text"
                placeholder="e.g. Starters, Drinks, Desserts"
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            @error('name')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category-sort-order" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">
                Sort Order
            </label>
            <input wire:model.blur="sortOrder" id="category-sort-order" type="number" min="0"
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            <p class="mt-1.5 text-xs text-slate-400 font-medium">Lower numbers appear first in the catalog.</p>
            @error('sortOrder')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit"
        class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        {{ $categoryId ? 'Save Changes' : 'Create Category' }}
    </button>
</form>
