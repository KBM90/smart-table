<?php

namespace App\Livewire\Owner\Categories;

use App\Models\ProductCategory;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;

class Form extends Component
{
    public ?int $categoryId = null;

    public string $name = '';

    public int $sortOrder = 0;

    public function mount(?int $categoryId = null): void
    {
        $this->categoryId = $categoryId;

        if ($categoryId === null) {
            $this->authorize('create', ProductCategory::class);
            return;
        }

        $category = ProductCategory::query()->find($categoryId);
        abort_if($category === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $category);

        $this->name      = $category->name;
        $this->sortOrder = $category->sort_order;
    }

    public function save(): void
    {
        if ($this->categoryId === null) {
            $this->authorize('create', ProductCategory::class);
        }

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('product_categories', 'name')
                    ->where(fn ($q) => $q->where('tenant_id', auth()->user()->tenant_id)->whereNull('deleted_at'))
                    ->ignore($this->categoryId),
            ],
            'sortOrder' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $category = $this->categoryId === null
            ? new ProductCategory(['tenant_id' => auth()->user()->tenant_id])
            : ProductCategory::query()->find($this->categoryId);

        abort_if($category === null, Response::HTTP_NOT_FOUND);

        if ($this->categoryId !== null) {
            $this->authorize('update', $category);
        }

        try {
            $category->forceFill([
                'name'       => $validated['name'],
                'sort_order' => $validated['sortOrder'],
            ])->save();
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', 'A category with this name already exists.');
            return;
        }

        $this->dispatch('category-saved', categoryId: $category->id);
    }

    public function render()
    {
        return view('livewire.owner.categories.form');
    }
}
