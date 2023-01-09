<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FMTImport implements WithMultipleSheets
{
    public function __construct(  string $customType)
    {

        $this->customType = $customType;

    }

    public function sheets(): array
    {


            if ( $this->customType  == "purchase") {

                return [
                    'Purchase' => new FMTChildSheetImport(),
                ];
            } elseif($this->customType  == "SalesStock") {
                return [
                    'Sales&Stock' => new FMTChildSheetImport(),
                ];
            }
    }


}
