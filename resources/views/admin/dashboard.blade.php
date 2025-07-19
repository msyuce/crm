@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>
    <p>Hoşgeldiniz, {{ auth()->user()->name }}!</p>

    <p>Burada admin paneli ile ilgili genel bilgiler, işlemler ve yönetim araçları yer alabilir.</p>
@endsection
