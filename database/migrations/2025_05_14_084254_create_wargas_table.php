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
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable(false);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_kematian')->nullable();
            $table->string('alamat')->nullable(false);
            $table->enum('status_keluarga', [
                'kepala keluarga',
                'istri',
                'anak',
                'orang tua',
                'mertua',
                'cucu',
                'menantu',
                'paman',
                'bibi',
                'pembantu',
                'keponakan',
                'sepupu',
                'lainnya'
            ])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('agama', [
                'islam',
                'kristen',
                'katolik',
                'buddha',
                'hindu',
                'konghucu',
                'lainnya'
            ])->nullable();
            $table->enum('status_perkawinan', [
                'belum kawin',
                'kawin',
                'cerai hidup',
                'cerai mati'
            ])->nullable();
            $table->enum('pendidikan', [
                'tidak sekolah',
                'paud',
                'tk',
                'sd/sederajat',
                'smp/sederajat',
                'sma/sederajat',
                'diploma',
                'sarjana',
                'pascasarjana',
                'lainnya'
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
