<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pesanan')->unique();
            $table->foreignId('pengguna_id')->constrained('users')->restrictOnDelete();
            // pasang_sendiri | jasa_montir
            $table->string('metode_pemasangan', 20)->default('pasang_sendiri');
            $table->decimal('subtotal_produk', 14, 2)->default(0);
            $table->decimal('subtotal_jasa', 14, 2)->default(0);
            $table->decimal('total_bayar', 14, 2)->default(0);
            // menunggu | lunas | gagal
            $table->string('status_pembayaran', 20)->default('menunggu');
            // menunggu_pembayaran | pembayaran_dikonfirmasi | diproses | siap | selesai | dibatalkan
            $table->string('status', 30)->default('menunggu_pembayaran');
            // penanda agar stok tidak dikurangi dua kali / dikembalikan dengan benar
            $table->boolean('stok_sudah_dikurangi')->default(false);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('status_pembayaran');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
