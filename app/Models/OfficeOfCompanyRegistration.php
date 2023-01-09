<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOfCompanyRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','date','no_of_registered_company','types_of_company','revenue_raised'
    ];
}
