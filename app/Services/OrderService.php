<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ServiceRequest;
use App\Models\TableSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function __construct(
        protected ServiceRequestService $serviceRequests,
    ) {
    }

    /**
     * Place an order for an active table session. This always triggers the
     * same "call waiter" request created by the bell button (idempotently),
     * so staff see the order in the same request queue.
     *
     * @param  array<int, array{product_id:int, quantity:int}>  $items
     * @return array{order: Order, request: ServiceRequest, requests_ahead: int}
     */
    public function placeOrder(TableSession $session, array $items, ?string $note = null): array
    {
        if (empty($items)) {
            throw ValidationException::withMessages([
                'items' => 'Please add at least one item to your order.',
            ]);
        }

        return DB::transaction(function () use ($session, $items, $note): array {
            $locked = TableSession::withoutGlobalScopes()
                ->whereKey($session->getKey())
                ->where('status', TableSession::STATUS_ACTIVE)
                ->lockForUpdate()
                ->first();

            if ($locked === null) {
                abort(403, 'Table session is no longer active.');
            }

            $productIds = collect($items)->pluck('product_id')->unique()->all();

            $products = Product::withoutGlobalScopes()
                ->where('tenant_id', $locked->tenant_id)
                ->where('is_active', true)
                ->whereNull('deleted_at')
                ->whereIn('id', $productIds)
                ->get()
                ->keyBy('id');

            $orderItems = [];
            $totalCents = 0;

            foreach ($items as $item) {
                $product = $products->get($item['product_id']);

                if ($product === null) {
                    continue;
                }

                $quantity = max(1, min(50, (int) $item['quantity']));
                $lineTotal = $product->price_cents * $quantity;
                $totalCents += $lineTotal;

                $orderItems[] = [
                    'product_id' => $product->getKey(),
                    'product_name' => $product->name,
                    'unit_price_cents' => $product->price_cents,
                    'quantity' => $quantity,
                ];
            }

            if (empty($orderItems)) {
                throw ValidationException::withMessages([
                    'items' => 'The items in your order are no longer available.',
                ]);
            }

            // Same idempotent request creation used by "Call Waiter" — placing
            // an order always alerts staff, equivalent to tapping the bell.
            $result = $this->serviceRequests->createOrReturnExisting($locked);
            $request = $result['request'];

            if ($request->type === ServiceRequest::TYPE_CALL_WAITER) {
                $request->forceFill(['type' => ServiceRequest::TYPE_ORDER])->save();
            }

            $order = Order::withoutGlobalScopes()->create([
                'tenant_id' => $locked->tenant_id,
                'table_session_id' => $locked->getKey(),
                'request_id' => $request->getKey(),
                'note' => $note,
                'total_cents' => $totalCents,
            ]);

            foreach ($orderItems as $orderItem) {
                OrderItem::query()->create($orderItem + ['order_id' => $order->getKey()]);
            }

            return [
                'order' => $order->load('items'),
                'request' => $request,
                'requests_ahead' => $result['requests_ahead'],
            ];
        });
    }
}