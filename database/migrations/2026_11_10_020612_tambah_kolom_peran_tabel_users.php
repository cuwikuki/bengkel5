<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel `users` bawaan Laravel dipertahankan (name, email, password)
        // agar autentikasi Laravel berjalan tanpa konfigurasi tambahan.
        Schema::table('users', function (Blueprint $table) {
            $table->string('telepon', 20)->nullable()->after('email');
            $table->text('alamat')->nullable()->after('telepon');
            // owner | admin | pelanggan
            $table->string('peran', 20)->default('pelanggan')->after('password')->index();
            $table->boolean('aktif')->default(true)->after('peran');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['peran']);
            $table->dropSoftDeletes();
            $table->dropColumn(['telepon', 'alamat', 'peran', 'aktif']);
        });
    }
};
