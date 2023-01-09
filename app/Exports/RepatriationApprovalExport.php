<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class RepatriationApprovalExport implements FromView, WithEvents, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function view(): View
    {
        if ($this->type == "sample") {
            return view('pages.sample_excel.doi_repatriation_approval');
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
