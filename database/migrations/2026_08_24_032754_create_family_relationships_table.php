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

        $relationships = [
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
                        'lainnya',
            ];
        Schema::create('family_relationships', function (Blueprint $table) use($relationships) {
            $table->id();
            $table->foreignId('family_id')->constrained('families')->cascadeOnDelete();
            $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
            $table->enum('family_relationship',$relationships);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_relationships');
    }
};
