<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerimaan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemasok_id')->constrained('pemasok')->restrictOnDelete();
            $table->date('tanggal_terima');
            $table->string('nomor_nota')->nullable();
            $table->text('catatan')->nullable();
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('tanggal_terima');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerimaan_barang');
    }
};
