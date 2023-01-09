<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HipcTraining extends Model
{
    use HasFactory;

    protected $table = 'hipc_training';
    protected $guarded = ['id'];

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class, 'training_type_id', 'id');
    }


}
