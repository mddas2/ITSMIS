<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class DepartmentOfCustom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "department_of_customs";
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function getCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory','category','id');
    }
    public function getItem()
    {
        return $this->belongsTo('App\Models\Item','item','id');
    }
}
