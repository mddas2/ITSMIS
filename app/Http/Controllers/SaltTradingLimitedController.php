<?php

namespace App\Http\Controllers;

use App\Exports\FMTExport;
use App\Exports\NationalTradingExport;
use App\Imports\FMTImport;
use App\Imports\NationalTradingImport;
use App\Models\FoodManagementTradingSales;
use App\Models\SaltTradingLimitedPurchase;
use App\Models\SaltTradingLimitedSales;
use Illuminate\Http\Request;
use App\Models\FoodManagementTradingCo;
use App\Models\MeasurementUnit;
use App\Models\User;
use App\Models\Modulehascategory;
use App\Models\ItemCategory;
use App\Models\Item;
use Auth;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use GuzzleHttp\Client;

class SaltTradingLimitedController extends Controller
{
    private $_page = "pages.salt_trading_limited.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Salt Trading Limited';
        $this->_data['header'] = true;
    }

    public function importColumn()
    {
        return view($this->_page . 'import_column', $this->_data);
    }


    public function AddSaltNew(Request $request){
    
        $category_ids = Modulehascategory::where('module_id',6)->first();//salt module is 4
        if($category_ids == NULL){
            return "There is no any category added to salt module . Please go through Admin.";
        }
        $category_ids = unserialize($category_ids->categories);    
        $category = ItemCategory::whereIn('id',$category_ids)->pluck('name_np', 'id')->toArray();

        

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('item_id') && !empty($request->item_id)) {
            $query->where('item_id', $request->item_id);
        }

        if ($request->has('item_category_id') && !empty($request->item_category_id)) {
            $query->where('item_category_id', $request->item_category_id);
        }

        if (auth()->user()->role_id == 3) {
            $query->where('user_id', auth()->user()->id);
        }

        

        //$this->_data['columns'] = Schema::getColumnListing('nepal_oil_corporations');
        $this->_data['items'] = Item::whereIn('item_category_id',$category_ids)->pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name_np', 'id')->toArray();
        $this->_data['category'] = $category;
  
        $this->_data['user'] = User::find(Auth::id());

        $hierarchyId = auth()->user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {
                    if ($key != count($parentHierarchy) - 1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ? ' -> ' : ' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }

                }
            }
        }
        
        return view($this->_page . 'add_new_salt', $this->_data);
    }

    public function add(Request $request, $type)
    {
        $category_ids = Modulehascategory::where('module_id',6)->first();//salt module is 6
        if($category_ids == NULL){
            return "There is no any category added to salt module . Please go through Admin.";
        }
        $category_ids = unserialize($category_ids->categories);    
        $category = ItemCategory::whereIn('id',$category_ids)->pluck('name_np', 'id')->toArray();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        $this->_data['type'] = $type;
        if ($type == 'purchase'){
            $query = SaltTradingLimitedPurchase::query();
        }else{
            $query = SaltTradingLimitedSales::query();
        }


        $this->_data['item_id'] = '';
        if ($request->has('item_id') && !empty($request->item_id)) {

            $this->_data['item_id'] = $request->item_id;
            $query->where('item_id', $request->item_id);
        }



        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        if (auth()->user()->role_id == 3) {
            $query->where('user_id', auth()->user()->id);
        }

        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }

        //$this->_data['columns'] = Schema::getColumnListing('nepal_oil_corporations');
        $this->_data['items'] = Item::whereIn('item_category_id',$category_ids)->pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name_np', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['user'] = User::find(Auth::id());

        $hierarchyId = auth()->user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {
                    if ($key != count($parentHierarchy) - 1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ? ' -> ' : ' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }

                }
            }
        }

        return view($this->_page . 'purchase', $this->_data);
    }

    public function addAction(Request $request, $type)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;
            $data['type'] = $type;
            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                if ($type == 'purchase'){
                    SaltTradingLimitedPurchase::updateOrCreate(
                        ['id' => $data['id']],
                        $data
                    );
                }else{
                    SaltTradingLimitedSales::updateOrCreate(
                        ['id' => $data['id']],
                        $data
                    );
                }

            }
        }

        return redirect()->route('salt_trading_add', $type)->with('success', 'Your Information has been Added .');
    }

    public function excelDataInsert(Request $request, $type)
    {
        $this->_data['type'] = $type;

        return view($this->_page . 'bulk_import', $this->_data);
    }

    public function excelDataInsertAction(Request $request, $type)
    {
        $data = Excel::toArray(new NationalTradingImport($type), $request->file('sample_excel'));

        $formatData = [];


        $this->_data['items'] = Item::pluck('name', 'id');
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['type'] = $type;


        if ($type == "purchase") {
            $heading = ['date', 'item_id',  'quantity_unit','quantity',];
            foreach ($data['Purchase'] as $key => $row) {
                if ($key > 0 && !empty($row[0])) {
                    for ($i = 0; $i < 4; $i++) {
                        if ($i == 1) {
                            $item = Item::where('name', $row[$i])->first();
                            $row[$i] = $item->id;
                        }
                        if ($i == 2) {
                            $unit = MeasurementUnit::where('name', $row[$i])->first();
                            $row[$i] = $unit->id;
                        }
                        $formatData[$key][$heading[$i]] = $row[$i];
                    }
                }
            }


            $this->_data['formatData'] = $formatData;

            return view($this->_page . 'verify_excel_data', $this->_data);
        } elseif ($type == "SalesStock") {

            $heading = ['date', 'item_id',  'quantity_unit',   'stock_quantity', 'sales_quantity'];

            foreach ($data['Sales&Stock'] as $key => $row) {
                if ($key > 0 && !empty($row[0])) {

                    for ($i = 0; $i < 5; $i++) {
                        if ($i == 1) {
                            $item = Item::where('name', $row[$i])->first();
                            $row[$i] = $item->id;
                        }
                        if ($i == 2) {
                            $unit = MeasurementUnit::where('name', $row[$i])->first();
                            $row[$i] = $unit->id;
                        }
                        $formatData[$key][$heading[$i]] = $row[$i];
                    }
                }
            }

            $this->_data['formatData'] = $formatData;

            return view($this->_page . 'verify_excel_data', $this->_data);
        }

    }

    public function getSample(Request $request, $type)
    {
        return Excel::download(new NationalTradingExport("sample", $type), 'salt_trading' . $type . '.xlsx');
    }
}
