<?php

namespace App\Imports;

use App\Models\MonthlyProgressReportIndustry;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use App\Models\Industry;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MonthlyProgressReportIndustryImport implements ToCollection
{
    public function __construct(string $fiscalYearId)
    {
        $this->fiscalYearId = $fiscalYearId;
    }

    public function collection(Collection $rows)
    {
        $industry_id = [];
        foreach ($rows as $key => $row) {
            if ($key == 0) {
                foreach ($rows[0] as $cnt=>$industry) {
                    if (!empty($industry) && $cnt > 0) {
                        array_push($industry_id,Industry::where('name', 'like', '%' . $industry . '%')->pluck('id')->first());
                    }
                }
            } 

            if ($key > 1) {
                $industryUnitCount = 0;
                foreach ($industry_id as $industryId) {
                    $data['user_id'] = User::where('name', 'like', '%' . $row[0] . '%')->pluck('id')->first();
                    $data['fiscal_year_id'] = $this->fiscalYearId;
                    $data['entry_date'] = date('Y-m-d');
                    $data['industry_id'] = $industryId;
                    $data['number'] = $row[++$industryUnitCount];
                    $data['progress'] = $row[++$industryUnitCount];
                    MonthlyProgressReportIndustry::create($data);
                }
            }
        }
    }
}
