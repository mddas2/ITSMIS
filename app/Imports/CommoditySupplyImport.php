<?php

namespace App\Imports;

use App\Models\CommoditySupply;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CommoditySupplyImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct(string $fiscalYearId)
    {
        $this->fiscalYearId = $fiscalYearId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            

            if ($key > 1) {
                $data['user_id'] = User::where('name', 'like', '%' . $row[1] . '%')->pluck('id')->first();
                $data['item_id'] = Item::where('name', 'like', '%' . $row[0] . '%')->pluck('id')->first();
                $data['fiscal_year_id'] = $this->fiscalYearId;
                $data['entry_date'] = date('Y-m-d');
                $data['opening'] = $row[2];
                $data['productive'] = $row[3];
                $data['import'] = $row[4];
                $data['export'] = $row[5];
                $data['consumption'] = $row[6];
                $data['closing'] = $row[7];
                $data['remarks'] = $row[8];
                CommoditySupply::create($data);
            }
        }
    }
}
