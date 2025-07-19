<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController; // Admin kullanıcı yönetimi controller'ı
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Bu dosyada uygulamanın web arayüzü için route (yol) tanımları yapılır.
| Kullanıcıların giriş, dashboard ve yönetim sayfalarına erişimi burada yönetilir.
| Route’lar HTTP isteklerini uygun controller metodlarına yönlendirir.
|
*/

// Ana sayfa ('/') çağrıldığında kullanıcıyı login sayfasına yönlendirir
Route::get('/', function () {
    return redirect()->route('login');  // '/' adresi => '/login' sayfasına yönlendir
});

// Giriş formunu gösterir (GET isteği)
// URL: /login
// LoginController'daki showLoginForm metodunu çalıştırır
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Giriş formundan gelen veriyi işler (POST isteği)
// URL: /login
// LoginController'daki login metodu form verisini alır, kullanıcıyı doğrular
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Giriş yaptıktan sonra role göre kullanıcıyı yönlendiren rota
// Bu rota login sonrası çalışır ve kullanıcı admin/user rollerine göre dashboard'a yönlendirilir
Route::get('/redirect', [LoginController::class, 'redirectAfterLogin'])
    ->middleware('auth')
    ->name('redirect');

// Çıkış işlemini gerçekleştirir
// POST olarak değiştirilmiştir
// Kullanıcı session'dan çıkarılır ve login sayfasına yönlendirilir
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth') // Kullanıcı giriş yapmışsa çıkış yapılabilir
    ->name('logout');

// Aşağıdaki route'lar sadece giriş yapmış (auth middleware) kullanıcılar tarafından erişilebilir
Route::middleware(['auth'])->group(function () {

    /*
     * Admin Panel Dashboard'u
     * Yalnızca 'admin' rolüne sahip kullanıcılar erişebilir.
     * 'role:admin' middleware'i Spatie paketi veya özel middleware ile sağlanır.
     * URL: /admin/dashboard
     * Route ismi: admin.dashboard
     * Bu rota AdminDashboardController içindeki index metoduna yönlendirir.
     */
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    /*
     * Admin Kullanıcı Yönetimi
     * Yalnızca 'admin' rolüne sahip kullanıcılar erişebilir.
     * Route prefix olarak 'admin' ve isim ön eki olarak 'admin.' kullanılır.
     * Resource controller kullanılarak tüm CRUD işlemleri için route'lar otomatik oluşturulur.
     */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    /*
     * Kullanıcı Panel Dashboard'u
     * Yalnızca 'user' rolüne sahip kullanıcılar erişebilir.
     * 'role:user' middleware'i rol kontrolü yapar.
     * URL: /user/dashboard
     * Route ismi: user.dashboard
     * Bu rota UserDashboardController içindeki index metoduna yönlendirir.
     */
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('role:user')
        ->name('user.dashboard');
});
