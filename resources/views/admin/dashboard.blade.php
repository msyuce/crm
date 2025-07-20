@extends('layouts.admin')

@section('title', 'Admin Dashboard') <!-- Sayfa başlığını 'Admin Dashboard' olarak ayarlıyoruz -->

@section('content')
    <!-- Admin Dashboard başlığı -->
    <h1>Admin Dashboard</h1>
    
    <!-- Kullanıcı giriş yapmışsa, kullanıcının adı burada gösterilecek -->
    <p>Hoşgeldiniz, {{ auth()->check() ? auth()->user()->name : 'Misafir' }}!</p>
    
    <!-- Admin paneli ile ilgili açıklamalar -->
    <p>Burada admin paneli ile ilgili genel bilgiler, işlemler ve yönetim araçları yer alabilir.</p>
@endsection
