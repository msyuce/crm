<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Uygulama nesnesini oluştur ve yapılandır
return Application::configure(basePath: dirname(__DIR__))

    // Route dosyalarını tanımla
    ->withRouting(
        web: __DIR__.'/../routes/web.php',       // Web route dosyası
        commands: __DIR__.'/../routes/console.php', // Artisan komutları
        health: '/up',                            // Sağlık kontrolü endpoint'i (opsiyonel)
    )

    // Middleware yapılandırması
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * → Buraya web, api veya global middleware’leri append/prepend edebilirsin.
         * → Ayrıca, alias tanımlamaları bu kısımda yapılır.
         */

        // Örnek: Route’larda kullanmak üzere kısa isimle alias tanımlıyoruz
        $middleware->alias([
            // 'is_admin' adında bir middleware alias tanımlıyoruz
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })

    // Exception (hata) yapılandırması
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    // Uygulama nesnesini oluştur
    ->create();
