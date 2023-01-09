<?php

namespace App\Exports;

use App\Models\CommoditySupply;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\Item;
use App\Models\User;

class CommoditySupplyExport implements FromView,WithEvents  , WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function collection()
    {
        return CommoditySupply::all();
    }

    public function view(): View
    {
        if ($this->type == "sample") {
            return view('pages.sample_excel.commodity_supply_data', [
                'items' => Item::pluck('name')->skip(0)->take(10)->toArray()
            ]);
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


                $items = Item::pluck('name')->skip(0)->take(20)->toArray();
                $items = implode(",",$items);

                /** @var Sheet $sheet */
                $sheet = $event->sheet;
                $itemList = $items;
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
                $objValidation->setFormula1('"' . $itemList . '"');

                $users = User::pluck('name')->toArray();
                $users = implode(",",$users);
                $userList = $users;
                $objValidation = $sheet->getCell('B3')->getDataValidation();
                $objValidation = $sheet->getCell('B13')->getDataValidation();
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
