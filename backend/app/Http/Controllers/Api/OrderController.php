<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\PlaceOrderRequest;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception; // For catching service layer exceptions
use App\Models\Order; // For route model binding

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Store a newly created order in storage.
     * Authenticated users must be able to place an order for items in their cart.
     */
    public function store(PlaceOrderRequest $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $validatedCartItems = $request->validated()['items'];

        try {
            $order = $this->orderService->placeOrder($user, $validatedCartItems);
            return (new OrderResource($order))
                ->response()
                ->setStatusCode(201); // HTTP 201 Created
        } catch (Exception $e) {
            Log::error("Order placement failed for user {$user->id}: " . $e->getMessage(), [
                'items' => $validatedCartItems,
                'trace' => $e->getTraceAsString() // For detailed debugging
            ]);
            return response()->json(['message' => "Order placement failed: " . $e->getMessage()], 422); // Unprocessable Entity
        }
    }

    /**
     * Display the order history for the authenticated user.
     * Authenticated users must be able to view their past orders.
     */
    public function index(Request $request): OrderCollection
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $perPage = $request->input('per_page', 10); // Allow specifying per_page via query param

        $orders = $this->orderService->getUserOrders($user, (int)$perPage);
        return new OrderCollection($orders);
    }

    /**
     * Display the specified order, if owned by the user.
     * Using Route Model Binding for $order.
     * We'll add an authorization check.
     */
    public function show(Order $order, Request $request): OrderResource|JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Authorization: Ensure the user owns the order
        if ($order->user_id !== $user->id) {
            return response()->json(['message' => 'You are not authorized to view this order.'], 403);
        }

        // Order details service method might not be needed if basic $order->load(...) is sufficient
        // $detailedOrder = $this->orderService->getOrderDetails($user, $order->id);
        // if (!$detailedOrder) {
        //     return response()->json(['message' => 'Order not found or not owned by user.'], 404);
        // }
        // Just load necessary relations directly if Order model is already resolved
        $order->loadMissing(['items' => function ($query) {
            $query->with('product:id,name,slug,description');
        }]);


        return new OrderResource($order);
    }
}
