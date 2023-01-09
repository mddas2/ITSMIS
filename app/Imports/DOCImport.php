<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DOCImport implements WithMultipleSheets
{
    public function __construct(  string $customType)
    {

        $this->customType = $customType;



    }

    public function sheets(): array
    {


        if ( $this->customType  == "Export") {

            return [
                'Export' => new ChildCustomImport(),
            ];
        } elseif($this->customType  == "Import") {

            return [
                'Import' => new ChildCustomImport(),
            ];
        }
    }


}
