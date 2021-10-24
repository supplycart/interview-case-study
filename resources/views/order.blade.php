@extends('app')

@section('content')
    <div class="h-full">
        <section class="header relative">
            <div class="bg-no-repeat bg-cover bg-center w-full" style="background-image:url({{ asset('images/header.jpg') }}); height: 500px"></div>
            <div class="bg-black w-full absolute top-0 left-0 opacity-20" style="height:500px"></div>
        </section>
        <div class="container mx-auto mt-12">
        
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order No.
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order date
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (!empty($data))
                        @foreach($data as $order)
                        <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                {{ $loop->iteration }}
                                </div>
                            </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">RM{{ number_format($order->total, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Success
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date_format($order->created_at, 'd-M-Y') }}
                        </td>
                        </tr>

                        <!-- More people... -->
                        @endforeach
                        @else
                        <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-gray-400 italic">You do not have any items in your cart..</span>
                        </td>
                        </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection