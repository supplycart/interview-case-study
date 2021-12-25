@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Activity Logs</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 20px">No</th>
                                    <th>Activity</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($activityLogs as $activityLog)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $activityLog->activity }}</td>
                                        <td>{{ date('d M Y', strtotime($activityLog->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="card-footer clearfix">
                            {{ $activityLogs->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection