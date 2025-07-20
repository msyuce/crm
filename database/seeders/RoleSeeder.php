<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin rolü: Tüm sistemin kontrolüne sahip olan kullanıcı
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        
        // Satış rolü: Müşteri yönetimi ve satış süreçlerinden sorumlu kullanıcı
        Role::firstOrCreate(['name' => 'satış', 'guard_name' => 'web']);
        
        // Teknik rolü: Sistem teknik yönetimi, bakım ve geliştirme işlemleri yapan kullanıcı
        Role::firstOrCreate(['name' => 'teknik', 'guard_name' => 'web']);
    }
}
