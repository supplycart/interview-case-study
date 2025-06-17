<div>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Order Details</h1>
            <p class="mt-2 text-sm text-gray-600">Order #{{ $order->id }} • Placed on {{ $order->created_at->format('F j, Y') }}</p>
            
            <!-- Status Badge -->
            <div class="mt-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Order Summary</h2>
            </div>
            
            <!-- Order Items -->
            <div class="divide-y divide-gray-200">
                @foreach($orderItems as $item)
                <div class="px-6 py-4 flex items-start sm:items-center">
                    <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden border border-gray-200">
                        <img src="{{ asset('images/product.png') }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-base font-medium text-gray-900">{{ $item->product->code }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $item->product->name }}</p>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <span>Qty: {{ $item->quantity }}</span>
                            <span class="mx-2">•</span>
                            <span>RM {{ number_format($item->price, 2) }}</span>
                        </div>
                    </div>
                    <div class="ml-4 text-right">
                        <p class="text-base font-medium text-gray-900">RM {{ number_format($item->subtotal, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Order Totals -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between text-base font-medium text-gray-900 pt-2 border-t border-gray-200 mt-2">
                    <p>Total</p>
                    <p>RM {{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
