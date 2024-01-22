
@extends('layout.app')

@section('title', 'Login')

@section('pageheadertext', __("Login") )

@section('style')
    @parent
@endsection

@section('script')
    @parent
@endsection

@section('content')

    {{ Form::open(['url' => route('login'), 'method'=>'POST']) }}

    <div class="form-control">
        {{ Form::label('username', __('page.username')) }}
        {{ Form::text('username', old("username"), ['class' => 'form-control']) }}
    </div>
    
    <div class="form-control">
        {{ Form::label('password', __('page.password')) }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}
    </div>

    <div class="col-sm-6">
        {{ Form::submit(__('page.login'), array('class' => 'btn btn-primary btn-block')) }}
    </div>

    {{ Form::close() }}

@endsection
