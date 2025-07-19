<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Bu method, 'users' tablosuna 'is_active' adında bir BOOLEAN sütun ekler.
     * Bu sütun kullanıcı aktif mi değil mi bilgisini tutar.
     * Varsayılan olarak 'true' yani aktif gelir.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('email'); // 'email' sütunundan sonra eklenir
        });
    }

    /**
     * Reverse the migrations.
     *
     * Bu method, yukarıdaki işlemi geri alır. Yani 'is_active' sütununu siler.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
