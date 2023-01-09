<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommoditySupply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','entry_date','fiscal_year_id','item_id','unit_id','opening','productive','import','export','consumption','remarks','closing'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
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
