<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_booking')->unique();
            $table->foreignId('pengguna_id')->constrained('users')->restrictOnDelete();
            // terisi jika booking berasal dari checkout produk
            $table->foreignId('pesanan_id')->nullable()->constrained('pesanan')->nullOnDelete();
            // bersama_pesanan | mandiri
            $table->string('jenis', 20)->default('mandiri');
            $table->foreignId('kendaraan_id')->nullable()->constrained('kendaraan')->nullOnDelete();
            // info aksesoris yang dibawa sendiri (booking mandiri)
            $table->text('info_barang_pelanggan')->nullable();
            $table->dateTime('jadwal_mulai');
            $table->dateTime('jadwal_selesai');
            $table->foreignId('montir_id')->nullable()->constrained('montir')->nullOnDelete();
            // diajukan | menunggu_konfirmasi | dikonfirmasi | menunggu_pengerjaan
            // | sedang_dikerjakan | selesai | dibatalkan | ditolak
            $table->string('status', 30)->default('diajukan');
            $table->decimal('total_harga_jasa', 14, 2)->default(0);
            $table->boolean('perlu_konfirmasi_harga')->default(false);
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('estimasi_selesai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index(['jadwal_mulai', 'jadwal_selesai']);
            $table->index(['montir_id', 'jadwal_mulai']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
