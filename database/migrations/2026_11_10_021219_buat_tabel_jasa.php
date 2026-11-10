<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jasa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_jasa_id')->constrained('kategori_jasa')->restrictOnDelete();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            // null = harga belum ditentukan, perlu dikonfirmasi Admin
            $table->decimal('harga', 12, 2)->nullable();
            $table->boolean('perlu_konfirmasi_harga')->default(false);
            $table->unsignedSmallInteger('durasi_menit')->default(60);
            $table->boolean('tersedia')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('tersedia');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jasa');
    }
};
