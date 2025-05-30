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
            $table->boolean('minyak_tanah')->nullable();
            $table->boolean('kayu_bakar')->nullable();
            $table->boolean('gas')->nullable();
            $table->boolean('solar')->nullable();
            $table->boolean('lainnya')->nullable();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
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
