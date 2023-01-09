<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentOfIndustry extends Model
{
    use HasFactory;

    protected $table = 'department_of_industries';
    protected $guarded = ['id'];
}
