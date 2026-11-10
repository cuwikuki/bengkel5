<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutasi_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->restrictOnDelete();
            // masuk | keluar | penyesuaian | pesanan | pembatalan
            $table->string('tipe', 20);
            // bertanda: positif = stok bertambah, negatif = stok berkurang
            $table->integer('jumlah');
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');
            // referensi polimorfik (penerimaan_barang, pesanan, dll.)
            $table->nullableMorphs('referensi');
            $table->string('catatan')->nullable();
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['produk_id', 'created_at']);
            $table->index('tipe');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi_stok');
    }
};
