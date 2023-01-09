<?php

namespace App\Imports;

use App\Models\DepartmentOfCustom;
use App\Models\FoodManagementTradingCo;
use Maatwebsite\Excel\Concerns\ToModel;

class ChildCustomImport implements  ToModel
{



    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DepartmentOfCustom([
            //
        ]);
    }
}
