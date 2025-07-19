<header class="bg-white border-b p-4 flex justify-end items-center shadow-sm sticky top-0 z-10">
    <div class="flex items-center space-x-4">
        <span class="text-gray-700">Hoşgeldiniz, {{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded shadow">
                Çıkış Yap
            </button>
        </form>
    </div>
</header>
