<div class="space-y-6">
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-6 shadow-2xl shadow-slate-950/40">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Owner catalog</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Products</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">Manage your browse-only menu catalog with active states, sort order, uploads, and built-in image picks.</p>
            </div>

            <button wire:click="createProduct" type="button" class="rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
                Create product
            </button>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cappuccino" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-0">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Filter</span>
                <select wire:model.live="activity" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
                    <option value="">All products</option>
                    <option value="active">Active only</option>
                    <option value="inactive">Inactive only</option>
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(360px,1fr)]">
        <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
            <table class="min-w-full divide-y divide-slate-800">
                <thead class="bg-slate-950/70">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">
                        <th class="px-6 py-4">Product</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Sort</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($products as $product)
                        <tr class="align-top">
                            <td class="px-6 py-4">
                                <div class="flex gap-4">
                                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-16 w-16 rounded-2xl object-cover">
                                    <div>
                                        <p class="font-semibold text-white">{{ $product->name }}</p>
                                        <p class="mt-1 line-clamp-2 text-sm text-slate-400">{{ $product->description ?: 'No description yet.' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-white">${{ $product->priceFormatted() }}</td>
                            <td class="px-6 py-4 text-sm text-slate-300">{{ $product->sort_order }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleActive({{ $product->id }})" type="button" class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $product->is_active ? 'bg-emerald-500/15 text-emerald-300' : 'bg-slate-700 text-slate-300' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <button wire:click="editProduct({{ $product->id }})" type="button" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-200 hover:border-amber-400 hover:text-amber-300">Edit</button>
                                    <button wire:click="deleteProduct({{ $product->id }})" type="button" class="rounded-lg border border-rose-500/40 px-3 py-2 text-xs font-semibold text-rose-200 hover:border-rose-400 hover:text-rose-100">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="border-t border-slate-800 px-6 py-4">
                {{ $products->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white">{{ $editingProductId ? 'Edit product' : 'Create product' }}</h2>
                        <button wire:click="closeForm" type="button" class="text-sm font-medium text-slate-400 hover:text-white">Close</button>
                    </div>

                    <livewire:owner.products.form :product-id="$editingProductId" :key="'product-form-'.$editingProductId" @product-saved="handleSaved($event.detail.productId)" />
                </div>
            @endif
        </div>
    </section>
</div>