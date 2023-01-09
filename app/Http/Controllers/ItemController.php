<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemController extends Controller
{
    private $_page = "pages.items.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Item';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = Item::all();
        return view($this->_page . 'index', $this->_data);
    }

    public function create()
    {
        $this->_data['categories'] = ItemCategory::pluck('name_np','id')->toArray();
        return view($this->_page.'create',$this->_data);
    }

    public function store(Request $request)
    {
        if (Item::create($request->all())) {
            return redirect()->route('items.index')->with('success', 'Your Information has been Added .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function edit($id)
    {
        $this->_data['categories'] = ItemCategory::pluck('name_np','id')->toArray();
        $this->_data['item'] = Item::findOrFail($id);
        return view($this->_page . 'edit', $this->_data);
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();

        $this->_data['item'] = Item::findOrFail($id);

        if ($this->_data['item']->update($input)) {
            return redirect()->route('items.index')->with('success', 'Your Information Updated .');
        }

        return redirect()->back()->with('fail', 'Information could not be added .');
    }


    public function destroy($id)
    {
        $data = Item::findOrFail($id);
        if ($data->delete()){
            return redirect()->back()->with('success', "Item has been removed.");
        }
        return redirect()->back()->with('fail', "Item could not be deleted.");
    }

    public function getCategoryByItem(Request $request)
    {
        $result = Item::findOrFail($request->itemID);
        $data['catId'] = $result->item_category_id;

        return response()->json($data);
    }


    public function getItemByCategory(Request $request)
    {
        $results = Item::where('item_category_id',$request->catId)->get();
        $html = '';
        foreach ($results as $result){
            $html = $html .'<option value="'.$result->id.'">'. $result->name_np .'</option>' ;
        }
        $data['html']=$html;
        return response()->json($data);
    }

}
