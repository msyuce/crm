@extends('layouts.admin')

@section('title', 'Hoş Geldiniz')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <img src="{{ asset('storage/company/logo.png') }}" alt="Firma Logo" class="w-40 mb-6">
        <h1 class="text-3xl font-bold mb-4">Hoş geldiniz</h1>
        <p class="mb-8 text-gray-600">Lütfen giriş türünüzü seçin</p>
        <div class="space-x-4">
            <a href="{{ route('admin.login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-xl">Admin Girişi</a>
            <a href="{{ route('user.login') }}" class="px-6 py-3 bg-green-600 text-white rounded-xl">Kullanıcı Girişi</a>
        </div>
    </div>
@endsection
