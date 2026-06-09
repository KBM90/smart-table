<form wire:submit="save" class="space-y-6" x-data="{
          imageSource: @entangle('imageSource'),
          get isUpload()  { return this.imageSource === '{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}' },
          get isLibrary() { return this.imageSource === '{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}' },
      }">

    <div class="grid gap-5">
        <div>
            <label for="product-name"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Name</label>
            <input wire:model.blur="name" id="product-name" type="text"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            @error('name')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-category"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Category</label>
            <select wire:model="categoryId" id="product-category"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                <option value="">— No category —</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categoryId')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-price"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Price</label>
            <div class="relative">
                <input wire:model.blur="price" id="product-price" type="text" inputmode="decimal" placeholder="12.50 DH"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-8 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            </div>
            @error('price')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-description"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Description</label>
            <textarea wire:model.blur="description" id="product-description" rows="3"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition"></textarea>
            @error('description')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="sort-order"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Sort order</label>
                <input wire:model.blur="sortOrder" id="sort-order" type="number" min="0"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                @error('sortOrder')
                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            {{--
            No wire:model.live here — the checkbox state is purely local until save().
            A server round-trip to toggle a boolean that only matters on submit is wasted latency.
            --}}
            <label
                class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 transition hover:bg-slate-100">
                <input wire:model="isActive" type="checkbox"
                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                <span class="text-sm font-semibold text-slate-700">Active product</span>
            </label>
        </div>
    </div>

    <div class="space-y-4 rounded-2xl border border-slate-100 bg-slate-50 p-5 shadow-inner">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Image Source</p>
            <div class="mt-2 grid gap-2 sm:grid-cols-3">
                {{--
                Use x-model (Alpine) on the radio group so switching panels is instant —
                no server round-trip needed. @entangle keeps Livewire in sync so the
                value is still available when the form submits.
                --}}
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_NONE }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>None</span>
                </label>
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>Upload</span>
                </label>
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>Library</span>
                </label>
            </div>
            @error('imageSource')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 lg:grid-cols-[100px_minmax(0,1fr)] items-start pt-2">
            {{-- Preview thumbnail --}}
            @if($this->previewUrl)
                <img src="{{ $this->previewUrl }}" alt="Product preview"
                    class="h-[100px] w-[100px] rounded-xl border border-slate-200 bg-white object-cover shadow-sm">
            @else
                <div
                    class="flex h-[100px] w-[100px] items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-100">
                    <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
            @endif

            <div>
                {{-- Upload panel — shown/hidden by Alpine, no server round-trip --}}
                <div x-show="isUpload" x-cloak>
                    <input wire:model.live="upload" type="file" accept="image/png,image/jpeg,image/webp"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                    <p class="mt-2 text-xs text-slate-500">Accepted: JPG, PNG, WEBP up to 4 MB (Min: 256×256).</p>
                    @error('upload')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Library panel — shown/hidden by Alpine, no server round-trip --}}
                <div x-show="isLibrary" x-cloak>
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                        @foreach ($this->libraryImages as $image)
                            <button wire:click="$set('selectedLibraryImage', '{{ $image['key'] }}')" type="button"
                                class="group relative overflow-hidden rounded-xl border-2 transition {{ $selectedLibraryImage === $image['key'] ? 'border-indigo-600 ring-2 ring-indigo-600/20' : 'border-transparent hover:border-slate-300' }}">
                                <img src="{{ $image['url'] }}" alt="{{ $image['label'] }}" loading="lazy" width="160"
                                    height="80"
                                    class="h-20 w-full object-cover transition duration-300 group-hover:scale-105">
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-2">
                                    <span
                                        class="block truncate text-left text-[10px] font-medium text-white">{{ $image['label'] }}</span>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @error('selectedLibraryImage')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- None panel --}}
                <div x-show="!isUpload && !isLibrary" x-cloak>
                    <p class="flex h-full items-center text-sm text-slate-500 italic">No image will be displayed for
                        this product.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-2">
        <button type="submit"
            class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ $productId ? 'Save changes' : 'Create product' }}
        </button>
    </div>
</form>