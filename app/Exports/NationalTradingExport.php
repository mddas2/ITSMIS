<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class  NationalTradingExport implements FromArray, WithMultipleSheets
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
                new ChildNationalTradingExport($this->exportType, $this->customType)

            ];


        }


        return $sheets;
    }
}