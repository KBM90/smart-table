<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/50">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600">Owner catalog</p>
                <h1 class="mt-2 text-2xl font-bold text-slate-900">Products</h1>
                <p class="mt-1 max-w-2xl text-sm text-slate-500">Manage your browse-only menu catalog with active states, sort order, uploads, and built-in image picks.</p>
            </div>

            <button wire:click="createProduct" type="button"
                class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                Create product
            </button>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="e.g. Cappuccino"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">Filter</span>
                <select wire:model.live="activity"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                    <option value="">All products</option>
                    <option value="active">Active only</option>
                    <option value="inactive">Inactive only</option>
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(360px,1fr)] items-start">
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Sort</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($products as $product)
                            <tr class="align-top hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex gap-4">
                                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}"
                                            class="h-14 w-14 rounded-xl border border-slate-100 object-cover shadow-sm">
                                        <div>
                                            <p class="font-bold text-slate-900">{{ $product->name }}</p>
                                            <p class="mt-1 line-clamp-2 text-xs text-slate-500">
                                                {{ $product->description ?: 'No description yet.' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($product->category)
                                        <span class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-600 ring-1 ring-inset ring-slate-500/10">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">${{ $product->priceFormatted() }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $product->sort_order }}</td>
                                <td class="px-6 py-4">
                                    <button wire:click="toggleActive({{ $product->id }})" type="button"
                                        class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold transition {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20 hover:bg-emerald-100' : 'bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-500/10 hover:bg-slate-200' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <button wire:click="editProduct({{ $product->id }})" type="button"
                                            class="rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Edit</button>
                                        <button wire:click="deleteProduct({{ $product->id }})" type="button"
                                            class="rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-rose-600 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-rose-50 hover:ring-rose-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-sm font-medium text-slate-900">No products found</p>
                                    <p class="mt-1 text-sm text-slate-500">Try adjusting your search or filter criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

        <div class="sticky top-24 space-y-6">
            @if ($showForm)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between border-b border-slate-100 pb-4">
                        <h2 class="text-lg font-bold text-slate-900">
                            {{ $editingProductId ? 'Edit product' : 'Create product' }}</h2>
                        <button wire:click="closeForm" type="button"
                            class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/></svg>
                        </button>
                    </div>

                    <livewire:owner.products.form :product-id="$editingProductId" :key="'product-form-' . $editingProductId"
                        @product-saved="handleSaved($event.detail.productId)" />
                </div>
            @endif
        </div>
    </section>
</div>