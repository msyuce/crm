<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
     * Kullanıcı listesi - kullanıcıları rolleriyle beraber getirir
     * Kullanıcılar, 'roles' ilişkisi ile beraber getirilir ve sayfalama ile görüntülenir.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(15);  // Kullanıcıları ve rollerini alır
        return view('admin.users.index', compact('users'));  // Kullanıcıları admin kullanıcı listesi sayfasına gönderir
    }

    /*
     * Yeni kullanıcı ekleme formu
     * Kullanıcı eklemek için form sayfası gösterilir.
     * Tüm roller alınır ve view'a aktarılır.
     */
    public function create()
    {
        $roles = Role::all();  // Tüm roller alınır
        return view('admin.users.create', compact('roles'));  // Kullanıcıyı eklemek için form gösterilir
    }

    /*
     * Yeni kullanıcı kaydetme işlemi
     * Kullanıcıdan gelen form verileri doğrulanır ve veritabanına kaydedilir.
     * Kullanıcıya bir veya birden fazla rol atanır.
     */
    public function store(Request $request)
    {
        // Validation: Roller en az 1 adet seçilmeli, isim ve email zorunlu, email benzersiz,
        // şifre onaylaması var, is_active bool tipinde
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
            'roles'     => 'required|array',
            'roles.*'   => 'exists:roles,name',
            'is_active' => 'boolean',
        ]);

        // Yeni kullanıcı oluşturma
        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),  // Şifreyi hashleyerek kaydet
            'is_active' => $validated['is_active'] ?? false,  // Checkbox'dan gelir, yoksa false
        ]);
    }

    /*
     * Kullanıcı düzenleme formu
     * Mevcut kullanıcının bilgileri getirilir ve düzenleme formu gösterilir.
     * Kullanıcıya ait roller de view'a aktarılır.
     */
    public function edit(User $user)
    {
        $roles = Role::all();  // Tüm roller alınır
        $user->load('roles');  // Kullanıcıya ait roller yüklenir

        return view('admin.users.edit', compact('user', 'roles'));  // Kullanıcı düzenleme formu gösterilir
    }

    /*
     * Kullanıcı güncelleme işlemi
     * Kullanıcıdan gelen veriler doğrulanır ve mevcut kullanıcı bilgileri güncellenir.
     * Şifre boşsa güncellenmez, roller ve is_active durumu da güncellenir.
     */
    public function update(Request $request, User $user)
    {
        // Validation: email kendisi hariç benzersiz, şifre opsiyonel ve onaylı olmalı,
        // roller zorunlu ve is_active boolean
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|string|min:6|confirmed',
            'roles'     => 'required|array',
            'roles.*'   => 'exists:roles,name',
            'is_active' => 'boolean',
        ]);

        // Model alanları güncelle
        $user->name = $validated['name'];  // Kullanıcı adı güncellenir
        $user->email = $validated['email'];  // Kullanıcı e-mail adresi güncellenir

        // Eğer şifre boş değilse güncelle
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);  // Yeni şifre hash'lenerek kaydedilir
        }

        $user->is_active = $validated['is_active'] ?? false;  // Kullanıcı durumu güncellenir
        $user->save();  // Kullanıcı kaydedilir

        // Roller güncellenir
        $user->syncRoles($validated['roles']);  // Kullanıcıya yeni roller atanır

        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla güncellendi.');  // Kullanıcı başarıyla güncellenir, admin kullanıcı listesine yönlendirilir
    }

    /*
     * Kullanıcı silme işlemi
     * Kullanıcı silinir ve admin kullanıcı listesine yönlendirilir.
     */
    public function destroy(User $user)
    {
        $user->delete();  // Kullanıcı veritabanından silinir

        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla silindi.');  // Kullanıcı başarıyla silinir, admin kullanıcı listesine yönlendirilir
    }
}
