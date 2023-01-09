<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityRecommendation extends Model
{
    use HasFactory;

    protected $table = 'facility_recomendation';
    protected $guarded = ['id'];
}
