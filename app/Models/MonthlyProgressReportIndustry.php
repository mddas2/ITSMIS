<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyProgressReportIndustry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','entry_date','fiscal_year_id','industry_id','number','progress'
    ];

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }

    public function fiscalYear()
    {
        return $this->belongsTo('App\Models\FiscalYear', 'fiscal_year_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
