<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ChildItemsExport implements  FromView,WithTitle
{

    public function __construct(string $itemType)
    {
        $this->itemType = $itemType;


    }

    public function collection()
    {
        return Item::all();
    }


    public function title(): string
    {
        return 'Comodities';
    }

    public function view(): View
    {
        if($this->itemType == 'petroleum'){
            $items =  Item::where('item_category_id',3)->pluck('name')->toArray();
        }elseif ($this->itemType == 'all'){
            $items = Item::pluck('name')->toArray();
        }
        return view('pages.sample_excel.items', ['items' => $items ]);


    }

}