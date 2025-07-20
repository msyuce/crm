@extends('layouts.admin')

@section('title', 'Yeni Kullanıcı Ekle')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Yeni Kullanıcı Ekle</h1>

    {{-- Hata mesajları --}}
    {{-- Eğer form gönderilirken herhangi bir doğrulama hatası oluşmuşsa, burada tüm hata mesajları listelenir. --}}
    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Kullanıcı Ekleme Formu --}}
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf  {{-- CSRF koruması için gerekli token gönderilir --}}

        {{-- İsim --}}
        {{-- Kullanıcı adının girileceği alan. Gerekli olup olmadığı kontrol edilir. --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">İsim</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Email --}}
        {{-- Kullanıcı e-posta adresi için input alanı. Emailin doğru formatta olup olmadığı kontrol edilir. --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Şifre --}}
        {{-- Kullanıcı şifresinin girileceği alan. Şifre zorunlu ve minimum 6 karakter olmalı. --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Şifre</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Şifre tekrar --}}
        {{-- Kullanıcı şifresinin doğruluğunu teyit etmek için tekrar şifre girme alanı. --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Şifre Tekrar</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Roller --}}
        {{-- Kullanıcıya bir veya birden fazla rol atamak için çoklu seçim alanı. --}}
        <div>
            <label for="roles" class="block text-sm font-medium text-gray-700">Roller</label>
            <select name="roles[]" id="roles" multiple
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500">
                {{-- Tüm roller döngü ile listelenir ve eski seçimler korunur --}}
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ in_array($role->name, old('roles', [])) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Aktiflik Durumu --}}
        {{-- Kullanıcının aktif olup olmayacağına dair bir checkbox. Varsayılan olarak işaretli olmayacaktır. --}}
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                {{ old('is_active') ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-500" />
            <label for="is_active" class="text-sm text-gray-700">Aktif Olsun</label>
        </div>

        {{-- Butonlar --}}
        {{-- Form gönderildiğinde kullanıcıyı admin kullanıcı listesine yönlendiren geri butonu ve kullanıcı ekleme butonu. --}}
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded shadow transition">
                ← Geri
            </a>

            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                Ekle
            </button>
        </div>
    </form>
</div>
@endsection
