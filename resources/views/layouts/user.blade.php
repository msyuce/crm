<!DOCTYPE html>
<html lang="tr">
<head>
    {{-- User için head bölümünü include ediyoruz. --}}
    {{-- resources/views/layouts/partials/user/head.blade.php dosyasını include ediyoruz. --}}
    @include('layouts.partials.user.head')
</head>
<body>
    {{-- Header kısmını include ediyoruz. --}}
    {{-- resources/views/layouts/partials/user/header.blade.php dosyasını include ediyoruz. --}}
    @include('layouts.partials.user.header')

    <div class="sidebar">
        {{-- Sidebar (yan menü) kısmını include ediyoruz. --}}
        {{-- resources/views/layouts/partials/user/sidebar.blade.php dosyasını include ediyoruz. --}}
        @include('layouts.partials.user.sidebar')
    </div>

    <main class="content">
        {{-- Alerts kısmını include ediyoruz. --}}
        {{-- resources/views/layouts/partials/user/alerts.blade.php dosyasını include ediyoruz. --}}
        @include('layouts.partials.user.alerts')

        {{-- Dinamik içerik alanı. --}}
        {{-- Buradaki içerik, her sayfada değişir. --}}
        @yield('content')
    </main>

    {{-- Footer kısmını include ediyoruz. --}}
    {{-- resources/views/layouts/partials/user/footer.blade.php dosyasını include ediyoruz. --}}
    @include('layouts.partials.user.footer')

    {{-- Logout Formu --}}
    {{-- Çıkış işlemi için kullanılan formu buraya ekliyoruz. Bu form, görünmez olacak şekilde tasarlandı. --}}
    <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">
        @csrf
    </form>

    <script>
        // Logout butonuna tıklandığında logout formunu submit et.
        document.getElementById('logout-button').addEventListener('click', function() {
            document.getElementById('logout-form').submit(); // logout formunu gönderir
        });
    </script>
</body>
</html>
