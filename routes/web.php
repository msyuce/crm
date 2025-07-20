<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Bu dosyada uygulamanın web arayüzü için route (yol) tanımları yapılır.
| Laravel Breeze'in sunduğu auth yapısını kullanıyoruz.
| Giriş yapan kullanıcının rolüne göre yönlendirme yapıyoruz.
|--------------------------------------------------------------------------
*/

// Ana sayfa => login sayfasına yönlendir
Route::get('/', fn() => redirect()->route('login'));

// Login sayfası (GET) ve giriş işlemi (POST)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ❗ Logout işlemi için rota (POST olarak tanımlanmalı!)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Girişten sonra rol kontrolü yaparak yönlendirme
Route::middleware('auth')->get('/redirect', function () {
    $user = auth()->user();

    // Rol kontrolü ve ilgili dashboard'a yönlendirme
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'user') {
        return redirect()->route('user.dashboard');
    } else {
        // Geçersiz rol varsa oturumu kapat ve login'e geri dön
        auth()->logout();
        return redirect()->route('login')->withErrors('Yetkisiz kullanıcı');
    }
})->name('redirect');

// Admin paneli rotaları (sadece 'admin' rolüne sahip kullanıcılar erişebilir)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class); // Admin kullanıcı yönetimi
});

// User paneli rotaları (sadece 'user' rolüne sahip kullanıcılar erişebilir)
Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});
