<?php

namespace App\Imports;

use App\Models\SaltTradingLimitedPurchase;
use App\Models\SaltTradingLimitedSales;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NationalTradingImport implements WithMultipleSheets
{
    public function __construct(  string $customType)
    {

        $this->customType = $customType;

    }

    public function sheets(): array
    {


        if ( $this->customType  == "purchase") {

            return [
                'Purchase' => new SaltTradingLimitedPurchase(),
            ];
        } elseif($this->customType  == "SalesStock") {
            return [
                'Sales&Stock' => new SaltTradingLimitedSales(),
            ];
        }
    }


}
