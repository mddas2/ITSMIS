<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\MeasurementUnit;
use Illuminate\Http\Request;
use App\Models\ItemCategory;

class ItemCategoryController extends Controller
{
    private $_app = "";
    private $_page = "pages.item_category.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage ItemCategory';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = ItemCategory::all();
        return view($this->_page . 'index', $this->_data);
    }

    public function create(Request $request)
    {
        $this->_data['itemCategory'] = ItemCategory::pluck('name', 'id')->prepend("Select Item Category");
        $this->_data['item'] = Item::pluck('name', 'id')->prepend("Select Item");
        $this->_data['unit'] = MeasurementUnit::pluck('name', 'id')->prepend("Select Unit");
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        if (ItemCategory::create($request->all())) {
            return redirect()->route('item_categories.index')->with('success', 'Your Information has been Added .');
        }

    }

    public function edit($id)
    {

        $this->_data['category'] = ItemCategory::findOrFail($id);
        return view($this->_page . 'edit', $this->_data);
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();

        $this->_data['category'] = ItemCategory::findOrFail($id);

        if ($this->_data['category']->update($input)) {
            return redirect()->route('item_categories.index')->with('success', 'Your Information Updated .');
        }

        return redirect()->back()->with('fail', 'Information could not be added .');
    }


    public function destroy($id)
    {
        $data = ItemCategory::findOrFail($id);
        if ($data->delete()){
            return redirect()->back()->with('success', "Category has been removed.");
        }
        return redirect()->back()->with('fail', "Category could not be deleted.");
    }
}
