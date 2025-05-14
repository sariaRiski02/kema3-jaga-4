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
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->date('tanggal_kematian');
            $table->string('alamat');
            $table->enum('status_keluarga', [
                'Kepala Keluarga',
                'Istri',
                'Anak',
                'Orang Tua',
                'Mertua',
                'Cucu',
                'Menantu',
                'Paman',
                'Bibi',
                'Pembantu',
                'Keponakan',
                'Sepupu',
                'Lainnya'
            ]);
            $table->string('pekerjaan');
            $table->enum('agama', [
                'Islam',
                'Kristen',
                'Buddha',
                'Hindu',
                'Konghuchu',
                'Lainnya'
            ]);
            $table->enum('status_perkawinan', [
                'Belum Kawin',
                'Kawin',
                'Cerai Hidup',
                'Cerai Mati'
            ]);
            $table->foreignId('kk_id')
                ->constrained('kk')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
