<?php

namespace App\Models;

use App\Models\Family;
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
        'family_relationship',
        'occupation',
        'religion',
        'marital_status',
        'education',
        'family_id',
        'gender',
    ];


    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date_of_birth ? $this->date_of_birth->diffInYears(now()) : null
        );
    }

}    
