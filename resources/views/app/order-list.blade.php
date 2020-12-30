@extends('layouts.app')
@section('content')
<div class="bg-white justify-center">
    <div
        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 rounded-bl-lg rounded-br-lg">
        @if (count($orders) > 0)
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        Order ID
                    </th>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                        Created At
                    </th>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                        Ordered Products
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 text-gray-800">#{{ $order->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                        {{ \Carbon\Carbon::parse($order->created_at)->format('Y-M-d H:i') }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                        <a
                            href="{{ route('orders-detail', ['order' => $order->id])}}"
                            class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">View
                            Details
                        </a>
                    </td>
                </tr>
                @endforeach
                {{ $orders->links() }}
            </tbody>
        </table>
        @else
        <p class="flex justify-center w-full px-10 py-3 mt-6 font-medium uppercase"> You have not placed any orders </p>
        @endif
    </div>
</div>
@endsection