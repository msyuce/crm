<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role; // Rol modeli Spatie’dan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Kullanıcı listesi - kullanıcıları rolleriyle beraber getirir
    public function index()
    {
        $users = User::with('roles')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    // Yeni kullanıcı ekleme formu
    public function create()
    {
        $roles = Role::all(); // Tüm roller
        return view('admin.users.create', compact('roles'));
    }

    // Yeni kullanıcı kaydetme işlemi
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
            'password'  => Hash::make($validated['password']),
            'is_active' => $validated['is_active'] ?? false, // Checkbox'dan gelir, yoksa false
        ]);

        // Çoklu rol ataması - Spatie metodu
        $user->syncRoles($validated['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla eklendi.');
    }

    // Kullanıcı düzenleme formu
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles'); // İlişkili roller

        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Kullanıcı güncelleme işlemi
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
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Eğer şifre boş değilse güncelle
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->is_active = $validated['is_active'] ?? false;
        $user->save();

        // Roller güncelle
        $user->syncRoles($validated['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    // Kullanıcı silme işlemi
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Kullanıcı başarıyla silindi.');
    }
}
