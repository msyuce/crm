<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Uygulama servislerine ait tüm bağımlılıkları burada kaydedebilirsin.
     * Örneğin: özel sınıf bağlamaları, singleton tanımları vs.
     */
    public function register(): void
    {
        // Şimdilik özel bir servis kaydı yapılmıyor.
    }

    /**
     * Uygulama başlatıldığında yapılması gereken işlemler burada tanımlanır.
     * Örneğin: middleware alias'ları, blade component tanımları, event listener'lar vs.
     */
    public function boot(): void
    {
        /**
         * Laravel 12’de Kernel.php olmadığı için,
         * Spatie rol ve izin middleware'lerini burada manuel olarak tanıtıyoruz.
         *
         * Artık rotalarda şu şekilde kullanılabilir:
         * Route::middleware('role:admin')->get(...);
         */
        app('router')->aliasMiddleware('role', RoleMiddleware::class);
        app('router')->aliasMiddleware('permission', PermissionMiddleware::class);
        app('router')->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    }
}
