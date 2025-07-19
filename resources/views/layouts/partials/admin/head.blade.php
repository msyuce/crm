{{-- resources/views/layouts/partials/admin/head.blade.php --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    {{-- Sayfa Başlığı (Varsayılan: CRM Paneli) --}}
    <title>@yield('title', 'CRM Paneli')</title>

    {{-- Uygulama CSS ve JS dosyaları (Vite ile derlenmiş) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Sayfaya özel ek stil ve script alanları --}}
    @stack('styles')
    @stack('scripts')
</head>
