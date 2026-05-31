<?php

namespace App\Livewire\Owner\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.owner')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    #[Url(as: 'activity')]
    public string $activity = '';

    public ?int $editingProductId = null;

    public bool $showForm = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingActivity(): void
    {
        $this->resetPage();
    }

    public function createProduct(): void
    {
        $this->authorize('create', Product::class);
        $this->editingProductId = null;
        $this->showForm = true;
    }

    public function editProduct(int $productId): void
    {
        $this->editingProductId = $productId;
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->editingProductId = null;
        $this->showForm = false;
    }

    public function handleSaved(int $productId): void
    {
        $this->editingProductId = $productId;
        $this->showForm = false;
    }

    public function toggleActive(int $productId): void
    {
        $product = Product::query()->find($productId);
        abort_if($product === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $product);

        $product->forceFill([
            'is_active' => ! $product->is_active,
        ])->save();
    }

    public function deleteProduct(int $productId): void
    {
        $product = Product::query()->find($productId);
        abort_if($product === null, Response::HTTP_NOT_FOUND);
        $this->authorize('delete', $product);
        $product->delete();

        if ($this->editingProductId === $productId) {
            $this->closeForm();
        }
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->activity === 'active', fn (Builder $query) => $query->where('is_active', true))
            ->when($this->activity === 'inactive', fn (Builder $query) => $query->where('is_active', false))
            ->paginate(10);

        return view('livewire.owner.products.index', [
            'products' => $products,
        ]);
    }
}