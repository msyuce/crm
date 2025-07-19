<nav class="w-64 bg-white border-r h-screen p-4 sticky top-0">
    <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

    @php
        // Kullanıcının giriş yapıp yapmadığını ve rolünü kontrol ediyoruz
        // Eğer admin ise admin.dashboard route'u kullanılır,
        // değilse user.dashboard route'u kullanılır.
        $dashboardRoute = auth()->check() && auth()->user()->hasRole('admin') ? 'admin.dashboard' : 'user.dashboard';
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

        {{-- İstersen buraya yeni menü öğeleri ekleyebilirsin --}}
    </ul>
</nav>
