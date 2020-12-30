@extends('layouts.app')
@section('content')
<div class="bg-white justify-center">
    <div
        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 rounded-bl-lg rounded-br-lg">
        @if (count($histories) > 0)
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 text-blue-500 tracking-wider">
                        Order ID
                    </th>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-center text-sm leading-4 text-blue-500 tracking-wider">
                        Action
                    </th>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-center text-sm leading-4 text-blue-500 tracking-wider">
                        Metadata
                    </th>
                    <th
                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                        Created At
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="text-center">
                            <div>
                                <div class="text-sm leading-5 text-gray-800">#{{ $history->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="text-center">
                            <div>
                                <span class="text-sm text-center text-gray-800">{{ $history->event }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="text-center">
                            <div>
                                <span class="text-sm text-center text-gray-800">{{ $history->metadata }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                        {{ \Carbon\Carbon::parse($history->created_at)->format('Y-M-d H:i') }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{ $histories->links() }}
        @else
        <p class="flex justify-center w-full px-10 py-3 mt-6 font-medium uppercase"> You have no history yet </p>
        @endif
    </div>
</div>
@endsection