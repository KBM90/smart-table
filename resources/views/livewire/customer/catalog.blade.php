<div class="space-y-6 pb-24" x-data>
    <section class="rounded-3xl border border-slate-800 bg-slate-900 p-8 shadow-2xl shadow-slate-950/50">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">{{ __('customer.catalog.label') }}</p>
        <h1 class="mt-4 text-3xl font-semibold text-white">
            {{ __('customer.catalog.heading', ['tenant' => $tenantName, 'table' => $tableName]) }}
        </h1>
        <p class="mt-3 text-sm text-slate-300">{{ __('customer.catalog.intro') }}</p>
        <a href="{{ route('customer.table', ['qr_token' => $qrToken]) }}"
            class="mt-6 inline-flex rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:border-amber-400 hover:text-amber-300">
            {{ __('customer.catalog.back_to_table') }}
        </a>
    </section>

    @if ($blocked)
        <section class="rounded-3xl border border-red-800 bg-red-950/40 p-6 text-sm text-red-200">
            {{ __('customer.table.restricted_body') }}
        </section>
    @endif

    {{-- Category filter pills --}}
    @if ($this->categories->isNotEmpty())
        <section class="flex flex-wrap gap-2" role="tablist">
            <button type="button" wire:click="selectCategory(null)" wire:loading.attr="disabled"
                wire:target="selectCategory" aria-pressed="{{ $categoryId === null ? 'true' : 'false' }}" class="rounded-full px-4 py-2 text-sm font-semibold transition disabled:cursor-not-allowed disabled:opacity-60 {{ $categoryId === null
            ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-400/20'
            : 'border border-slate-700 bg-slate-900 text-slate-300 hover:border-amber-400 hover:text-amber-300' }}">
                {{ __('customer.catalog.all_categories') }}
            </button>

            @foreach ($this->categories as $category)
                <button type="button" wire:click="selectCategory({{ $category->id }})" wire:loading.attr="disabled"
                    wire:target="selectCategory" aria-pressed="{{ $categoryId === $category->id ? 'true' : 'false' }}"
                    class="rounded-full px-4 py-2 text-sm font-semibold transition disabled:cursor-not-allowed disabled:opacity-60 {{ $categoryId === $category->id
                    ? 'bg-amber-400 text-slate-950 shadow-lg shadow-amber-400/20'
                    : 'border border-slate-700 bg-slate-900 text-slate-300 hover:border-amber-400 hover:text-amber-300' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </section>
    @endif

    <section class="grid gap-4 sm:grid-cols-2">
        @forelse ($products as $product)
        @php($qtyInCart = (int) ($cart[$product->id] ?? 0))
        <article class="overflow-hidden rounded-3xl border border-slate-800 bg-slate-900 shadow-xl shadow-slate-950/30">
            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-52 w-full object-cover">
            <div class="space-y-3 p-5">
                <div class="flex items-start justify-between gap-4">
                    <h2 class="text-lg font-semibold text-white">{{ $product->name }}</h2>
                    <p class="text-sm font-semibold text-amber-300">${{ $product->priceFormatted() }}</p>
                </div>
                @if ($product->description)
                    <p class="text-sm leading-6 text-slate-300">{{ $product->description }}</p>
                @endif

                @unless ($blocked)
                    <div class="pt-1">
                        @if ($qtyInCart > 0)
                            <div
                                class="inline-flex items-center gap-3 rounded-xl border border-slate-700 bg-slate-950 px-3 py-2">
                                <button type="button" wire:click="decrementQty({{ $product->id }})"
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-white transition hover:bg-slate-700">-</button>
                                <span class="w-6 text-center text-sm font-bold text-white">{{ $qtyInCart }}</span>
                                <button type="button" wire:click="incrementQty({{ $product->id }})"
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-400 text-slate-950 transition hover:bg-amber-300">+</button>
                            </div>
                        @else
                            <button type="button" wire:click="addToCart({{ $product->id }})"
                                class="inline-flex items-center gap-2 rounded-xl border border-amber-400/60 bg-amber-400/10 px-4 py-2 text-sm font-semibold text-amber-300 transition hover:bg-amber-400/20">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                {{ __('customer.catalog.add_to_order') }}
                            </button>
                        @endif
                    </div>
                @endunless
            </div>
        </article>
        @empty
        <div
            class="rounded-3xl border border-dashed border-slate-700 bg-slate-900/60 p-8 text-sm text-slate-400 sm:col-span-2">
            {{ __('customer.catalog.empty') }}
        </div>
        @endforelse
    </section>

    {{-- Floating cart bar --}}
    @if ($this->cartCount > 0 && !$blocked)
        <div class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-800 bg-slate-950/95 px-6 py-4 backdrop-blur-md">
            <div class="mx-auto flex max-w-3xl items-center justify-between gap-4">
                <div class="text-sm text-slate-300">
                    <span class="font-black text-white">{{ $this->cartCount }}</span>
                    {{ __('customer.catalog.items_label') }}
                    &middot;
                    <span class="font-black text-amber-300">${{ number_format($this->cartTotalCents / 100, 2) }}</span>
                </div>
                <button type="button" @click="$dispatch('open-modal', 'cart')"
                    class="rounded-xl bg-amber-400 px-5 py-3 text-sm font-black text-slate-950 shadow-lg shadow-amber-400/30 transition hover:bg-amber-300">
                    {{ __('customer.catalog.view_order') }}
                </button>
            </div>
        </div>
    @endif

    <x-modal name="cart" :show="false" maxWidth="md" focusable>
        <div class="max-h-[80vh] overflow-y-auto bg-slate-950 p-6 text-slate-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-white">{{ __('customer.catalog.your_order') }}</h2>
                <button type="button" @click="$dispatch('close')" class="text-slate-400 hover:text-slate-200">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            @if ($this->cartProducts->isEmpty())
                <p class="mt-6 text-sm text-slate-400">{{ __('customer.catalog.empty_cart') }}</p>
            @else
                <ul class="mt-5 space-y-3">
                    @foreach ($this->cartProducts as $row)
                        <li
                            class="flex items-center justify-between gap-3 rounded-xl border border-slate-800 bg-slate-900 px-4 py-3">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-white">{{ $row['product']->name }}</p>
                                <p class="text-xs text-slate-400">${{ $row['product']->priceFormatted() }}
                                    {{ __('customer.catalog.each') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" wire:click="decrementQty({{ $row['product']->id }})"
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-800 text-white hover:bg-slate-700">-</button>
                                <span class="w-5 text-center text-sm font-bold text-white">{{ $row['quantity'] }}</span>
                                <button type="button" wire:click="incrementQty({{ $row['product']->id }})"
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-400 text-slate-950 hover:bg-amber-300">+</button>
                                <button type="button" wire:click="removeFromCart({{ $row['product']->id }})"
                                    class="ml-1 text-xs font-semibold text-red-400 hover:text-red-300">{{ __('customer.catalog.remove') }}</button>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-5">
                    <label for="order-note" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-400">
                        {{ __('customer.catalog.order_note_label') }}
                    </label>
                    <textarea wire:model="orderNote" id="order-note" rows="2"
                        placeholder="{{ __('customer.catalog.order_note_placeholder') }}"
                        class="w-full rounded-xl border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400"></textarea>
                </div>

                @error('items')
                    <p class="mt-3 text-sm font-semibold text-red-400">{{ $message }}</p>
                @enderror

                <div class="mt-5 flex items-center justify-between border-t border-slate-800 pt-4">
                    <span class="text-sm font-bold text-slate-300">{{ __('customer.catalog.order_total') }}</span>
                    <span
                        class="text-lg font-black text-amber-300">${{ number_format($this->cartTotalCents / 100, 2) }}</span>
                </div>

                <button type="button" wire:click="submitOrder" wire:loading.attr="disabled" wire:target="submitOrder"
                    class="mt-4 w-full rounded-xl bg-amber-400 px-5 py-3 text-sm font-black text-slate-950 shadow-lg shadow-amber-400/30 transition hover:bg-amber-300 disabled:cursor-not-allowed disabled:opacity-60">
                    <span wire:loading.remove wire:target="submitOrder">{{ __('customer.catalog.place_order') }}</span>
                    <span wire:loading wire:target="submitOrder">{{ __('customer.catalog.placing_order') }}</span>
                </button>
                <p class="mt-2 text-center text-xs text-slate-500">{{ __('customer.catalog.order_alerts_staff') }}</p>
            @endif
        </div>
    </x-modal>
</div>