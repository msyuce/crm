<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Bu metod, veritabanındaki temel verileri doldurur. İlk olarak roller oluşturulacak, ardından
     * örnek bir kullanıcı oluşturulacak. Bu kullanıcıya belirli roller atanacaktır.
     */
    public function run(): void
    {
        // 1. Rolleri Seed Et
        // RoleSeeder sınıfını çağırarak, veritabanındaki rollerin oluşturulmasını sağlar.
        // Örneğin admin, satış ve teknik rollerini otomatik olarak oluşturacaktır.
        $this->call(RoleSeeder::class);

        // 2. Test Kullanıcısı Oluştur
        // `User::factory()->create()` metodu, veritabanına bir test kullanıcısı ekler.
        // Bu kullanıcıya "Test User" adı ve "test@example.com" e-posta adresi atanır.
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
