<?php

namespace App\Exports;

use App\Models\DcscMarketMonitoring;
use App\Models\MeasurementUnit;
use App\Models\TrainingType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\Item;
use Illuminate\Support\Facades\Schema;

class LocalLevelExport implements FromView, WithEvents, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
    }

    public function __construct(string $type, string $exportType)
    {
        $this->type = $type;
        $this->exportType = $exportType;
    }

    public function view(): View
    {
        if ($this->type == "sample") {
            if ($this->exportType == "market_monitoring") {
                return view('pages.sample_excel.local_level_production', [
                    'columns' => Schema::getColumnListing('local_level_production')
                ]);
            }   else if ($this->exportType == "training") {
                return view('pages.sample_excel.local_level_training', [
                    'columns' => Schema::getColumnListing('local_level'),
                    'trainingTypes' => TrainingType::pluck('name')->toArray(),
                ]);
            }

        }
    }

    public
    function title(): string
    {
        return 'Training';
    }

    public
    function registerEvents(): array
    {
        if ($this->exportType == "training") {
            return [
                AfterSheet::class => function (AfterSheet $event) {
                    $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'E', 'F', 'G', 'H', 'I'];

                    foreach ($columns as $column) {
                        $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
                    }




                    $trainingTypes = TrainingType::pluck('name', 'id')->toArray();
                    $trainingTypes = implode(",", $trainingTypes);

                    /** @var Sheet $sheet */
                    $sheet = $event->sheet;


                    $trainingList = $trainingTypes;
                    // clone validation to remaining rows
                    for ($i = 2; $i <= 999; $i++) {
                        $objValidation = $sheet->getCell('D' . $i)->getDataValidation();
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
                        $objValidation->setFormula1('"' . $trainingList . '"');
                    }

                }
            ];
        }else{
            return [
                AfterSheet::class => function (AfterSheet $event) {
                    $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'E', 'F', 'G', 'H', 'I'];

                    foreach ($columns as $column) {
                        $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
                    }
                }
            ];
        }


    }
}
