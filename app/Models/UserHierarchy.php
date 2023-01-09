<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHierarchy extends Model
{
    use HasFactory;

    public function hierarchies()
    {
        return $this->hasOne('App\Models\Hierarchy','hierarchy_id','id');
    }
}
