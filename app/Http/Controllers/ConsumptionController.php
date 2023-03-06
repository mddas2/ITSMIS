<?php

namespace App\Http\Controllers;

use App\Exports\LocalLevelExport;
use App\Exports\LocalLevelProductionExport;
use App\Imports\LocalLevelImport;
use App\Models\ItemCategory;
use App\Models\LocalLevelTraining;
use App\Models\Consumption;
use App\Models\TrainingType;
use Illuminate\Http\Request;
use App\Models\MeasurementUnit;
use App\Models\User;
use App\Models\Item;
use App\Models\Modulehascategory;
use Auth;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use GuzzleHttp\Client;

class ConsumptionController extends Controller
{
    private $_page = "pages.local_level.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Local Level Production';
        $this->_data['header'] = true;
    }
    public function OilConsusmptionAdd(Request $request)
    {
        $category_ids = Modulehascategory::where('module_id',4)->first();//oil module is 4
        $category_ids = unserialize($category_ids->categories);    
        $category = ItemCategory::whereIn('id',$category_ids)->pluck('name_np', 'id')->toArray();

        $query = Consumption::query()->whereIn('item_category_id',$category_ids);

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
        
        return view('pages.nepal_oil_corporation.consumption', $this->_data);
    }
    public function OiladdAction(Request $request)
    {
        // return $request;
   
        if(auth()->user()->role_id == 2 && $request->session()->has('provience_id') && $request->session()->has('district_id') && $request->session()->has('municipality_id')){  //admin        
            $provience_id = $request->session()->get('provience_id');
            $district_id = $request->session()->get('district_id');
            $municipality_id = $request->session()->get('municipality_id');
        }
        else{
            $provience_id = $request->user()->provience_id;
            $district_id = $request->user()->district_id;
            $municipality_id = $request->user()->municipality_id;
        }

        foreach ($request->data as $key => $data) {
            
            $data['provience_id'] = $provience_id;
            $data['district_id'] = $district_id;
            $data['municipality_id'] = $municipality_id; 

            $data['user_id'] = Auth::user()->id;

            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                Consumption::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
        // return redirect()->route('local_level_consumption_add')->with('success', 'Your Information has been Added .');
    }
    public function SaltConsusmptionAdd(Request $request)
    {
        $category_ids = Modulehascategory::where('module_id',4)->first();//oil module is 4
        $category_ids = unserialize($category_ids->categories);    
        $category = ItemCategory::whereIn('id',$category_ids)->pluck('name_np', 'id')->toArray();

        $query = Consumption::query()->whereIn('item_category_id',$category_ids);

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
        
        return view('pages.salt_trading_limited.consumption', $this->_data);
    }
    public function SaltConsumptionAddAction(Request $request)
    {
        // return $request;
   
        if(auth()->user()->role_id == 2 && $request->session()->has('provience_id') && $request->session()->has('district_id') && $request->session()->has('municipality_id')){  //admin        
            $provience_id = $request->session()->get('provience_id');
            $district_id = $request->session()->get('district_id');
            $municipality_id = $request->session()->get('municipality_id');
        }
        else{
            $provience_id = $request->user()->provience_id;
            $district_id = $request->user()->district_id;
            $municipality_id = $request->user()->municipality_id;
        }

        foreach ($request->data as $key => $data) {
            
            $data['provience_id'] = $provience_id;
            $data['district_id'] = $district_id;
            $data['municipality_id'] = $municipality_id; 

            $data['user_id'] = Auth::user()->id;

            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                Consumption::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
        // return redirect()->route('local_level_consumption_add')->with('success', 'Your Information has been Added .');
    }
    public function add(Request $request)
    {
        $query = Consumption::query();

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
        $this->_data['items'] = Item::pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name_np', 'id')->toArray();
        $this->_data['category'] = ItemCategory::pluck('name_np', 'id')->toArray();
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
        
        return view($this->_page . 'consumption', $this->_data);
    }


    public function addAction(Request $request)
    {
       

        if(auth()->user()->role_id == 2 && $request->session()->has('provience_id') && $request->session()->has('district_id') && $request->session()->has('municipality_id')){  //admin        
            $provience_id = $request->session()->get('provience_id');
            $district_id = $request->session()->get('district_id');
            $municipality_id = $request->session()->get('municipality_id');
        }
        else{
            $provience_id = $request->user()->provience_id;
            $district_id = $request->user()->district_id;
            $municipality_id = $request->user()->municipality_id;
        }

        foreach ($request->data as $key => $data) {
            
            $data['provience_id'] = $provience_id;
            $data['district_id'] = $district_id;
            $data['municipality_id'] = $municipality_id; 

            $data['user_id'] = Auth::user()->id;

            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                Consumption::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('local_level_consumption_add')->with('success', 'Your Information has been Added .');
    }

    public function productionExcel(Request $request)
    {
        return view($this->_page.'production_excel',$this->_data);
    }

    public function getProductionSample(Request $request,$type)
    {
        return Excel::download(new LocalLevelProductionExport("sample",$type), 'local_level_production.xlsx');
    }

    public function productionExcelAction (Request $request)
    {


        $data = Excel::toArray(new LocalLevelImport('production'),$request->file('sample_excel'));


        $formatData = [];
        $this->_data['items'] = Item::pluck('name', 'id')->skip(0)->take(10);
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['itemCategory'] = ItemCategory::pluck('name', 'id')->toArray();


        $this->_data['columns'] = $heading = Schema::getColumnListing('local_level_production');

        foreach ($heading as $key=>$head) {
            if(in_array($head, ['id','user_id','locked','created_at','updated_at'])) {
                unset($heading[$key]);
            }
        }
        $heading = array_values($heading);


        foreach ($data['Production'] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {

                for ($i = 0; $i < count($heading); $i++) {
                    if ($i == 1) {
                        $item = Item::where('name', $row[$i])->first();
                        $row[$i] = $item->id;
                    }
                    if ($i == 2) {
                        $itemCategory = ItemCategory::where('name', $row[$i])->first();


                        $row[$i] = $itemCategory->id;
                    }
                    if ($i == 4) {
                        $unit = MeasurementUnit::where('name', $row[$i])->first();
                        $row[$i] = $unit->id;
                    }
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;

        return view($this->_page . 'verify_production_registration', $this->_data);
    }



    public function addTraining(Request $request)
    {
        $query = LocalLevelTraining::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }



        if ($request->has('program_ne') && !empty($request->item_id)) {
            $query->where('program_ne', $request->item_id);
        }

        if ($request->has('training_type_id') && !empty($request->item_category_id)) {
            $query->where('training_type_id', $request->item_category_id);
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
        $this->_data['training_types'] = TrainingType::pluck('name_np', 'id')->toArray();
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

        return view($this->_page . 'training_create', $this->_data);
    }

    public function addTrainingAction(Request $request)
    {

        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                LocalLevelTraining::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('local_level_addTraining')->with('success', 'Your Information has been Added .');
    }

    public function trainingExcel(Request $request)
    {
        return view($this->_page.'training_excel',$this->_data);
    }

    public function getTrainingSample(Request $request,$type)
    {
        return Excel::download(new LocalLevelExport("sample",$type), 'local_level_training.xlsx');
    }

    public function trainingExcelAction (Request $request)
    {


        $data = Excel::toArray(new LocalLevelImport('training'),$request->file('sample_excel'));
        $formatData = [];
        $this->_data['columns'] = $heading = Schema::getColumnListing('local_level_training');

        foreach ($heading as $key=>$head) {
            if(in_array($head, ['id','user_id','locked','created_at','updated_at'])) {
                unset($heading[$key]);
            }
        }
        $heading = array_values($heading);


        foreach ($data['Training'] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {

                for ($i = 0; $i < count($heading); $i++) {

                    if ($i == 3) {
                        $trainingTypes = TrainingType::where('name', $row[$i])->first();

                        $row[$i] = $trainingTypes->id;
                    }

                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }
        $this->_data['formatData'] = $formatData;

        return view($this->_page . 'verify_training_registration', $this->_data);
    }
}
