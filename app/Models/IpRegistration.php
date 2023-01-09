<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpRegistration extends Model
{
    use HasFactory;

    protected $table = 'ip_registration';
    protected $guarded = ['id'];
}
