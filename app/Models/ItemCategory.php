<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model
{
    use HasFactory ;

    protected $guarded = ['id'];

    public function getItems()
    {
        return $this->belongsTo('App\Models\Item', 'id', 'item_category_id');
    }
}
