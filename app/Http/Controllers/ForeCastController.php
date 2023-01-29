<?php

namespace App\Http\Controllers;
use App\Imports\IpRegistraionImport;
use App\Models\DepartmentOfCustom;
use App\Models\LocalProduction;
use App\Models\Consumption;
use App\Models\DepartmentOfIndustry;
use App\Models\FacilityRecommendation;
use App\Models\FDIApporval;
use App\Models\FoodManagementTradingCo;
use App\Models\FoodManagementTradingSales;
use App\Models\IEERelated;
use App\Models\IpRegistration;
use App\Models\Item;
use App\Models\MeasurementUnit;
use App\Models\NepalOilCorporation;
use App\Models\RepatriationApproval;
use App\Models\SaltTradingLimitedPurchase;
use App\Models\TechnologyAggrementApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use NitishRajUprety\NepaliDateConverter\NepaliDateConverter;

// use Illuminate\Http\Request;

class ForeCastController extends Controller
{
    public function index(Request $request){

        
        if (!isset($request['item_id'])){
            $request['item_id'] = LocalProduction::all()->first()->item_id;
            $request['from_date'] = "2079-1-1";
            $request['to_date'] = "2079-12-32";
        }
        $monthly_data = $this->putMonthlyData($request);
        $this->_data['monthly_data'] = $monthly_data;

        $to_date = $request['to_date'];
        $year = explode("-", $to_date)[0];
        $this->_data['monthly_year'] = $year;
        $this->_data["item_name"] = Item::find($request['item_id']);
                

        $total_production = $this->getTotalProduction($request);
        // return $production;
        $total_consumption = $this->getTotalConsumption($request);

        $this->_data['total_production'] = $total_production;
        $this->_data['total_consumption'] = $total_consumption;


        // return $consumption;

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "central_analysis";
        // return print_r($this->_date)
        return view('pages.forecast.index', $this->_data);
    }
    public function ProvinceAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "province_analysis";
        return view('pages.forecast.index', $this->_data);
    }
    public function DistrictAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "district_analysis";
        return view('pages.forecast.index', $this->_data);
    }
    public function ProductionAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "production_analysis";
        return view('pages.forecast.index', $this->_data);
    }
    public function ConsumptionAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "consumption_analysis";
        return view('pages.forecast.index', $this->_data);
    }
    public function ImportAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "import_analysis";
        return view('pages.forecast.index', $this->_data);
    }
    public function ExportAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "export_analysis";
        return view('pages.forecast.index', $this->_data);
    }

    public function FutureAnalysis(Request $request){
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        if (!empty($request->has('from_date')) && !empty($request->has('to_date')) && !empty($this->_data['item_id'])) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->where('food_mgmt_trading_cos.item_id', $request->item_id)
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('food_mgmt_trading_cos.date', '>=', $this->_data['from_date'])
                ->where('food_mgmt_trading_cos.date', '<=', $this->_data['to_date'])
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = FoodManagementTradingCo::join('food_mgmt_trading_sales as sales', 'sales.item_id', '=', 'food_mgmt_trading_cos.item_id')
                ->join('food_mgmt_trading_sales as sDate', 'sDate.date', '=', 'food_mgmt_trading_cos.date')
                ->select('food_mgmt_trading_cos.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('food_mgmt_trading_cos.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();


        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;
        $this->_data['page_type'] = "export_analysis";
        return view('pages.forecast.index', $this->_data);
    }

    public function getTotalProduction($request){
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $item_id = $request['item_id'];
        $item_obj = LocalProduction::all()->where("item_id",$item_id)->whereBetween('date', [$from_date, $to_date])->sum("quantity"); 
   
        return $item_obj;
    }
    public function getTotalConsumption($request){
        $item_id = $request['item_id'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->whereBetween('date', [$from_date, $to_date])->sum("quantity"); 
        return $item_obj;
    }
    public function putMonthlyData($request){
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $year = explode("-", $to_date)[0];

        $item_id = $request['item_id'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->sum("quantity"); 

        $year_obj = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year);

        $monthly_data = [];
        $month_name = [
            1=>"Baisakh",
            2=>"Jestha",
            3=>"Ashad",
            4=>"Shrawan",
            5=>"Bhadra",
            6=>"Ashoj",
            7=>"Kartik",
            8=>"Mangsir",
            9=>"Poush",
            10=>"Magh",
            11=>"Falgun",
            12=>"Chaitra",
        ];

        for($month = 1; $month<=12; $month++){
            // $variable = "month_".$month;
            $monthly_data[$month_name[$month]] = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        }
        
        return $monthly_data;
    }
    public function AjaxgetMonthlyData(Request $request){

        $year = $request['year'];

        $item_id = $request['item_id'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->sum("quantity"); 

        $year_obj = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year);

        $monthly_data = [];
        $month_name = [
            1=>"Baisakh",
            2=>"Jestha",
            3=>"Ashad",
            4=>"Shrawan",
            5=>"Bhadra",
            6=>"Ashoj",
            7=>"Kartik",
            8=>"Mangsir",
            9=>"Poush",
            10=>"Magh",
            11=>"Falgun",
            12=>"Chaitra",
        ];

        for($month = 1; $month<=12; $month++){
            // $variable = "month_".$month;
            $monthly_data[$month] = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        }
        return $monthly_data;
    }
    public function AjaxGetYearlyData(Request $request){

        $year = $request['year'];

        $item_id = $request['item_id'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->sum("quantity"); 

        $year_obj = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year);

        // $monthly_data = [];
      

        // for($month = 1; $month<=12; $month++){
        //     // $variable = "month_".$month;
        //     $monthly_data[$month] = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        // }
        $data = [];
        $data[0] = array("y"=>2006,"a"=>100,"b"=>90,"c"=>60);
        $data[1] = array("y"=>2006,"a"=>100,"b"=>90,"c"=>60);
        $data[2] = array("y"=>2006,"a"=>100,"b"=>90,"c"=>60);
        $data[3] = array("y"=>2006,"a"=>100,"b"=>90,"c"=>60);
        $data[4] = array("y"=>2006,"a"=>100,"b"=>90,"c"=>60);
        return $data;
    }
    
}
