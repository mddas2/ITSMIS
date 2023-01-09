<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'item_category_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\MeasurementUnit', 'measurement_unit_id', 'id');
    }
}
