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
        Schema::create('wc_kamar_mandi', function (Blueprint $table) {
            $table->id();
            $table->boolean('ikut_lpm')->nullable();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wc_kamar_mandi');
    }
};
