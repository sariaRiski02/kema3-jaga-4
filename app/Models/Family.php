<?php

namespace App\Models;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'family_number',
    ];

    public function familyRelationships(){
        return $this->hasMany(FamilyRelationship::class);
    }

    public function residents(){
        return $this->hasManyThrough(
            Resident::class, 
            FamilyRelationship::class, 
            'family_id',
            'id',
            'id',
            'resident_id'
        );
    }
}
