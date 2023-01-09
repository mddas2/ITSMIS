<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisaggregatedDataIndustry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','entry_date','province','param','value','fiscal_year_id','industry_size'
    ];

    public function fiscalYear()
    {
        return $this->belongsTo('App\Models\FiscalYear', 'fiscal_year_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
