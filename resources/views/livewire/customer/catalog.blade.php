<div class="space-y-6">
    <section class="rounded-3xl border border-slate-800 bg-slate-900 p-8 shadow-2xl shadow-slate-950/50">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">{{ __('customer.catalog.label') }}</p>
        <h1 class="mt-4 text-3xl font-semibold text-white">{{ __('customer.catalog.heading', ['tenant' => $tenantName, 'table' => $tableName]) }}</h1>
        <p class="mt-3 text-sm text-slate-300">{{ __('customer.catalog.intro') }}</p>
        <a href="{{ route('customer.table', ['qr_token' => $qrToken]) }}" class="mt-6 inline-flex rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:border-amber-400 hover:text-amber-300">
            {{ __('customer.catalog.back_to_table') }}
        </a>
    </section>

    <section class="grid gap-4 sm:grid-cols-2">
        @forelse ($products as $product)
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
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-slate-700 bg-slate-900/60 p-8 text-sm text-slate-400 sm:col-span-2">
                {{ __('customer.catalog.empty') }}
            </div>
        @endforelse
    </section>
</div>
