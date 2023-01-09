<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Hierarchy extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        'name', 'parent_id'
    ];

    public function office()
    {
        return $this->hasMany('App\Models\Office','hierarchy_id','id');
    }
}
