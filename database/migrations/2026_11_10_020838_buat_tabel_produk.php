<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->restrictOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->text('keunggulan')->nullable();
            $table->decimal('harga', 12, 2);
            $table->decimal('harga_modal', 12, 2)->default(0);
            $table->unsignedInteger('stok')->default(0);
            $table->unsignedInteger('stok_minimum')->default(5);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('aktif');
            $table->index('harga');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
