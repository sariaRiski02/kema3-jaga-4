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

        $family_relationships = [
                        'kepala keluarga', 
                        'suami',
                        'istri',
                        'anak',
                        'orang tua',
                        'keponakan',
                        'saudara',
                        'sepupu',
                        'mertua',
                        'menantu',
                        'cucu',
                        'saudara',
                        'lainnya lain',
                        ];
        $education = [
                    'tidak sekolah',
                    'belum sekolah',
                    'sd/sederajat',
                    'smp/sederajat',
                    'sma/sederajat',
                    'sd', 
                    'smp', 
                    'sma', 
                    'diploma', 
                    'sarjana', 
                    'magister', 
                    'doktor',
                    'lainnya'
                ];

        Schema::create('residents', function (Blueprint $table) use ($family_relationships, $education) {
            $table->id();
            $table->string('name');
            $table->string('nik', 16)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->string('address')->nullable();
            $table->enum('family_relationship', $family_relationships)->nullable();
            $table->string('occupation')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->enum('education',$education)->nullable();
            $table->foreignId('family_id')->nullable()->constrained('families')->onDelete('set null');
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
