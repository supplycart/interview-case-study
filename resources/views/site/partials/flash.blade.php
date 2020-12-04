@php
    $errors = Session::get('error');
    $messages = Session::get('success');
    $info = Session::get('info');
    $warnings = Session::get('warning');

@endphp
@if (is_array($errors) || is_object($errors)) @foreach($errors as $key => $value)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Error!</strong> {{ $value }}
    </div>
@endforeach @endif

@if (is_array($messages) || is_object($messages)) @foreach($messages as $key => $value)
    <div class="alert alert-success alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Success!</strong> {{ $value }}
    </div>
@endforeach @endif

@if (is_array($info) || is_object($info)) @foreach($info as $key => $value)
    <div class="alert alert-info alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Info!</strong> {{ $value }}
    </div>
@endforeach @endif

@if (is_array($warnings) || is_object($warnings)) @foreach($warnings as $key => $value)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Warning!</strong> {{ $value }}
    </div>
@endforeach @endif