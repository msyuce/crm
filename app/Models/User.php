<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // HasRoles kaldırıldı

    /**
     * Toplu veri atamada (mass assignment) kullanılacak alanlar.
     * 
     * Buraya 'role' alanını ekliyoruz,
     * böylece User::create veya update işlemlerinde role atanabilir.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // role alanı burada kalıyor
    ];

    /**
     * Diziye dönüştürmede gizlenecek alanlar.
     * Örneğin, password ve remember_token güvenlik için gizlenir.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Alan dönüşümleri (casts).
     * 
     * 'password' burada hash'lenmiş olarak saklanır.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Kullanıcının admin olup olmadığını kontrol eder.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Kullanıcının normal kullanıcı (user) rolünde olup olmadığını kontrol eder.
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
}
