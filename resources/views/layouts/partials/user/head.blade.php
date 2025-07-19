<!-- resources/views/layouts/partials/head.blade.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    {{-- Sayfa başlığı --}}
    <title>@yield('title', 'CRM Paneli')</title>

    {{-- Tailwind CSS ve JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Ek stil veya script tanımları için --}}
    @stack('styles')
    @stack('scripts')
</head>