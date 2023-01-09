<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalLevelTraining extends Model
{
    use HasFactory;

    protected $table = 'local_level_training';
    protected $guarded = ['id'];

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class, 'training_type_id', 'id');
    }


}
