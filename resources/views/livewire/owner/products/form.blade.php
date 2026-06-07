<form wire:submit="save" class="space-y-5">
    <div class="grid gap-5">
        <div>
            <label for="product-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Name</label>
            <input wire:model.blur="name" id="product-name" type="text" placeholder="e.g. Latte Macchiato" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            @error('name')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-price" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Price ($)</label>
            <input wire:model.blur="price" id="product-price" type="text" inputmode="decimal" placeholder="e.g. 4.50" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            @error('price')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-description" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Description</label>
            <textarea wire:model.blur="description" id="product-description" rows="3" placeholder="Write a short description of the item..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200"></textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="sort-order" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Sort Order</label>
                <input wire:model.blur="sortOrder" id="sort-order" type="number" min="0" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
                @error('sortOrder')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-end">
                <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm select-none cursor-pointer hover:bg-slate-50/50 transition-colors">
                    <input wire:model.live="isActive" type="checkbox" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm font-semibold text-slate-700">Active product</span>
                </label>
            </div>
        </div>
    </div>

    <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50/50 p-4 shadow-inner">
        <div>
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-500">Image Source</p>
            <div class="mt-3 grid gap-2 sm:grid-cols-3">
                <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 font-semibold shadow-sm cursor-pointer hover:bg-slate-50 hover:border-slate-300 transition-all">
                    <input wire:model.live="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_NONE }}" class="text-indigo-600 focus:ring-indigo-500 border-slate-300">
                    <span>No image</span>
                </label>
                <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 font-semibold shadow-sm cursor-pointer hover:bg-slate-50 hover:border-slate-300 transition-all">
                    <input wire:model.live="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}" class="text-indigo-600 focus:ring-indigo-500 border-slate-300">
                    <span>Upload</span>
                </label>
                <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 font-semibold shadow-sm cursor-pointer hover:bg-slate-50 hover:border-slate-300 transition-all">
                    <input wire:model.live="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}" class="text-indigo-600 focus:ring-indigo-500 border-slate-300">
                    <span>Library</span>
                </label>
            </div>
            @error('imageSource')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 lg:grid-cols-[120px_minmax(0,1fr)] items-start">
            <img src="{{ $previewUrl }}" alt="Product preview" class="h-[120px] w-[120px] rounded-2xl object-cover border border-slate-200 shadow-sm bg-white">

            <div class="w-full">
                @if ($imageSource === \App\Models\Product::IMAGE_SOURCE_UPLOAD)
                    <div class="space-y-2">
                        <input wire:model.live="upload" type="file" accept="image/png,image/jpeg,image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        <p class="text-[10px] font-semibold text-slate-400">JPG, PNG, WEBP up to 4 MB (minimum 256x256 px).</p>
                        @error('upload')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @elseif ($imageSource === \App\Models\Product::IMAGE_SOURCE_LIBRARY)
                    <div class="space-y-2">
                        <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-3">
                            @foreach ($libraryImages as $image)
                                <button wire:click="$set('selectedLibraryImage', '{{ $image['key'] }}')" type="button" class="overflow-hidden rounded-xl border bg-white shadow-sm transition-all duration-200
                                    {{ $selectedLibraryImage === $image['key']
                                        ? 'border-indigo-500 ring-2 ring-indigo-500/20'
                                        : 'border-slate-200 hover:border-slate-300' }}">
                                    <img src="{{ asset('img/library/'.basename($image['key'])) }}" alt="{{ $image['label'] }}" class="h-16 w-full object-cover">
                                    <span class="block px-2 py-1.5 text-[9px] font-bold uppercase tracking-wider text-slate-500 border-t border-slate-100 text-center truncate">{{ $image['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                        @error('selectedLibraryImage')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <p class="rounded-xl border border-dashed border-slate-300 px-4 py-6 text-sm text-slate-400 font-medium text-center bg-white">No image will be shown for this product.</p>
                @endif
            </div>
        </div>
    </div>

    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        {{ $productId ? 'Save Changes' : 'Create Product' }}
    </button>
</form>