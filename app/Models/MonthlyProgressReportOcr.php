<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyProgressReportOcr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','entry_date','fiscal_year_id','indicators_id','number','progress'
    ];
}
