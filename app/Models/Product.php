<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'item_category_id', 'product_id', 'qty_available', 'unit', 'image', 'description'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Item', 'product_id', 'id');
    }

    public function measurementUnit()
    {
        return $this->belongsTo('App\Models\MeasurementUnit', 'unit', 'id');
    }

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'item_category_id', 'id');
    }
}
