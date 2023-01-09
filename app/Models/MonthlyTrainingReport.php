<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyTrainingReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','target','achievement','monthly_completed_report','non_achieving_target_cause','remarks','fiscal_year_id','training_type_id'
    ];
}
