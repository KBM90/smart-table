<?php

namespace App\Livewire\Customer;

use App\Models\Product;
use App\Models\Category;
use App\Models\Table;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.customer')]
class Catalog extends Component
{
    // ── Immutable context (safe to expose) ──────────────────────
    public string $qrToken;

    public string $tenantName;

    public string $tableName;

    // ── Search / filter state (wire-bindable) ────────────────────
    #[Url(as: 'q', keep: false)]
    public string $search = '';

    #[Url(as: 'cat', keep: false)]
    public ?int $categoryId = null;

    // ── Private context (never serialised to the browser) ───────
    protected int $tenantId;

    public function mount(string $qr_token): void
    {
        $table = Table::withoutGlobalScopes()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->with('tenant')
            ->firstOrFail();

        $this->qrToken    = $qr_token;
        $this->tenantId   = $table->tenant_id;
        $this->tenantName = $table->tenant->name;
        $this->tableName  = $table->name;
    }

    /**
     * All categories that have at least one active product for this tenant.
     * Memoised per request cycle via #[Computed].
     */
    #[Computed]
    public function categories(): Collection
    {
        return Category::query()
            ->whereHas('products', fn ($q) => $q
                ->withoutGlobalScopes()
                ->where('tenant_id', $this->tenantId)
                ->where('is_active', true)
                ->whereNull('deleted_at')
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    /**
     * Active products grouped by category name.
     * Products with no category fall under a synthetic "Other" bucket.
     * Memoised per request cycle via #[Computed].
     */
    #[Computed]
    public function productsByCategory(): Collection
    {
        $query = Product::withoutGlobalScopes()
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->with('category')
            ->when(
                $this->categoryId !== null,
                fn ($q) => $q->where('category_id', $this->categoryId)
            )
            ->when(
                $this->search !== '',
                fn ($q) => $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->orderBy('sort_order')
            ->orderBy('name');

        return $query->get()->groupBy(
            fn (Product $p) => $p->category?->name ?? 'Other'
        );
    }

    public function render()
    {
        return view('livewire.customer.catalog', [
            'products' => $this->productsByCategory->flatten(1)->values(),
        ]);
    }
}
