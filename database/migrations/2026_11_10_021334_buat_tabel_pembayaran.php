<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pembayaran SIMULASI (tanpa payment gateway sungguhan).
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->nullable()->constrained('pesanan')->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained('booking')->cascadeOnDelete();
            $table->string('metode', 50)->default('simulasi_transfer');
            $table->decimal('jumlah', 14, 2);
            // menunggu | lunas | gagal
            $table->string('status', 20)->default('menunggu');
            $table->string('nomor_bukti')->nullable()->unique();
            $table->dateTime('dibayar_pada')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('diverifikasi_pada')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
