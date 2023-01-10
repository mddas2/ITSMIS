<?php

namespace App\Http\Controllers;
use App\Imports\IpRegistraionImport;
use App\Models\DepartmentOfCustom;
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
        return view('pages.forecast.index', $this->_data);
    }
    
    
}
