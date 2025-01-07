<!-- resources/views/activity_logs/index.blade.php -->

@extends('layouts.app')

@section('title', 'Logs')
@section('header', 'Activity Logs')

@section('content')
    <div class="container">
        <h1>Activity Logs</h1>

        @if($logs->isEmpty())
            <p>No activity logs found.</p>
        @else
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">User</th>
                        <th class="px-4 py-2">Action</th>
                        <th class="px-4 py-2">Timestamp</th>
                        <th class="px-4 py-2">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $log->user->name }}</td>
                            <td class="px-4 py-2">{{ $log->activity }}</td>
                            <td class="px-4 py-2">{{ $log->created_at }}</td>
                            <td class="px-4 py-2">{{ $log->details }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $logs->links() }}
        @endif
    </div>
@endsection
