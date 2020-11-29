@extends('layouts.app')

@section('content')
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="flex justify-center my-6">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="flex-1">

                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                        <thead>
                        <tr class="h-12 uppercase">
                            <th class="text-center">ID</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-left">Total price</th>
                            <th class="text-left"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->created_at }}</td>
                                <td class="text-center">{{ $order->status ? 'Completed' : 'Processing' }}</td>
                                <td class="text-left">MYR {{ $order->total_amount }}</td>
                                <td>
                                    <a href="{{ route('order.view', [$order]) }}" type="button" class="flex text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-center">View Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
