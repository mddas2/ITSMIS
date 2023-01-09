<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisaggregatedDataClassification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','entry_date','indicators','total_no','investment','fiscal_year_id','industry_size'
    ];
}
