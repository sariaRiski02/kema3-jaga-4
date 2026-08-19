<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    /** @use HasFactory<\Database\Factories\ResidentFactory> */
    use HasFactory, SoftDeletes;

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

}
