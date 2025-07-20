<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Kayıt formunu gösterir.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Yeni kullanıcıyı kaydeder.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Kullanıcıdan gelen verileri doğrula
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . User::class, // Email benzersiz olmalı
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Yeni kullanıcı oluştur ve şifreyi hash'le
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Varsayılan rol: user
        ]);

        // Kayıt olayını tetikle (ör. e-posta doğrulama için)
        event(new Registered($user));

        // Kullanıcıyı otomatik giriş yap
        Auth::login($user);

        // Kullanıcının rolüne göre farklı dashboardlara yönlendirme yap
        if ($user->role === 'admin') {
            // Eğer kullanıcı admin ise admin dashboard'a gönder
            return redirect()->route('admin.dashboard');
        } else {
            // Eğer admin değilse user dashboard'a gönder
            return redirect()->route('user.dashboard');
        }
    }
}
