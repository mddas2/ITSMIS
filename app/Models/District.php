<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;
use App\Models\Province;


class District extends Model
{
    use HasFactory;

 	protected $table = "districts";

     public function getMuncipalityWithDistrictId()
     {
         return $this->hasMany(Municipality::class,'district_id','id');
     }

     public function getProvince()
     {
         return $this->hasMany(Province::class,'province_id','province_id');
     }

}
