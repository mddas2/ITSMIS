<?php

namespace App\Imports;

use App\Models\DepartmentOfIndustry;
use App\Models\NepalOilCorporation;
use App\Models\RepatriationApproval;
use Maatwebsite\Excel\Concerns\ToModel;

class RepatriationApprovalImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new RepatriationApproval([
            //
        ]);
    }
}
