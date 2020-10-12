@extends('layouts.app')
<head>
    <meta name="user-id" content="{{ Auth::user()->id }}">
</head>
@section('content')
    <App></App>
@endsection
