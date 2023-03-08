<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class NepalOilCorporation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function getOil()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }
}
