<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalProduction extends Model
{
    use HasFactory;

    protected $table = 'local_level_production';
    protected $guarded = ['id'];

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'item_category_id', 'id');
    }
    public function getItem()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\MeasurementUnit', 'quantity_unit', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function getMunicipality()
    {
        return $this->belongsTo('App\Models\Municipality', 'municipality_id', 'municipality_id');
    }
    public function getDistrict()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }
}
