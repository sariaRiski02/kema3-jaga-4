<?php

namespace App\Models;

use App\Models\Family;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyRelationship extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyRelationshipFactory> */
    use HasFactory;

    protected $fillable = [
        'family_relationship',
        'family_id',
        'resident_id',
    ];

    public function family(){
        return $this->belongsTo(Family::class);
    }
    public function resident(){
        return $this->belongsTo(Resident::class);
    }
}
