<nav class="w-64 bg-white border-r h-screen p-4 sticky top-0">
    <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

    @php
        // Giriş yapmışsa rol kontrolü yapılır
        $dashboardRoute = auth()->check() && auth()->user()->role === 'admin'
            ? 'admin.dashboard'
            : 'user.dashboard';
    @endphp

    <ul>
        <li class="mb-2">
            {{-- Dashboard linki --}}
            <a href="{{ route($dashboardRoute) }}" 
               class="block py-2 px-4 rounded hover:bg-gray-200
                   {{ request()->routeIs($dashboardRoute) ? 'bg-gray-200 font-semibold' : '' }}">
                Dashboard
            </a>
        </li>

        @if(auth()->check() && auth()->user()->role === 'admin')
        <li class="mb-2">
            {{-- Kullanıcılar sayfasına link (sadece admin görebilir) --}}
            <a href="{{ route('admin.users.index') }}" 
               class="block py-2 px-4 rounded hover:bg-gray-200
                   {{ request()->routeIs('admin.users.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Kullanıcılar
            </a>
        </li>
        @endif

        {{-- Yeni menü öğeleri buraya eklenebilir --}}
    </ul>
</nav>
