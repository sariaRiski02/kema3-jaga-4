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
            $table->string('nama')->nullable(false);
            $table->string('nik')->unique()->index()->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable(false);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_kematian')->nullable();
            $table->string('alamat')->nullable(false);
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
            ])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('agama', [
                'Islam',
                'Kristen',
                'Buddha',
                'Hindu',
                'Konghucu',
                'Lainnya'
            ])->nullable();
            $table->enum('status_perkawinan', [
                'Belum Kawin',
                'Kawin',
                'Cerai Hidup',
                'Cerai Mati'
            ])->nullable();
            $table->enum('pendidikan', [
                'Tidak Sekolah',
                'PAUD',
                'TK',
                'SD',
                'SMP',
                'SMA',
                'Sarjana',
            ])->nullable(false);
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
