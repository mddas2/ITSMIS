<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemographicWiseTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','fiscal_year_id','name','achievement','achievement_segregation','remarks'
    ];
}
