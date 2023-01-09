<?php

namespace App\Exports;

use App\Models\DcscMarketMonitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\Item;
use Illuminate\Support\Facades\Schema;

class DcscExport implements FromView, WithEvents, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function __construct(string $type,string $exportType)
    {
        $this->type = $type;
        $this->exportType = $exportType;
    }

    public function view(): View
    {
        if ($this->type == "sample") {
            if ($this->exportType == "market_monitoring") {
                return view('pages.sample_excel.dcsc_market_monitoring', [
                    'columns' => Schema::getColumnListing('dcsc_market_monitorings')
                ]);
            } else if ($this->exportType == "firm_registration") {
                return view('pages.sample_excel.dcsc_firm_registration', [
                    'columns' => Schema::getColumnListing('dcsc_firm_registrations')
                ]);
            }
        }
    }

    public function title(): string
    {
        return 'bulkupload';
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
