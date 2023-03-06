<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulehascategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories',
        'module_id'
        // other fillable attributes go here...
    ];
}
