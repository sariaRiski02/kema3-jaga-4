<?php

namespace App\Models;

use App\Models\Family;
use App\Models\FamilyRelationship;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    /** @use HasFactory<\Database\Factories\ResidentFactory> */
    use HasFactory, SoftDeletes;

    protected $appends = [
        'age',
    ];
    protected $fillable = [
        'name',
        'nik',
        'place_of_birth',
        'date_of_birth',
        'date_of_death',
        'address',
        'occupation',
        'religion',
        'marital_status',
        'education',
        'gender',
    ];


    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
    ];

    protected function age(): Attribute
    {
        return Attribute::make(
            get: function (){
                if(!$this->date_of_birth){
                    return null;
                }
                $diff = $this->date_of_birth->diff(now());

                return (object) [
                    'years' => $diff->y,
                    'months' => $diff->m,
                    'days' => $diff->d,
                ];
            }
        );
    }

    public function familyRelationship(){
        return $this->hasOne(FamilyRelationship::class);
    }

    public function family(){
        return $this->hasOneThrough(
            Family::class, 
            FamilyRelationship::class,
            'family_id',
            'id',
            'id',
            'resident_id'
        );
    }

}    
