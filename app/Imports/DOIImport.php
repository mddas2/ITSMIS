<?php

namespace App\Imports;

use App\Models\DepartmentOfIndustry;
use App\Models\NepalOilCorporation;
use Maatwebsite\Excel\Concerns\ToModel;

class DOIImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DepartmentOfIndustry([
            //
        ]);
    }
}
