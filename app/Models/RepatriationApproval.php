<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepatriationApproval extends Model
{
    use HasFactory;

    protected $table = 'repatriation_approval';
    protected $guarded = ['id'];
}
