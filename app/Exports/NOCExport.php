<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\MeasurementUnit;
use App\Models\NepalOilCorporation;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class NOCExport implements FromView, WithEvents, WithTitle
{

    public function __construct(string $exportType)
    {
        $this->exportType = $exportType;


    }

    public function collection()
    {
        return NepalOilCorporation::all();
    }

    public function view(): View
    {
        if ($this->exportType == "sample") {

            return view('pages.sample_excel.nepal_oil_corporation', [

                'items' =>  Item::where('item_category_id',3)->pluck('name')->toArray(),
                'units' => MeasurementUnit::pluck('name', 'id')->toArray()
            ]);


        }

    }

    public function title(): string
    {
        return 'General';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'E', 'F', 'G', 'H', 'I'];

                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
                }




                $units = MeasurementUnit::pluck('name', 'id')->toArray();
                $units = implode(",", $units);

                /** @var Sheet $sheet */
                $sheet = $event->sheet;
                // $itemList = $items;
                // $objValidation = $sheet->getCell('A2')->getDataValidation();
                // $objValidation->setType(DataValidation::TYPE_LIST);
                // $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                // $objValidation->setAllowBlank(false);
                // $objValidation->setShowInputMessage(true);
                // $objValidation->setShowErrorMessage(true);
                // $objValidation->setShowDropDown(true);
                // $objValidation->setErrorTitle('Input error');
                // $objValidation->setError('Value is not in list.');
                // $objValidation->setPromptTitle('Pick from list');
                // $objValidation->setPrompt('Please pick a value from the drop-down list.');
                // $objValidation->setFormula1('"' . $itemList . '"');


                $unitList = $units;
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
                    $objValidation->setFormula1('"' . $unitList . '"');
                }


                $items =  Item::where('item_category_id',3)->pluck('name')->toArray();
                $items = implode(",", $items);
                $itemList = $items;

                for ($i = 2; $i <= 999; $i++) {
                    $objValidation = $sheet->getCell('B' . $i)->getDataValidation();
                    $objValidation->setType(DataValidation::TYPE_LIST);
                    $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a rank from the drop-down list.');
                    $objValidation->setFormula1('"' . $itemList . '"');
                }


            }
        ];


    }

}