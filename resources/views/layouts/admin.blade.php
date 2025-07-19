<!DOCTYPE html>
<html lang="tr">
<head>
    {{-- Admin paneli için başlık, stil ve meta bilgilerini içeren head dosyasını buraya dahil ediyoruz. --}}
    {{-- Bu dosya genellikle tüm sayfalarda ortak olan head bilgilerini içerir. --}}
    @include('layouts.partials.admin.head')
</head>
<body>
    {{-- Admin panelinin üst kısmındaki header'ı burada dahil ediyoruz. --}}
    {{-- Header, genellikle kullanıcı bilgisi, logo ve navigasyon menüsünü içerir. --}}
    @include('layouts.partials.admin.header')

    {{-- Admin panelinin yan menüsü (sidebar) burada dahil ediliyor. --}}
    {{-- Sidebar, adminin yöneticilik işlemleri için hızlı erişim alanları sunar. --}}
    <div class="sidebar">
        @include('layouts.partials.admin.sidebar')
    </div>

    {{-- Ana içerik alanı burada. --}}
    <main class="content">
        {{-- Admi
