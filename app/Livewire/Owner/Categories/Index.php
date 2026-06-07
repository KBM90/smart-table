<?php

namespace App\Livewire\Owner\Categories;

use App\Models\ProductCategory;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.owner')]
class Index extends Component
{
    public ?int $editingCategoryId = null;

    public bool $showForm = false;

    public function createCategory(): void
    {
        $this->authorize('create', ProductCategory::class);
        $this->editingCategoryId = null;
        $this->showForm = true;
    }

    public function editCategory(int $categoryId): void
    {
        $category = ProductCategory::query()->find($categoryId);
        abort_if($category === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $category);

        $this->editingCategoryId = $categoryId;
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->editingCategoryId = null;
        $this->showForm = false;
    }

    public function handleSaved(int $categoryId): void
    {
        $this->editingCategoryId = $categoryId;
        $this->showForm = false;
    }

    public function deleteCategory(int $categoryId): void
    {
        $category = ProductCategory::query()->find($categoryId);
        abort_if($category === null, Response::HTTP_NOT_FOUND);
        $this->authorize('delete', $category);

        $category->delete();

        if ($this->editingCategoryId === $categoryId) {
            $this->closeForm();
        }
    }

    public function render()
    {
        $categories = ProductCategory::query()
            ->withCount('products')
            ->get();

        return view('livewire.owner.categories.index', [
            'categories' => $categories,
        ]);
    }
}
