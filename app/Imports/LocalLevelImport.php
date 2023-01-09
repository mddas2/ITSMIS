<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LocalLevelImport implements WithMultipleSheets
{
    public function __construct(  string $customType)
    {

        $this->customType = $customType;

    }

    public function sheets(): array
    {


        if ( $this->customType  == "training") {

            return [
                'Training' => new LLTChildSheetImport(),
            ];
        } elseif($this->customType  == "production") {
            return [
                'Production' => new LLPChildSheetImport(),
            ];
        }
    }


}
