<?php

namespace App\Livewire\Customer;

use App\Models\Product;
use App\Models\Table;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.customer')]
class Catalog extends Component
{
    public string $qrToken;

    public int $tenantId;

    public string $tenantName;

    public string $tableName;

    public function mount(string $qr_token): void
    {
        $table = Table::withoutGlobalScopes()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->with('tenant')
            ->firstOrFail();

        $this->qrToken = $qr_token;
        $this->tenantId = $table->tenant_id;
        $this->tenantName = $table->tenant->name;
        $this->tableName = $table->name;
    }

    public function render()
    {
        $products = Product::withoutGlobalScopes()
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('livewire.customer.catalog', [
            'products' => $products,
        ]);
    }
}