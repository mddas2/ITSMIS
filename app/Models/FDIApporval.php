<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FDIApporval extends Model
{
    use HasFactory;

    protected $table = 'fdi_approval';
    protected $guarded = ['id'];
}
