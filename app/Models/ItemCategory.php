<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Item;

class ItemCategory extends Model
{
    use HasFactory ;

    protected $guarded = ['id'];

    public function getItems()
    {
        return $this->belongsTo(Item::class, 'id', 'item_category_id');
    }
    
}
