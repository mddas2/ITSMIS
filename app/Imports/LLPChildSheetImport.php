<?php

namespace App\Imports;

use App\Models\FoodManagementTradingCo;
use App\Models\LocalProduction;
use Maatwebsite\Excel\Concerns\ToModel;

class LLPChildSheetImport implements  ToModel
{



    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new LocalProduction([
            //
        ]);
    }
}
