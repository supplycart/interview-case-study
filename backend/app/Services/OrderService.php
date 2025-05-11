<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Events\OrderPlaced; // Bonus for activity log or notifications
use Exception; // For throwing custom exceptions

class OrderService
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Place a new order for the given user and cart items.
     *
     * @param User $user
     * @param array $validatedCartItems Array of ['product_id' => id, 'quantity' => qty]
     * @return Order
     * @throws Exception If order placement fails (e.g., stock issue not caught by validation, race condition).
     */
    public function placeOrder(User $user, array $validatedCartItems): Order
    {
        return DB::transaction(function () use ($user, $validatedCartItems) {
            $totalAmountInCents = 0;
            $orderItemsData = [];
            $productsToUpdateStock = [];

            foreach ($validatedCartItems as $item) {
                /** @var Product|null $product */
                $product = Product::find($item['product_id']); // Find fresh product instance

                // Double check stock and existence (even though validated, to handle race conditions)
                if (!$product) {
                    Log::error("OrderService: Product ID {$item['product_id']} not found during order placement for user {$user->id}.");
                    throw new Exception("Product with ID {$item['product_id']} is not available.");
                }
                if ($product->stock_quantity < $item['quantity']) {
                    Log::warning("OrderService: Insufficient stock for product ID {$product->id} ('{$product->name}') during order placement for user {$user->id}. Requested: {$item['quantity']}, Available: {$product->stock_quantity}.");
                    throw new Exception("Not enough stock for product: {$product->name}. Please update your cart.");
                }

                // Determine price (handles differential pricing - Bonus)
                $priceAtPurchase = $this->productService->getProductPriceForUser($product, $user);

                $totalAmountInCents += $priceAtPurchase * $item['quantity'];

                $orderItemsData[] = [
                    // 'order_id' will be set after order creation
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price_at_purchase_in_cents' => $priceAtPurchase,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Store product and quantity for batch stock update
                $productsToUpdateStock[] = ['id' => $product->id, 'decrement' => $item['quantity']];
            }

            // Create the order
            $order = $user->orders()->create([
                'total_amount_in_cents' => $totalAmountInCents,
                'status' => 'pending', // Initial status
            ]);

            // Create order items (batch insert if possible, or loop)
            // For batch insert, ensure 'order_id' is added to each item in $orderItemsData
            foreach ($orderItemsData as &$itemData) { // Use reference to modify array
                $itemData['order_id'] = $order->id;
            }
            DB::table('order_items')->insert($orderItemsData); // Efficient batch insert

            // Decrement stock for all products (could also be an observer on OrderItem creation)
            foreach ($productsToUpdateStock as $stockUpdate) {
                Product::where('id', $stockUpdate['id'])->decrement('stock_quantity', $stockUpdate['decrement']);
            }

            // Invalidate product caches as stock has changed
            Cache::tags(['products'])->flush();

            // Dispatch event for activity logging or other actions (Bonus)
            event(new OrderPlaced($order, $user, request()->ip(), request()->userAgent()));

            return $order->load('items.product'); // Eager load for the response
        });
    }

    /**
     * Get paginated order history for a user.
     *
     * @param User $user
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserOrders(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return $user->orders()
            ->with(['items' => function ($query) { // Eager load items and their product details
                $query->with('product:id,name,slug'); // Select specific columns for product
            }])
            ->latest() // Order by most recent
            ->paginate($perPage);
    }

    /**
     * Get details for a specific order owned by the user.
     *
     * @param User $user
     * @param int $orderId
     * @return Order|null
     */
    public function getOrderDetails(User $user, int $orderId): ?Order
    {
        return $user->orders()
            ->where('id', $orderId)
            ->with(['items' => function ($query) {
                $query->with('product:id,name,slug,description'); // Select more details if needed
            }])
            ->first(); // Use firstOrFail() if you want an exception for not found/not owned
    }
}
