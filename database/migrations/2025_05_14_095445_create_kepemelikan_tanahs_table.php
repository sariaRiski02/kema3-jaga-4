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
        Schema::create('kepemelikan_tanah', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tanah');
            $table->float('luas');
            $table->foreignId('warga_id')->constrained('warga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepemelikan_tanah');
    }
};
