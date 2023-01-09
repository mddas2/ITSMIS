<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class  FMTExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function __construct(string $exportType, string $customType)
    {
        $this->exportType = $exportType;
        $this->customType = $customType;

    }

    public function array(): array
    {
        return $this->sheets;
    }


    public function sheets(): array
    {

        $itemType='all';
        if ($this->exportType == "sample") {


                $sheets = [
                    new ChildItemsExport($itemType),
                    new ChildFTMTExport($this->exportType, $this->customType)

                ];


        }


        return $sheets;
    }
}