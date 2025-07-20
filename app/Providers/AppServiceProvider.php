<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
       // Bu kısmı kaldırıyoruz. 
        // app('router')->aliasMiddleware('role', RoleMiddleware::class);
        // app('router')->aliasMiddleware('permission', PermissionMiddleware::class);
        // app('router')->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    
    }
}
