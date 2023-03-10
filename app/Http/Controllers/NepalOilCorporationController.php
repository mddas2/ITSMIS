<?php

namespace App\Http\Controllers;

use App\Exports\NOCExport;
use App\Imports\DOIImport;
use App\Models\MeasurementUnit;
use Illuminate\Http\Request;
use App\Models\NepalOilCorporation;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemCategory;
use Auth;
use App\Models\Hierarchy;
use App\Models\Modulehascategory;
use App\Models\AccessLevel;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use GuzzleHttp\Client;
use Session;


class NepalOilCorporationController extends Controller
{
    private $_page = "pages.nepal_oil_corporation.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Nepal Oil Corporation';
        $this->_data['header'] = true;
    }

    public function importColumn()
    {
        return view($this->_page . 'import_column', $this->_data);
    }

    public function importColumnAction(Request $request)
    {
        $data = $request->except('_token');
        Schema::table('nepal_oil_corporations', function (Blueprint $table) use ($data) {
            if ($data['data_type'] == "String") {
                $table->string($data['column_name'],255)->nullable(); 
            } else if ($data['data_type'] == "Integer") {
                $table->integer($data['column_name'])->length(11)->nullable(); 
            } else {
                $table->text($data['column_name'])->nullable(); 
            }
        });
        return redirect()->back()->with('success', 'New Column has been Added .');
    }
    public function addNewOilConsumption(Request $request){
        
        $category_ids = Modulehascategory::where('module_id',4)->first();//oil module is 4
        if($category_ids == NULL){
            return "There is no any category added to oil module . Please go through Admin.";
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
        
        return view($this->_page . 'add_new_oil_consumption', $this->_data);
    }
    public function addOil(Request $request){
        
        $category_ids = Modulehascategory::where('module_id',4)->first();//oil module is 4
        if($category_ids == NULL){
            return "There is no any category added to oil module . Please go through Admin.";
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
        
        return view($this->_page . 'add_new_oil', $this->_data);
    }
    public function add(Request $request)
    {

        $category_ids = Modulehascategory::where('module_id',4)->first();//oil module is 4
        if($category_ids == NULL){
            return "There is no any category added to oil module . Please go through Admin.";
        }
        $category_ids = unserialize($category_ids->categories);    
        $category = ItemCategory::whereIn('id',$category_ids)->pluck('name_np', 'id')->toArray();
        // return $category;
    
        $query = NepalOilCorporation::query();

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
        $this->_data['category'] = $category;
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
        
        return view($this->_page . 'create', $this->_data);
        return view($this->_page . 'create', $this->_data);
    }

    public function addAction(Request $request)
    {
   
        $array_id = [];
    	foreach($request->data as $key=>$data) {
            $data['user_id'] = Auth::user()->id;
            $data['unit_id'] = 2;//2 is liter unit
           
            if (!empty($data['date'])) {
               // dd($data);
               $obj = NepalOilCorporation::updateOrCreate(
                   ['id' => $data['id']],
                   $data
                ); 
                $array_id[] = $obj->id;  
            }
        }
        Session::flash('ids',$array_id); 
        return redirect()->route('noc_add')->with('success', 'Your Information has been Added .');
    }

    public function excelDataInsert(Request $request)
    {
        return view($this->_page.'bulk_import');
    }

    public function excelDataInsertAction(Request $request,$type)
    {
        
        $data = Excel::toArray(new DOIImport(),$request->file('sample_excel'));

        $formatData = [];

            $heading = ['date','item_id','quantity','unit','import_cost','stock_date','stock_quantity','sales_quantity'];
            foreach ($data[0] as $key=>$row) {
                if ($key > 0 && !empty($row[0])) {
                    for ($i=0; $i < 8 ; $i++) {
                        if($i == 1){
                            $item = Item::where('name', $row[$i])->first();
                            $row[$i] = $item->id;
                        }
                        if($i == 3){
                            $unit = MeasurementUnit::where('name',$row[$i])->first();
                            $row[$i] = $unit->id;
                        }
                        $formatData[$key][$heading[$i]] = $row[$i];
                    }
                }
            }
            $this->_data['formatData'] = $formatData;
            $this->_data['items'] = Item::where('item_category_id',3)->pluck('name_np','id');
            $this->_data['units'] = MeasurementUnit::pluck('name','id')->toArray();
            $this->_data['type'] = $type;
            return view($this->_page . 'verify_excel_data', $this->_data);


    }

    public function getSample(Request $request,$type)
    {
        return Excel::download(new NOCExport("sample"), 'nepal_oil_corporation.xlsx');
    }
}
