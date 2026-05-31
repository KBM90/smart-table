<form wire:submit="save" class="space-y-5">
    <div class="grid gap-5">
        <div>
            <label for="product-name" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Name</label>
            <input wire:model.blur="name" id="product-name" type="text" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
            @error('name')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-price" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Price</label>
            <input wire:model.blur="price" id="product-price" type="text" inputmode="decimal" placeholder="12.50" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
            @error('price')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-description" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Description</label>
            <textarea wire:model.blur="description" id="product-description" rows="4" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0"></textarea>
            @error('description')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="sort-order" class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Sort order</label>
                <input wire:model.blur="sortOrder" id="sort-order" type="number" min="0" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
                @error('sortOrder')
                    <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3">
                <input wire:model.live="isActive" type="checkbox" class="rounded border-slate-600 bg-slate-900 text-amber-500 focus:ring-amber-400">
                <span class="text-sm font-medium text-slate-200">Active product</span>
            </label>
        </div>
    </div>

    <div class="space-y-4 rounded-2xl border border-slate-800 bg-slate-950 p-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Image</p>
            <div class="mt-3 grid gap-2 sm:grid-cols-3">
                <label class="flex items-center gap-2 rounded-xl border border-slate-800 px-3 py-2 text-sm text-slate-200">
                    <input wire:model.live="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_NONE }}">
                    <span>No image</span>
                </label>
                <label class="flex items-center gap-2 rounded-xl border border-slate-800 px-3 py-2 text-sm text-slate-200">
                    <input wire:model.live="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}">
                    <span>Upload</span>
                </label>
                <label class="flex items-center gap-2 rounded-xl border border-slate-800 px-3 py-2 text-sm text-slate-200">
                    <input wire:model.live="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}">
                    <span>Pick from library</span>
                </label>
            </div>
            @error('imageSource')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 lg:grid-cols-[120px_minmax(0,1fr)]">
            <img src="{{ $previewUrl }}" alt="Product preview" class="h-[120px] w-[120px] rounded-2xl object-cover">

            <div>
                @if ($imageSource === \App\Models\Product::IMAGE_SOURCE_UPLOAD)
                    <div>
                        <input wire:model.live="upload" type="file" accept="image/png,image/jpeg,image/webp" class="block w-full rounded-xl border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-slate-200 file:mr-3 file:rounded-lg file:border-0 file:bg-amber-500 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-slate-950">
                        <p class="mt-2 text-xs text-slate-400">Accepted: JPG, PNG, WEBP up to 4 MB and at least 256x256.</p>
                        @error('upload')
                            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>
                @elseif ($imageSource === \App\Models\Product::IMAGE_SOURCE_LIBRARY)
                    <div>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                            @foreach ($libraryImages as $image)
                                <button wire:click="$set('selectedLibraryImage', '{{ $image['key'] }}')" type="button" class="overflow-hidden rounded-2xl border {{ $selectedLibraryImage === $image['key'] ? 'border-amber-400' : 'border-slate-800' }}">
                                    <img src="{{ asset('img/library/'.basename($image['key'])) }}" alt="{{ $image['label'] }}" class="h-24 w-full object-cover">
                                    <span class="block px-2 py-2 text-xs font-medium text-slate-200">{{ $image['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                        @error('selectedLibraryImage')
                            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <p class="rounded-xl border border-dashed border-slate-800 px-4 py-6 text-sm text-slate-400">No image will be shown for this product.</p>
                @endif
            </div>
        </div>
    </div>

    <button type="submit" class="w-full rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
        {{ $productId ? 'Save changes' : 'Create product' }}
    </button>
</form>