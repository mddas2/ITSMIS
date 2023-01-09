<?php

namespace App\Imports;

use App\Models\DepartmentOfCustom;
use App\Models\DepartmentOfIndustry;
use App\Models\FDIApporval;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DepartmentOfIndustryFDIApprovalImport implements ToModel
{


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FDIApporval([
            //
        ]);
    }


}
