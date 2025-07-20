@extends('layouts.admin')

@section('title', 'Kullanıcılar')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    {{-- Başlık ve Yeni Kullanıcı Butonu --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kullanıcılar</h1>

        {{-- Yeni kullanıcı eklemek için buton --}}
        <a href="{{ route('admin.users.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg shadow transition">
            + Yeni Kullanıcı
        </a>
    </div>

    {{-- Kullanıcı Tablosu --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">İsim</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Rol</th>
                    <th class="px-6 py-3 text-left">Durum</th>
                    <th class="px-6 py-3 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                {{-- Kullanıcılar üzerinden döngü --}}
                @foreach ($users as $user)
                <tr>
                    {{-- Kullanıcı ID --}}
                    <td class="px-6 py-4 text-gray-900">{{ $user->id }}</td>
                    {{-- Kullanıcı İsmi --}}
                    <td class="px-6 py-4 text-gray-900">{{ $user->name }}</td>
                    {{-- Kullanıcı Email --}}
                    <td class="px-6 py-4 text-gray-900">{{ $user->email }}</td>
                    {{-- Kullanıcı Rolleri --}}
                    <td class="px-6 py-4 text-gray-900">
                        {{ $user->roles->isNotEmpty()
                                    ? $user->roles->pluck('name')->join(', ')  // Kullanıcıya atanan roller
                                    : 'Rol yok' }}  {{-- Eğer rol yoksa 'Rol yok' mesajı göster --}}
                    </td>
                    {{-- Kullanıcı Durumu --}}
                    <td class="px-6 py-4">
                        @if ($user->is_active)
                        {{-- Aktif kullanıcı için yeşil etiket --}}
                        <span class="px-2 py-1 inline-flex text-xs font-medium rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                        @else
                        {{-- Pasif kullanıcı için kırmızı etiket --}}
                        <span class="px-2 py-1 inline-flex text-xs font-medium rounded-full bg-red-100 text-red-800">
                            Pasif
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        {{-- Kullanıcıyı düzenlemek için link --}}
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="text-indigo-600 hover:text-indigo-900">
                            Düzenle
                        </a>

                        {{-- Kullanıcıyı silmek için form --}}
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                            onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Sil</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Sayfalama --}}
    <div class="mt-6">
        {{ $users->links() }} {{-- Sayfalama linkleri --}}
    </div>
</div>
@endsection
