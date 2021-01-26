@extends('layouts.app')
@section('header')
    <base-header title="Checkout"></base-header>
@endsection

@section('content')
<div class="mx-auto w-full py-6">
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table-fixed divide-y divide-gray-200">
                    <thead class="bg-gray-400">
                        <tr>
                            <th scope="col" class="w-1/5 text-center px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Order NUmber
                            </th>
                            <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Items
                            </th>
                            <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Item Qty
                            </th>
                            <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Notes
                            </th>
                            <th scope="col" class="text-center w-1/6 relative px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                        {{ date('F j, Y, g:i a', strtotime($order->created_at)) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap align-top  divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{$item->product->photo}}?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->product->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $item->product->description }}
                                        </div>
                                        <div class="flex items-center">
                                            <div class="flex-1 text-sm">
                                                Price : ${{  money_format('%(#10n', $item->price) }}
                                            </div>
                                            <div class="flex-1 text-sm">
                                                Qty : {{ $item->quantity }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <div class="text-sm font-medium text-gray-900 text-center">{{ $order->item_count }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                {{ $order->notes }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-top">
                                <div class="text-sm font-medium text-gray-900">${{  money_format('%(#10n', $order->grand_total) }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
        </div>
    </div>
</div>
@endsection