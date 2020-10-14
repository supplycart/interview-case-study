@extends('layouts.app')
<head>
    <meta name="user-id" content="{{ Auth::user()->id }}">
</head>
@section('content')
    <App></App>
    <flash-message></flash-message>
@endsection
