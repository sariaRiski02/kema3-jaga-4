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
        Schema::create('penggunaan_air', function (Blueprint $table) {
            $table->id();
            $table->boolean('sumur')->nullable();
            $table->boolean('mata_air')->nullable();
            $table->boolean('pdam')->nullable();
            $table->boolean('lainnya')->nullable();
            $table->foreignId('warga_id')->constrained('warga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_air');
    }
};
