<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jasa_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking')->cascadeOnDelete();
            $table->foreignId('jasa_id')->nullable()->constrained('jasa')->nullOnDelete();
            // snapshot nama, harga, dan durasi saat booking dibuat
            $table->string('nama_jasa');
            $table->decimal('harga', 12, 2)->default(0);
            $table->unsignedSmallInteger('durasi_menit')->default(60);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jasa_booking');
    }
};
