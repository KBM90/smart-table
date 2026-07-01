<form wire:submit="save" class="space-y-6" x-data="{
          imageSource: @entangle('imageSource'),
          get isUpload()  { return this.imageSource === '{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}' },
          get isLibrary() { return this.imageSource === '{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}' },
      }">
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

    <div class="grid gap-5">
        <div>
            <label for="product-name"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('owner.products.name') }}</label>
            <input wire:model.blur="name" id="product-name" type="text"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            @error('name')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-category"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('owner.products.category') }}</label>
            <select wire:model="categoryId" id="product-category"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                <option value="">{{ __('owner.products.no_category') }}</option>
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
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('owner.products.price') }}</label>
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
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('owner.products.description') }}</label>
            <textarea wire:model.blur="description" id="product-description" rows="3"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition"></textarea>
            @error('description')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="sort-order"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('owner.products.sort_order') }}</label>
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
                <span class="text-sm font-semibold text-slate-700">{{ __('owner.products.active_product') }}</span>
            </label>
        </div>
    </div>

    <div class="space-y-4 rounded-2xl border border-slate-100 bg-slate-50 p-5 shadow-inner">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('owner.products.image_source') }}</p>
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
                    <span>{{ __('owner.products.image_none') }}</span>
                </label>
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>{{ __('owner.products.image_upload') }}</span>
                </label>
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>{{ __('owner.products.image_library') }}</span>
                </label>
            </div>
            @error('imageSource')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 lg:grid-cols-[100px_minmax(0,1fr)] items-start pt-2">
            {{-- Preview thumbnail --}}
            @if($this->previewUrl)
                <img src="{{ $this->previewUrl }}" alt="{{ __('owner.products.preview_alt') }}"
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
                    <p class="mt-2 text-xs text-slate-500">{{ __('owner.products.upload_help') }}</p>
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
                    <p class="flex h-full items-center text-sm text-slate-500 italic">{{ __('owner.products.no_image') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-2">
        <button type="submit" wire:loading.attr="disabled" wire:target="save"
            class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-70">
            {{ $productId ? __('owner.products.save_changes') : __('owner.products.create') }}
        </button>
    </div>
</form>
