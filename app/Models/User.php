<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Kullanıcının ait olduğu rolü almak için.
     * Bu yöntem aslında `HasRoles` trait'inin bir parçasıdır.
     * Ancak role'leri manuel bağlamamız gerekirse kullanılabilir.
     */
    // Bu fonksiyonu kaldırıyoruz çünkü Spatie'nin `HasRoles` trait'i zaten `role()` ilişkisinde işlem yapacaktır.
    // public function role()
    // {
    //     return $this->belongsTo(\Spatie\Permission\Models\Role::class);
    // }
}
