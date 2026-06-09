<?php

namespace App\Livewire\Owner\Products;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductImageService;
use App\Support\LibraryImage;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?int $productId = null;

    public string $name = '';

    public string $description = '';

    public string $price = '';

    public bool $isActive = true;

    public int $sortOrder = 0;

    public string $imageSource = Product::IMAGE_SOURCE_NONE;

    public ?TemporaryUploadedFile $upload = null;

    public ?string $selectedLibraryImage = null;

    public ?int $categoryId = null;

    public function mount(?int $productId = null): void
    {
        $this->productId = $productId;

        if ($productId === null) {
            $this->authorize('create', Product::class);
            return;
        }

        $product = Product::query()->find($productId);
        abort_if($product === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $product);

        $this->name = $product->name;
        $this->description = (string) $product->description;
        $this->price = $product->priceFormatted();
        $this->isActive = $product->is_active;
        $this->sortOrder = $product->sort_order;
        $this->imageSource = $product->image_source;
        $this->categoryId = $product->category_id;

        $this->selectedLibraryImage = $product->image_source === Product::IMAGE_SOURCE_LIBRARY
            ? $product->image_path
            : null;
    }

    // ── Computed (memoised per request, never re-queried on the same tick) ────

    #[Computed]
    public function categories(): \Illuminate\Support\Collection
    {
        return Category::all();
    }

    #[Computed]
    public function libraryImages(): array
    {
        return array_map(
            fn(array $entry) => array_merge($entry, ['url' => LibraryImage::url($entry['key'])]),
            LibraryImage::all(),
        );
    }

    #[Computed]
    public function previewUrl(): string
    {
        if ($this->imageSource === Product::IMAGE_SOURCE_UPLOAD && $this->upload !== null) {
            if (str_starts_with((string) $this->upload->getMimeType(), 'image/')) {
                return $this->upload->temporaryUrl();
            }
            return asset('img/library/_placeholder.png');
        }

        if ($this->imageSource === Product::IMAGE_SOURCE_LIBRARY && $this->selectedLibraryImage !== null) {
            return LibraryImage::url($this->selectedLibraryImage);
        }

        if ($this->productId !== null) {
            $product = Product::query()->find($this->productId);
            if ($product !== null) {
                return $product->imageUrl();
            }
        }

        return asset('img/library/_placeholder.png');
    }

    // ── Lifecycle hooks ───────────────────────────────────────────────────────

    public function updatedImageSource(string $value): void
    {
        if ($value !== Product::IMAGE_SOURCE_UPLOAD) {
            $this->upload = null;
        }

        if ($value !== Product::IMAGE_SOURCE_LIBRARY) {
            $this->selectedLibraryImage = null;
        }

        // Bust the computed cache so previewUrl re-evaluates
        unset($this->previewUrl);
    }

    public function updatedUpload(): void
    {
        unset($this->previewUrl);
    }

    public function updatedSelectedLibraryImage(): void
    {
        unset($this->previewUrl);
    }

    // ── Actions ───────────────────────────────────────────────────────────────

    public function save(ProductImageService $productImageService): void
    {
        if ($this->productId === null) {
            $this->authorize('create', Product::class);
        }

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')
                    ->where(fn($query) => $query
                        ->where('tenant_id', auth()->user()->tenant_id)
                        ->whereNull('deleted_at'))
                    ->ignore($this->productId),
            ],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'isActive' => ['required', 'boolean'],
            'sortOrder' => ['required', 'integer', 'min:0', 'max:9999'],
            'categoryId' => ['nullable', 'integer', 'exists:categories,id'],
            'imageSource' => [
                'required',
                Rule::in([
                    Product::IMAGE_SOURCE_NONE,
                    Product::IMAGE_SOURCE_UPLOAD,
                    Product::IMAGE_SOURCE_LIBRARY,
                ]),
            ],
            'selectedLibraryImage' => ['nullable', 'string'],
        ], [
            'price.regex' => 'Price must be a valid amount like 12.50.',
            'categoryId.exists' => 'Please select a valid category.',
        ]);

        $product = $this->productId === null
            ? new Product(['tenant_id' => auth()->user()->tenant_id])
            : Product::query()->find($this->productId);

        abort_if($product === null, Response::HTTP_NOT_FOUND);

        $product->setRelation('tenant', auth()->user()->tenant);

        if ($this->productId !== null) {
            $this->authorize('update', $product);
        }

        $product->forceFill([
            'name' => $validated['name'],
            'description' => $validated['description'] ?: null,
            'price_cents' => (int) round(((float) $validated['price']) * 100),
            'is_active' => $validated['isActive'],
            'sort_order' => $validated['sortOrder'],
            'category_id' => $validated['categoryId'] ?: null,
        ]);

        $productImageService->applyToProduct(
            $product,
            $validated['imageSource'],
            $validated['selectedLibraryImage'],
            $this->upload
        );

        try {
            $product->save();
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', 'A product with this name already exists for your restaurant.');
            return;
        }

        $this->dispatch('product-saved', productId: $product->id);
    }

    public function render()
    {
        return view('livewire.owner.products.form');
    }
}