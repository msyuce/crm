@extends('layouts.admin')

@section('title', 'Kullanıcı Düzenle')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Kullanıcı Düzenle</h1>

    {{-- Hata mesajları --}}
    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- İsim alanı --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">İsim</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Email alanı --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Şifre alanı (opsiyonel) --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Şifre <span class="text-sm text-gray-500">(Boş bırakılırsa değişmez)</span>
            </label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Şifre tekrar --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Şifre Tekrar</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500" />
        </div>

        {{-- Roller (çoklu seçim kutusu) --}}
        <div>
            <label for="roles" class="block text-sm font-medium text-gray-700">Roller</label>
            <select name="roles[]" id="roles" multiple
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ in_array($role->name, old('roles', $user->roles->pluck('name')->toArray())) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Aktiflik checkbox'ı --}}
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-500" />
            <label for="is_active" class="text-sm text-gray-700">Aktif Olsun</label>
        </div>

        {{-- Aksiyon Butonları --}}
        <div class="flex justify-between items-center mt-6">
            {{-- Geri Butonu --}}
            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded shadow transition">
                ← Geri
            </a>

            {{-- Güncelle Butonu --}}
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                Güncelle
            </button>
        </div>
    </form>
</div>
@endsection
