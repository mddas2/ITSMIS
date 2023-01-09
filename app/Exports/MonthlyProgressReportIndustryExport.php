<?php

namespace App\Exports;

use App\Models\MonthlyProgressReportIndustry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\Industry;
use App\Models\User;

class MonthlyProgressReportIndustryExport implements FromView,WithEvents  , WithTitle
{
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function collection()
    {
        return MonthlyProgressReportIndustry::all();
    }

    public function view(): View
    {
        if ($this->type == "sample") {
            return view('pages.sample_excel.monthly_progress_report_industry', [
                'indicators' => Industry::pluck('name')
            ]);
        }
        
    }

    public function title(): string
    {
        return 'bulkupload';
    }

    public function registerEvents(): array
    {

        //$event = $this->getEvent();
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $columns = ['A','B','C','D','E','F','G','H','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'];

                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(14);
                }

                $users = User::pluck('name')->toArray();
                $users = implode(",",$users);
                $sheet = $event->sheet;
                $userList = $users;
                $objValidation = $sheet->getCell('A3')->getDataValidation();
                $objValidation = $sheet->getCell('A13')->getDataValidation();
                $objValidation->setType(DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"' . $userList . '"');
            }
        ];
    }
}
