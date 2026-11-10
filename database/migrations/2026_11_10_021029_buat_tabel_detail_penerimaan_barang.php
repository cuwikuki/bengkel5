<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penerimaan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerimaan_barang_id')->constrained('penerimaan_barang')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk')->restrictOnDelete();
            $table->unsignedInteger('jumlah');
            $table->decimal('harga_modal', 12, 2)->default(0);
            $table->string('catatan_pemeriksaan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penerimaan_barang');
    }
};
