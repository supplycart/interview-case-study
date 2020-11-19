@extends('layouts.app')
@section('content')
<div id="w">
    {{-- <div id="content">
      <!-- Icons source http://dribbble.com/shots/913555-Flat-Web-Elements -->
        @if($success)
        <div class="notify successbox">
            <h1 style="color:rgb(12, 88, 12)">Success!</h1>
            <span class="alerticon"><img src="" alt="checkmark" /></span>
            <p>Successful Payment! Order will be processed</p>
        </div>
        @else
        <div class="notify errorbox">
            <h1 style="color:rgb(168, 27, 27)">We are Sorry!</h1>
            <span class="alerticon"><img src="" alt="error" /></span>
            <p>Unsuccessful Payment! Your order will not be processed</p>
        </div>
        @endif


    </div> --}}
    <div class="min-h-screen flex flex-col space-y-4 items-center justify-center bg-gray-100 py-6">
        @if(!$success)
		<div class="relative font-semibold text-2xl pb-4 border-b border-gray-300">
			<span></span>
			{{-- <span class="absolute text-xs right-0 -mt-6 -mr-6 bg-blue-300 text-blue-800 rounded p-1">by iAmine</span> --}}
		</div>

		<div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
			<div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-red-500">
					<svg fill="currentColor"
						 viewBox="0 0 20 20"
						 class="h-6 w-6">
						<path fill-rule="evenodd"
							  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							  clip-rule="evenodd"></path>
					</svg>
				</span>
			</div>
			<div class="alert-content ml-4">
				<div class="alert-title font-semibold text-lg text-red-800">
					Unsuccessful!
				</div>
				<div class="alert-description text-sm text-red-600">
					Your order will not be processed
				</div>
			</div>
        </div>
        @else
        <div class="relative font-semibold text-2xl pb-4 border-b border-gray-300">
			<span>Order Number : {{ $id }}</span>
			{{-- <span class="absolute text-xs right-0 -mt-6 -mr-6 bg-blue-300 text-blue-800 rounded p-1">by iAmine</span> --}}
		</div>

		<div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
			<div class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-green-500">
					<svg fill="currentColor"
						 viewBox="0 0 20 20"
						 class="h-6 w-6">
						<path fill-rule="evenodd"
							  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
							  clip-rule="evenodd"></path>
					</svg>
				</span>
			</div>
			<div class="alert-content ml-4">
				<div class="alert-title font-semibold text-lg text-green-800">
					Successful!
				</div>
				<div class="alert-description text-lg text-green-600">
					Your order will be processed!
                </div>
                <div class="alert-description text-lg text-green-600">
                    <a href="{{ url('/get/order/history') }}">
                        Order History
                    </a>
                </div>
			</div>
		</div>
        @endif


	</div>
  </div>
@endsection

@push('scripts')

<script type="text/javascript">

    var token = "{{ csrf_token() }}";

</script>
@endpush
