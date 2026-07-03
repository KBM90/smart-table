<?php

namespace App\Livewire\Customer;

use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableSession;
use App\Services\OrderService;
use App\Services\TableSessionService;
use App\Support\ComponentRateLimiter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
use Symfony\Component\HttpFoundation\Response;

#[Layout('layouts.customer')]
class Catalog extends Component
{
    public const SESSION_COOKIE = 'st_session_token';

    public const SESSION_TTL_MINUTES = 60;

    // ── Immutable context ──────────────────────────────────────
    public string $qrToken;

    public string $tenantName;

    public string $tableName;

    public int $tenantId;

    public int $sessionId;

    public bool $blocked = false;

    // ── Search / filter state ────────────────────────────────────
    #[Url(as: 'q', keep: false)]
    public string $search = '';

    #[Url(as: 'cat', keep: false)]
    public ?int $categoryId = null;

    // ── Cart state: productId => quantity ────────────────────────
    public array $cart = [];

    public string $orderNote = '';

    public function mount(string $qr_token, TableSessionService $tableSessionService): void
    {
        $table = Table::withoutGlobalScopes()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->with('tenant')
            ->firstOrFail();

        $result = $tableSessionService->resolveOrStart($table, request()->cookie(self::SESSION_COOKIE));
        $session = $result['session'];

        $this->qrToken = $qr_token;
        $this->tenantId = $table->tenant_id;
        $this->tenantName = $table->tenant->name;
        $this->tableName = $table->name;
        $this->sessionId = $session->getKey();
        $this->blocked = $result['blocked'];

        if (!$this->blocked) {
            Cookie::queue($this->sessionCookie($session->session_token));
        }
    }

    public function selectCategory(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    // ── Cart actions ──────────────────────────────────────────────

    public function addToCart(int $productId): void
    {
        if ($this->blocked) {
            return;
        }

        $this->cart[$productId] = ($this->cart[$productId] ?? 0) + 1;
    }

    public function incrementQty(int $productId): void
    {
        $this->addToCart($productId);
    }

    public function decrementQty(int $productId): void
    {
        if (!isset($this->cart[$productId])) {
            return;
        }

        $this->cart[$productId]--;

        if ($this->cart[$productId] <= 0) {
            unset($this->cart[$productId]);
        }
    }

    public function removeFromCart(int $productId): void
    {
        unset($this->cart[$productId]);
    }

    #[Computed]
    public function cartProducts(): Collection
    {
        if (empty($this->cart)) {
            return collect();
        }

        return Product::withoutGlobalScopes()
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->whereIn('id', array_keys($this->cart))
            ->get()
            ->map(function (Product $product) {
                $quantity = (int) ($this->cart[$product->id] ?? 0);

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal_cents' => $product->price_cents * $quantity,
                ];
            })
            ->filter(fn(array $row) => $row['quantity'] > 0)
            ->values();
    }

    #[Computed]
    public function cartCount(): int
    {
        return (int) array_sum($this->cart);
    }

    #[Computed]
    public function cartTotalCents(): int
    {
        return (int) $this->cartProducts->sum('subtotal_cents');
    }

    public function submitOrder(OrderService $orderService, ComponentRateLimiter $rateLimiter): ?RedirectResponse
    {
        abort_if($this->blocked, Response::HTTP_FORBIDDEN);

        if (empty($this->cart)) {
            $this->addError('items', __('customer.catalog.empty_cart'));

            return null;
        }

        $session = TableSession::withoutGlobalScopes()
            ->whereKey($this->sessionId)
            ->where('status', TableSession::STATUS_ACTIVE)
            ->first();

        if ($session === null) {
            $this->addError('items', __('customer.catalog.session_expired'));

            return null;
        }

        $cookieToken = request()->cookie(self::SESSION_COOKIE);

        abort_unless(
            $cookieToken !== null && hash_equals($session->session_token, $cookieToken),
            Response::HTTP_FORBIDDEN
        );

        $rateLimiter->ensureCustomerActionLimit($session->session_token);

        $items = collect($this->cart)
            ->filter(fn($quantity) => $quantity > 0)
            ->map(fn($quantity, $productId) => [
                'product_id' => (int) $productId,
                'quantity' => (int) $quantity,
            ])
            ->values()
            ->all();

        try {
            $orderService->placeOrder($session, $items, $this->orderNote !== '' ? $this->orderNote : null);
        } catch (ValidationException $e) {
            $this->addError('items', collect($e->errors())->flatten()->first() ?? __('customer.catalog.order_failed'));

            return null;
        }

        return redirect()->route('customer.table', ['qr_token' => $this->qrToken]);
    }

    // ── Computed listing (unchanged logic) ───────────────────────

    #[Computed]
    public function categories(): Collection
    {
        return Category::query()
            ->whereHas(
                'products',
                fn($q) => $q
                    ->withoutGlobalScopes()
                    ->where('tenant_id', $this->tenantId)
                    ->where('is_active', true)
                    ->whereNull('deleted_at')
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

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
                fn($q) => $q->where('category_id', $this->categoryId)
            )
            ->when(
                $this->search !== '',
                fn($q) => $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->orderBy('sort_order')
            ->orderBy('name');

        return $query->get()->groupBy(
            fn(Product $p) => $p->category?->name ?? 'Other'
        );
    }

    public function render()
    {
        return view('livewire.customer.catalog', [
            'products' => $this->productsByCategory->flatten(1)->values(),
        ]);
    }

    protected function sessionCookie(string $token): SymfonyCookie
    {
        return Cookie::make(
            self::SESSION_COOKIE,
            $token,
            self::SESSION_TTL_MINUTES,
            '/',
            null,
            null,
            config('session.secure', false),
            false,
            'lax'
        );
    }
}