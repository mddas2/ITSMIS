<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'office';

    protected $fillable = [
        'hierarchy_id','province_id','district_id','municipality_id','name','code','address','phone_number'
    ];

    public function hierarchy()
    {
        return $this->belongsTo('App\Models\Hierarchy','hierarchy_id','id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User','office_id','id');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province','province_id','id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District','district_id','id');
    }

    public function initials(){
        $words = explode(" ", $this->name );
        $initials = null;
        foreach ($words as $key=>$w) {
            if ($key > 3) {
                break;
            }
            $initials .= $w[0];
        }
        return strtoupper($initials);
     }
}
