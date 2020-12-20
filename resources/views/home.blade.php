@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-3">
    <div class="w-full flex flex-wrap mt-4">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-800">
                                Purchasing Details
                            </h3>
                        </div>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right"></div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Product Name
                        </th>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Qty
                        </th>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Price
                        </th>
                        <th
                        class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
                        >
                        Total
                        </th>
                        <th
                        class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
                        >
                        Date
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($order_history as $item)
                    <tr>                 
                        <th
                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left"
                        >
                            {{ $item->name }}
                        </th>
                        <td
                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                        >
                            {{ $item->qty }} 
                        </td>
                        <td
                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                        >
                            $ {{ $item->price }}
                        </td>
                        <td
                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                        >
                        $ {{ $item->qty * $item->price }}
                        </td>
                        <td
                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                    >
                        {{ $item->updated_at->format('M d Y') }}
                    </td>
                    </tr>
                    @empty
                        <p> No Record </p>
                    @endforelse
                    
                    </tbody>
                </table>
                </div>
      </div>
    </div>
    <div class="w-full xl:w-4/12 px-4">
        <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
      >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-base text-gray-800">
                Invoice Lists
              </h3>
            </div>
            <div
              class="relative w-full px-4 max-w-full flex-grow flex-1 text-right"
            >
              <button
                class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                type="button"
              >
                See all
              </button>
            </div>
          </div>
        </div>
        <div class="block w-full overflow-x-auto">
          <!-- Projects table -->
          <table class="items-center w-full bg-transparent border-collapse">
            <thead class="thead-light">
              <tr>
                <th
                  class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
                >
                  Purchase Date
                </th>
                <th
                  class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left"
                >
                  Invoice No.
                </th>
                <th
                  class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left min-w-140-px"
                ></th>
              </tr>
            </thead>
            <tbody>
                @forelse ($order_inv as $item)
              <tr>
                <th
                  class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left"
                >
                {{ $item->updated_at->format('M d Y') }}
                </th>
                <td
                  class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                >
                <a href="/checkout/{{ $item->invoice }}">
                {{ $item->invoice }}
                </a>
                </td>
              </tr>
              @empty
                <p> No Record </p>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
</div>
@endsection
