<div class="space-y-6">
    {{-- ── Header ─────────────────────────────────────────────────────────── --}}
    <section class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                    Owner Catalog
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Product Categories</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">
                    Organise your menu into named sections. Assign categories to products to group them in the customer catalog.
                </p>
            </div>

            <button wire:click="createCategory" type="button"
                class="shrink-0 group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <span>New Category</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </section>

    {{-- ── Main grid ───────────────────────────────────────────────────────── --}}
    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(360px,1fr)]">

        {{-- Category table --}}
        <div class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Products</th>
                            <th class="px-6 py-4">Sort</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-transparent">
                        @forelse ($categories as $category)
                            <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-50 to-violet-100 border border-indigo-100 shrink-0">
                                            <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-slate-800">{{ $category->name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 border border-indigo-100 px-2.5 py-1 text-xs font-bold text-indigo-700">
                                        {{ $category->products_count }} product{{ $category->products_count === 1 ? '' : 's' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle text-xs font-bold text-slate-500 font-mono">{{ $category->sort_order }}</td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex flex-wrap justify-end gap-1.5">
                                        <button wire:click="editCategory({{ $category->id }})" type="button"
                                            class="rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">
                                            Edit
                                        </button>
                                        <button wire:click="deleteCategory({{ $category->id }})"
                                            wire:confirm="Delete '{{ $category->name }}'? Products in this category will become uncategorised."
                                            type="button"
                                            class="rounded-xl border border-red-200 bg-red-50/50 px-3.5 py-2 text-xs font-bold text-red-600 hover:bg-red-50 hover:border-red-300 shadow-sm transition-all duration-200">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800">No Categories Yet</h3>
                                        <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">Create your first category to start organising your menu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Inline form panel --}}
        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">{{ $editingCategoryId ? 'Edit Category' : 'New Category' }}</h2>
                        <button wire:click="closeForm" type="button"
                            class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">
                            Close
                        </button>
                    </div>

                    <livewire:owner.categories.form
                        :category-id="$editingCategoryId"
                        :key="'category-form-' . $editingCategoryId"
                        @category-saved="handleSaved($event.detail.categoryId)"
                    />
                </div>
            @endif
        </div>

    </section>
</div>
