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
            $table->boolean('sumur');
            $table->boolean('mata_air');
            $table->boolean('pdam');
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
        Schema::dropIfExists('penggunaan_air');
    }
};
