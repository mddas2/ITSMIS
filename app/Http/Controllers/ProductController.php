<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use App\Models\MeasurementUnit;

class ProductController extends Controller
{
    private $_app = "";
    private $_page = "pages.products.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Product';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = Product::all();
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
        if (Product::create($request->all())) {
            return redirect()->route('products.index')->with('success', 'Your Information has been Added .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }
}
