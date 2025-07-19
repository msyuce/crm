<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Giriş (login) formunu gösterir.
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // resources/views/auth/login.blade.php dosyasını döndürür.
        return view('auth.login');
    }

    /**
     * Giriş formundan gelen veriyi işler.
     * Kullanıcının e-posta ve parolasını doğrular.
     * Başarılı ise rolüne göre ilgili dashboard'a yönlendirir.
     * Başarısız ise hata mesajı ile login sayfasına geri döner.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Gelen veriyi validasyon ile kontrol et
        $credentials = $request->validate([
            'email' => ['required', 'email'],  // Email alanı zorunlu ve geçerli e-posta formatında olmalı
            'password' => ['required'],        // Şifre alanı zorunlu
        ]);

        // 2. Eğer kimlik bilgileri doğruysa giriş yapmayı dene
        if (Auth::attempt($credentials)) {
            // 3. Başarılı giriş sonrası, session fixation ataklarına karşı oturumu yenile
            $request->session()->regenerate();

            // 4. Yönlendirme işlemini ayrı bir metod üzerinden yap
            return redirect()->route('redirect');
        }

        // 5. Giriş bilgileri yanlışsa tekrar login sayfasına, hata mesajı ile geri dön
        return back()->withErrors([
            'email' => 'E-posta veya parola hatalı.',
        ])->onlyInput('email');  // Sadece email alanını formda tut, parola alanı boş kalsın
    }

    /**
     * Giriş başarılı olduktan sonra kullanıcı rolüne göre uygun dashboard'a yönlendirir.
     * 
     * Bu metod, Auth::attempt() sonrası çalışır.
     * Kullanıcının rolüne göre uygun route'a yönlendirme yapar.
     * Geçersiz veya eksik rol varsa güvenlik için oturumu sonlandırır.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectAfterLogin()
    {
        // 1. Giriş yapan kullanıcıyı al
        $user = Auth::user();

        // 2. Kullanıcı admin ise admin dashboard'a yönlendir
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // 3. Kullanıcı normal kullanıcı ise user dashboard'a yönlendir
        if ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        // 4. Kullanıcının rolü tanımlı değilse çıkış yap ve login sayfasına yönlendir
        Auth::logout();

        return redirect()->route('login')->withErrors([
            'role' => 'Rolünüz sistemde tanımlı değil.',
        ]);
    }

    /**
     * Kullanıcı oturumunu güvenli bir şekilde sonlandırır (çıkış yapar).
     * 
     * Bu metod genellikle üst menüdeki "Çıkış" bağlantısından tetiklenir.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // 1. Kullanıcıyı çıkış yaptır
        Auth::logout();

        // 2. Oturum verilerini temizle
        request()->session()->invalidate();

        // 3. CSRF token'ı yenile (güvenlik için)
        request()->session()->regenerateToken();

        // 4. Login sayfasına yönlendir ve bilgi mesajı göster
        return redirect()->route('login')->with('status', 'Oturum başarıyla kapatıldı.');
    }
}
