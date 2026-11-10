<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Data montir internal, BUKAN akun login.
        Schema::create('montir', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon', 20)->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('montir');
    }
};
