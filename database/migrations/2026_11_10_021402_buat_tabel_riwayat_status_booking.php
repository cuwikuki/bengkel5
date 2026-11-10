<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_status_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking')->cascadeOnDelete();
            $table->string('status_awal', 30)->nullable();
            $table->string('status_akhir', 30);
            $table->text('catatan')->nullable();
            $table->foreignId('diubah_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_status_booking');
    }
};
