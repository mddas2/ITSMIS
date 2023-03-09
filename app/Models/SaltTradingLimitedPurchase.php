<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SaltTradingLimitedPurchase extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "salt_trading_limited_purchase";
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function getSalt()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\MeasurementUnit', 'quantity_unit', 'id');
    }
}
