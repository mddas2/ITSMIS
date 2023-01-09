<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisaggregatedDataOcr extends Model
{
    use HasFactory;

    protected $table = "disaggregated_data_ocr";
    
    protected $fillable = [
        'user_id','entry_date','province','param','value','fiscal_year_id','company_type'
    ];
}
