<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IEERelated extends Model
{
    use HasFactory;

    protected $table = 'iee_related';
    protected $guarded = ['id'];
}
