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
        Schema::create('penggunaan_bahan_bakar', function (Blueprint $table) {
            $table->id();
            $table->boolean('minyak_tanah');
            $table->boolean('kayu_bakar');
            $table->boolean('gas');
            $table->boolean('solar');
            $table->boolean('lainnya');
            $table->foreignId('warga_id')->constrained('warga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_bahan_bakar');
    }
};
