@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
    <h1>User Dashboard</h1>
    <p>Hoşgeldiniz, {{ auth()->user()->name }}!</p>
@endsection
