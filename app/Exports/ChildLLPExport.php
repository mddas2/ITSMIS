<?php

namespace App\Exports;

use App\Models\FoodManagementTradingCo;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\LocalProduction;
use App\Models\MeasurementUnit;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class ChildLLPExport implements FromView, WithEvents, WithTitle
{

    public function __construct(string $exportType, string $customType)
    {
        $this->exportType = $exportType;
        $this->customType = $customType;

    }

    public function collection()
    {
        return LocalProduction::all();
    }

    public function view(): View
    {
        if ($this->exportType == "sample") {
            if ($this->customType == "production") {
                return view('pages.sample_excel.local_level_production', [
                    'customType' => $this->customType,
                    'items' => Item::pluck('name')->skip(0)->take(10)->toArray(),
                    'itemCategory' => ItemCategory::pluck('name', 'id')->toArray(),
                    'units' => MeasurementUnit::pluck('name', 'id')->toArray()
                ]);

            }

        }

    }

    public function title(): string
    {

            return 'Production';

    }


    public
    function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'E', 'F', 'G', 'H', 'I'];

                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
                }

                $itemCount = count(Item::pluck('name'));
                $itemCount = $itemCount + 1;

                $itemCategory = ItemCategory::pluck('name', 'id')->toArray();
                $itemCategoryList = implode(",", $itemCategory);

                $items = Item::pluck('name', 'id')->toArray();
                $itemList = implode(",", $items);

                $units = MeasurementUnit::pluck('name', 'id')->toArray();
                $unitList = implode(",", $units);

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

                if ($this->exportType == "sample") {
                    if ($this->customType == "export_import") {


                    } else {
                        // clone validation to remaining rows
                        // for ($i = 2; $i <= $itemCount; $i++) {
                        //     $objValidation = $sheet->getCell('C' . $i)->getDataValidation();
                        //     $objValidation->setType(DataValidation::TYPE_LIST);
                        //     $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                        //     $objValidation->setAllowBlank(false);
                        //     $objValidation->setShowInputMessage(true);
                        //     $objValidation->setShowErrorMessage(true);
                        //     $objValidation->setShowDropDown(true);
                        //     $objValidation->setErrorTitle('Input error');
                        //     $objValidation->setError('Value is not in list.');
                        //     $objValidation->setPromptTitle('Pick from list');
                        //     $objValidation->setPrompt('Please pick a value from the drop-down list.');
                        //     $objValidation->setFormula1('"' . $itemCategoryList . '"');
                        // }
                        // for ($i = 2; $i <= $itemCount; $i++) {
                        //     $objValidation = $sheet->getCell('D' . $i)->getDataValidation();
                        //     $objValidation->setType(DataValidation::TYPE_LIST);
                        //     $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                        //     $objValidation->setAllowBlank(false);
                        //     $objValidation->setShowInputMessage(true);
                        //     $objValidation->setShowErrorMessage(true);
                        //     $objValidation->setShowDropDown(true);
                        //     $objValidation->setErrorTitle('Input error');
                        //     $objValidation->setError('Value is not in list.');
                        //     $objValidation->setPromptTitle('Pick from list');
                        //     $objValidation->setPrompt('Please pick a value from the drop-down list.');
                        //     $objValidation->setFormula1('"' . $itemCategoryList . '"');
                        // }
                        // clone validation to remaining rows
                        for ($i = 2; $i <= $itemCount; $i++) {
                            $objValidation = $sheet->getCell('G' . $i)->getDataValidation();
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
                            $objValidation->setFormula1('Comodities!A2:A' . $itemCount);
                        }
                    }

                }


            }
        ];


    }

}