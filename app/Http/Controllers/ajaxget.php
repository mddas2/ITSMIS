<?php

namespace App\Http\Controllers;
use App\Models\District;
use App\Models\Province;
use App\Models\Municipality;

use Illuminate\Http\Request;

class ajaxget extends Controller
{
    public function getDistrict(request $request){
        $dist = Province::find($request['provience_id']);
        return $dist->getDistrictWithProvienceId;
        // return $request;
        // return District::where('province_id',$request['provience'])->get();
    }
    public function getMuncipality(request $request){
        $munci = District::find($request['district_id']);
        // return $munci;
        return $munci->getMuncipalityWithDistrictId;
    }    
}
