<?php

namespace App\Imports;

use App\Models\FoodManagementTradingCo;
use Maatwebsite\Excel\Concerns\ToModel;

class FMTChildSheetImport implements  ToModel
{



    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FoodManagementTradingCo([
            //
        ]);
    }
}
