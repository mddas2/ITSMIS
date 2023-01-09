<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorOcr extends Model
{
    use HasFactory;

    protected $table = "indicators_ocr";

    protected $fillable = [
        'name'
    ];
}
