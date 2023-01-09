<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateSocialResponsibilityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','entry_date','fiscal_year_id','social_function_id','industry_id','total_budget','net_expenditure'
    ];
}
