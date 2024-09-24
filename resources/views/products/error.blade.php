<!-- resources/views/errors/403.blade.php -->
@extends('layouts.app')

@section('title', '403 - Unauthorized Access')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="display-3 text-danger">403</h1>
        <h2 class="display-5">Unauthorized Access</h2>
        <p class="lead">Sorry, you do not have permission to access this page.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
    </div>
</div>
@endsection
