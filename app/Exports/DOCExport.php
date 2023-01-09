<?php

namespace App\Exports;

use App\Models\MeasurementUnit;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;


class DOCExport  implements FromView, WithEvents, WithTitle
{
    protected $sheets;

    public function __construct(string $exportType, string $customType)
    {
        $this->exportType = $exportType;
        $this->customType = $customType;

    }

    public function title(): string
    {
        return 'bulkupload';
    }


    public function view(): View
    {
        if ($this->exportType == "sample") {
            if ($this->customType == "export_import") {
                return view('pages.sample_excel.permission_for_export_import');

            } else {
                return view('pages.sample_excel.department_of_custom', [
                    'customType' => $this->customType,
                    /*'items' => Item::pluck('name')->skip(0)->take(10)->toArray(),*/
                    'units' => MeasurementUnit::pluck('name', 'id')->toArray()
                ]);
            }

        }

    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $columns = ['A','B','C','D','E','F','G','H','E','F','G','H','I'];

                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
                }
            }
        ];
    }
}