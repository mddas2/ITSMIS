<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SaltTradingLimitedSales extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "salt_trading_limited_sales";
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
