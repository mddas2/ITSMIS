<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryAndPrivateSectorProduction extends Model
{
    use HasFactory;

    protected $table = 'industrial_private_sector_production';
    protected $guarded = ['id'];

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'item_category_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\MeasurementUnit', 'quantity_unit', 'id');
    }
}
