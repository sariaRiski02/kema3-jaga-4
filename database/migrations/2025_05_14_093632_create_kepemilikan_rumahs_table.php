<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kepemilikan_rumah', function (Blueprint $table) {
            $table->id();
            $table->enum('status_rumah', [
                'Milik Sendiri',
                'Sewa/Kontrak',
                'Rumah Dinas',
                'Menumpang',
                'Lainnya'
            ])->nullable();
            $table->enum('tipe_rumah', [
                'Permanen',
                'Semi Permanen',
                'Non Permanen',
                'Lainnya'
            ])->nullable();
            $table->foreignId('warga_id')->constrained('warga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepemilikan_rumah');
    }
};
