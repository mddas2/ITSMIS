<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnologyAggrementApproval extends Model
{
    use HasFactory;

    protected $table = 'technology_transfer_approval';
    protected $guarded = ['id'];
}
