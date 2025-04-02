@extends('layouts.homeLayout')
@section('content')
<div class="w-full h-full flex justify-center">
    <div class="w-full max-w-4/5 content-between">
        <table class="my-5 table-auto w-full text-md text-left rtl:text-right text-black dark:text-black">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th>#</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchaseOrder as $key => $po)
                    <tr class="bg-white border-b dark:bg-gray-400 dark:border-gray-700 border-gray-200
                    odd:bg-blue-200 even:bg-gray-100">
                        <td>{{$key + 1}}</td>
                        <td>{{$po->created_at}}</td>
                        <td>
                            {{$po->status == 0?"New":
                            ($po->status == 1?"Sent":
                            ($po->status == 2?"Complete":"Cancelled"))}}
                        </td>
                        <td>
                            <a href="{{route("viewPOItems" ,['id' => $po->id_cart])}}"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold 
                            text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 
                            focus-visible:outline-indigo-600">
                                View Purchase Order
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection