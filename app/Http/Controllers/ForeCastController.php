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
use App\Models\ItemCategory;
use App\Models\Modulehascategory;
use App\Models\Province;
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
            $itm_obj = LocalProduction::all()->first();
            $request['item_id'] = $itm_obj->item_id;
            
            $currentDate = date('Y-m-d'); // current date in 'YYYY-MM-DD' format
            // return $currentDate; // output: current date in 'YYYY-MM-DD' format       

        }
        $converter = new NepaliDateConverter("en");
        $nepali_date = $converter->toNepali(date('20y'), date('m'), date('d'));
        $year = $nepali_date['year'];
        $request['from_date'] = $year."-"."04"."-"."01";
        $request['to_date'] = (intval($year)+1)."-"."03"."-"."32";

        $unit_is = Item::find($request['item_id'])->itemCategory->id;
        if($unit_is==3){
            $unit_is = "Liter";
        }
        else{
            $unit_is = "Kg";
        }
        $this->_data['unit_is'] = $unit_is;

        $to_date = $request['to_date'];
        $year = explode("-", $to_date)[0];
 
        $this->_data["item_name"] = Item::find($request['item_id']);
        $this->_data['category'] = ItemCategory::pluck('name_np', 'id')->toArray();
    

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
  
        $this->_data['ForecastIndex'] = "active";
        $items = $this->GetAvailableItems($request);
        // $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['items'] = $items;
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
        $this->_data['page_type'] = "forecast_all";
        // return print_r($this->_date)
        return view('pages.forecast.index', $this->_data);
    }
    public function central_analysis(Request $request){

        if (!isset($request['item_id'])){
            $itm_obj = LocalProduction::all()->first();
            $request['item_id'] = $itm_obj->item_id;

            $converter = new NepaliDateConverter("en");
            $nepali_date = $converter->toNepali(date('20y'), date('m'), date('d'));
            $year = $nepali_date['year'];
            $request['from_date'] = $year."-"."04"."-"."01";
            $request['to_date'] = (intval($year)+1)."-"."03"."-"."32";
        }
       else {
            $converter = new NepaliDateConverter("en");
            $nepali_date = $converter->toNepali(date('20y'), date('m'), date('d'));
            $year = $nepali_date['year'];
       }
       $this->_data['year'] = $year; 

        $unit_is = Item::find($request['item_id'])->itemCategory->id;
        if($unit_is==3){
            $unit_is = "Liter";
        }
        else{
            $unit_is = "Kg";
        }
        $this->_data['unit_is'] = $unit_is;

        $monthly_data = $this->putMonthlyData($request);
        
        $this->_data['monthly_data'] = $monthly_data;
        // return $monthly_data;

        $this->_data["item_name"] = Item::find($request['item_id']);
                

        $total_production = $this->getTotalProduction($request);
        $total_consumption = $this->getTotalConsumption($request);
        
        $previous_data = $this->getDataPreviousYear($request);
        $this->_data['previous_data'] = $previous_data;


        // $total_privious_year_production = $this->getTotalProductionPreviousYear($request);
        // $total_privious_year_consumption = $this->getTotalConsumptionPreviousYear($request);
 

        $this->_data['total_production'] = $total_production;
        $this->_data['total_consumption'] = $total_consumption;


        // return $consumption;

        // $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
       

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

 
        $this->_data['central_analysis'] = "active";
        $items = $this->GetAvailableItems($request);
        $this->_data['items'] = $items;
        $this->_data['category'] = ItemCategory::pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
        $this->_data['page_type'] = "central_analysis";
        // return print_r($this->_date)
        return view('pages.forecast.index', $this->_data);
    }
    public function ProvinceAnalysis(Request $request){
        if (!isset($request['item_id'])){
            $itm_obj = LocalProduction::all()->first();
            $request['item_id'] = $itm_obj->item_id;
            $converter = new NepaliDateConverter("en");
            $nepali_date = $converter->toNepali(date('20y'), date('m'), date('d'));
            $year = $nepali_date['year'];
            $request['from_date'] = $year."-"."04"."-"."01";
            $request['to_date'] = (intval($year)+1)."-"."03"."-"."32";
        }
       else {
            $converter = new NepaliDateConverter("en");
            $nepali_date = $converter->toNepali(date('20y'), date('m'), date('d'));
            $year = $nepali_date['year'];
       }

       $this->_data['year'] = $year; 
       
        $unit_is = Item::find($request['item_id'])->itemCategory->id;
        if($unit_is==3){
            $unit_is = "Liter";
        }
        else{
            $unit_is = "Kg";
        }
        $this->_data['unit_is'] = $unit_is;

        $to_date = $request['to_date'];
        $year = explode("-", $to_date)[0];
        $this->_data['monthly_year'] = $year;
        $this->_data["item_name"] = Item::find($request['item_id']);

        // $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        $provience_data = $this->getAllProvienceProduction($request);
        $this->_data['provience_data'] = $provience_data;

        $yearly_provience_data = $this->GetYearlyProvienceData($request);
        $this->_data['yearly_provience_data'] = $yearly_provience_data;

        $this->_data['item_id'] = '';


        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
        }

        $this->_data['ProvinceAnalysis'] = "active";
        // $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $items = $this->GetAvailableItems($request);
        $this->_data['category'] = ItemCategory::pluck('name_np', 'id')->toArray();
        $this->_data['items'] = $items;
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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

 

        $this->_data['DistrictAnalysis'] = "active";
        $this->_data['category'] = ItemCategory::pluck('name_np', 'id')->toArray();
        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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

 


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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

 


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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

 


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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

 


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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

 


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        
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
    public function getTotalConsumption($request){ //Monthly Report table
        $item_id = $request['item_id'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->whereBetween('date', [$from_date, $to_date])->sum("quantity"); 
        return $item_obj;
    }

    public function getDataPreviousYear($request){
        $from_date = $request['from_date'];
        $from_date = explode("-",$from_date);

        $previous_year = intval($from_date[0])-1;
        $start_date = $previous_year."-04-01";
        $end_date = ($previous_year+1)."-03-32";
  
        $item_id = $request['item_id'];
        $production = LocalProduction::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->sum("quantity"); 
        $consumption = Consumption::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->sum("quantity");
        $previous_data = array("previous_year"=>$previous_year,"prouction"=>$production,"consumption"=>$consumption);
        return $previous_data;
    }


    public function putMonthlyData($request){
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $year = explode("-", $from_date)[0];
        // return $year;

        $item_id = $request['item_id'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->sum("quantity"); 

        // $year_obj = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year);
     
        $year_obj = Consumption::where("item_id",$item_id)->whereBetween('date', [$from_date, $from_date]);

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

        for($month = 4; $month<=12; $month++){
            $monthly_data[$month_name[$month]] = LocalProduction::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        }
        $year = intval($year)+1;
        for($month = 1; $month<=3;$month++){
            $monthly_data[$month_name[$month]] = LocalProduction::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        }
        return $monthly_data;
    }
    public function AjaxgetMonthlyData(Request $request){ //Monthly Report

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

        for($month = 4; $month<=12; $month++){
            $monthly_data[$month-3] = LocalProduction::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        }
        $year = intval($year)+1;
        for($month = 1; $month<=3;$month++){
            $monthly_data[$month+9] = LocalProduction::where("item_id",$item_id)->whereYear('date', '=', $year)->whereMonth('date','=',$month)->get()->sum("quantity");
        }        
        return $monthly_data;
    }
    public function AjaxGetYearlyData(Request $request){

        $current_year = $request['year'];

        $item_id = $request['item_id'];
        $item_obj = Consumption::all()->where("item_id",$item_id)->sum("quantity"); 

        // $monthly_data = [];
      
        $data = [];
        for($year = 0; $year<=6; $year++){
            $year_status = $current_year-$year;

            $from_year = $year_status."-04-1";
            $to_year = ($year_status+1)."-03-32";

            $year_sum = LocalProduction::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
            $consusmption = Consumption::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");

            $data[$year] = array("y"=>$current_year-$year,"a"=>$year_sum,"b"=>$consusmption,"c"=>60);
        }
        return $data;
    }
    public function AjaxGetYearlyLineChartData(Request $request){ // Production Consumption Export/Import line Chart

        $current_year = $request['year'];

        $item_id = $request['item_id'];
        $category_id = Item::find($item_id)->itemCategory->id;
 
        // $monthly_data = [];
      
        $data = [];

        for($year = 0; $year<=6; $year++){

            if($category_id == 3 || $category_id == 12){

                $year_sum = 0;

                $start_year = intval($current_year)-$year;
                $start_date = $start_year."-04-03";
                $end_date = ($start_year+1)."-03-32";

                $consusmption = Consumption::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->get()->sum("quantity");
                if($category_id == 3){ //3 is oil
                    $import = NepalOilCorporation::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->get()->sum("quantity");
                    $opening = $this->OpeningLocalProductionCorpotation($start_date,$category_id,$item_id);
                }
                elseif($category_id == 12){//12 is petroilium
                    $import = SaltTradingLimitedPurchase::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->get()->sum("quantity");
                    $opening = $this->OpeningLocalProductionCorpotation($start_date,$category_id,$item_id);
                }
                else{
                    $import = 0;
                }                
               
                $export = DepartmentOfCustom::where("item",$item_id)->where("type","export")->whereBetween('asmt_date', [$start_date, $end_date])->get()->sum("quantity");
                $data[$year] = array("period"=>strval($current_year-$year),"opening"=>$opening,"Production"=>$year_sum,"Consumption"=>$consusmption,"import_export"=>60,"import"=>$import,"export"=>$export);

            }
            else{

                $start_year = intval($current_year)-$year;
                $start_date = $start_year."-04-03";
                $end_date = ($start_year+1)."-03-32";

                $year_sum = LocalProduction::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->get()->sum("quantity");
                $consusmption = Consumption::where("item_id",$item_id)->whereBetween('date', [$start_date, $end_date])->get()->sum("quantity");
                $opening = $this->OpeningLocalProduction($start_date,$item_id);
                $import = DepartmentOfCustom::where("item",$item_id)->where("type","import")->whereBetween('asmt_date', [$start_date, $end_date])->get()->sum("quantity");
                $export = DepartmentOfCustom::where("item",$item_id)->where("type","export")->whereBetween('asmt_date', [$start_date, $end_date])->get()->sum("quantity");
        
                $data[$year] = array("period"=>strval($current_year-$year),"opening"=>$opening,"from_date"=>$start_date,"end_date"=>$end_date,"Production"=>$year_sum,"Consumption"=>$consusmption,"import_export"=>60,"import"=>$import,"export"=>$export);
            }

            
        }

        return $data;
    }
    public function AjaxGetYearlyLineChartDataProvinceWise(Request $request){ // Production Consumption Export/Import line Chart

        $current_year = $request['year'];

        $item_id = $request['item_id'];
        $item_obj_p = LocalProduction::all()->where("item_id",$item_id); 
        $item_obj_c = Consumption::all()->where("item_id",$item_id); 


        // $monthly_data = [];
      
        $data = [];
        $proviences = Province::all();
        for($year = 0; $year<=6; $year++){
            $year_sum = LocalProduction::where("item_id",$item_id)->whereYear('date', '=', $current_year-$year)->get()->sum("quantity");

            $previous_data = array();
            foreach($proviences as $province){
                $previous_data["Provience-".$province->id] = LocalProduction::where("item_id",$item_id)->where('provience_id',$province->id)->whereYear('date', '=', $current_year-$year)->get()->sum("quantity");
            }
            $previous_data['period'] = strval($current_year-$year);
            $data[$year] = $previous_data;
        }
        return $data;
    }

    // '1' => '?????????????????? ???????????????',
    // '2' => '?????????????????????, ????????????????????? ??? ???????????????????????? ?????????????????? ????????????????????? ???????????????',
    // '3' => '?????????????????? ???????????????',
    // '4' => '??????????????? ????????? ????????????',
    // '5' => '??????????????? ?????????????????????????????? ??? ????????????????????? ??????????????????',
    // '6' => '??????????????? ????????????????????? ?????????????????????',
    // '7' => '????????????????????? ??????',
    // '8' => '?????????????????? ????????????????????? ????????????????????????',
    // '9' => '?????????????????? ???????????? - ?????? ????????? ???????????? ?????????????????? ????????????????????????',
    // '10' => '?????????????????? ???????????? - ??????????????????, ????????????????????? ????????? ???????????????????????? ????????????????????? ?????????????????????????????????',
    // '11' => '????????? ?????????????????? ?????????????????????????????? ?????????????????????',
    // '12' => '?????????????????? ??? ???????????? ?????????????????????',
    // '13' => '?????????????????? ??????????????????????????????????????? ????????????????????????',

    public function putAll_ItemProductionConsumptionCategory(Request $request){

        $from_year =  $request['year'];
        $split_year =  explode("-",$from_year);
        $to_year = (intval($split_year[0])+1)."-"."03"."-"."32";

        $category_id = $request['catId'];    
        $all_data_p_c = [];

        // $modules_obj = Modulehascategory::all();
        // foreach($modules_obj as $module){
        //     $module_has_categories = unserialize($module->categories);
        // } 

        if($category_id == 3 || $category_id == 12){
            $all_items = ItemCategory::where('id',$category_id)->first()->getItems()->get();
            foreach($all_items as $item){           
                
                if($category_id == 3){
                    $import = NepalOilCorporation::where("item_id",$item->id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
                    $opening = $this->OpeningLocalProductionCorpotation($from_year,$category_id,$item->id);//opening for this should be from Oil model and Salt::model
                }
                elseif($category_id == 12){
                    $import = SaltTradingLimitedPurchase::where("item_id",$item->id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
                    $opening = $this->OpeningLocalProductionCorpotation($from_year,$category_id,$item->id);//opening for this should be from Oil model and Salt::model
                }                
                if($import > 0){
                    $production = 0;
                    $consumption = Consumption::where("item_id",$item->id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");   
                    $export = DepartmentOfCustom::where("item",$item->id)->where("type","export")->whereBetween('asmt_date', [$from_year, $to_year])->get()->sum("quantity");
                    $record = array("obj" => $item,"production"=>$production,"opening"=>$opening,"consumption"=>$consumption,"import"=>$import,"export"=>$export);
                    $all_data_p_c[] = $record;
                }           
            }
        }
        else{
            $all_items = ItemCategory::where('id',$category_id)->first()->getItems()->get();
            foreach($all_items as $item){           
                $production = LocalProduction::where("item_id",$item->id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
                if($production > 0){
                    $consumption = Consumption::where("item_id",$item->id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
                    
                    $import = DepartmentOfCustom::where("item",$item->id)->where("type","import")->whereBetween('asmt_date', [$from_year, $to_year])->get()->sum("quantity");
                    $export = DepartmentOfCustom::where("item",$item->id)->where("type","export")->whereBetween('asmt_date', [$from_year, $to_year])->get()->sum("quantity");
                    $opening = $this->OpeningLocalProduction($from_year,$item->id);
                    $record = array("obj" => $item,"opening"=>$opening,"production"=>$production,"consumption"=>$consumption,"import"=>$import,"export"=>$export);
                    $all_data_p_c[] = $record;
                }           
            }
        }
  
        return $all_data_p_c;
    }
    public function FilterItem(Request $request){
 
        $from_year =  $request['year'];
        $split_year =  explode("-",$from_year);
        $to_year = (intval($split_year[0])+1)."-"."03"."-"."32";


        $category_id = $request['catId'];
        $item_id = $request['item_id'];
        // return $category_id;
        // return $request;
        // $converter = new NepaliDateConverter("en");
        // $nepali_date = $converter->toNepali(date('20y'), date('m'), date('d'));
        // $year = $nepali_date['year'];
     
        
        $all_data_p_c = [];
        if($category_id == 3 || $category_id == 12){            
                
            if($category_id == 3){
                $import = NepalOilCorporation::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
            }
            elseif($category_id == 12){
                $import = SaltTradingLimitedPurchase::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
            }          
            if($import > 0){
                $production = 0;
                $consumption = Consumption::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");   
                $export = 0;
                $opening = $this->OpeningLocalProduction($from_year,$item_id);//opening for this should be from Oil model and Salt::model
                $record = array("obj" =>Item::find($item_id),"opening"=>$opening,"production"=>$production,"consumption"=>$consumption,"import"=>$import,"export"=>$export);
                $all_data_p_c[] = $record;
            }           
           
        }
        else{
            $production = LocalProduction::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
            if($production > 0){
                $consumption = Consumption::where("item_id",$item_id)->whereBetween('date', [$from_year, $to_year])->get()->sum("quantity");
                
                $import = DepartmentOfCustom::where("item",$item_id)->where("type","import")->whereBetween('asmt_date', [$from_year, $to_year])->get()->sum("quantity");
                $export = DepartmentOfCustom::where("item",$item_id)->where("type","export")->whereBetween('asmt_date', [$from_year, $to_year])->get()->sum("quantity");
                $opening = $this->OpeningLocalProduction($from_year,$item_id);
                $record = array("obj" =>Item::find($item_id),"opening"=>$opening,"production"=>$production,"consumption"=>$consumption,"import"=>$import,"export"=>$export);
                $all_data_p_c[] = $record;
            }         
        }
  
        return $all_data_p_c;
    }

    public function getAllProvienceProduction($request){
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
      
        $item_id = $request['item_id'];
        $item_obj = LocalProduction::all()->where("item_id",$item_id)->whereBetween('date', [$from_date, $to_date])->sum("quantity"); 
    
        $proviences = Province::all();
        $provience_data = [];
        foreach($proviences as $provience){
            $production = LocalProduction::all()->where("item_id",$item_id)->where("provience_id",$provience->id)->whereBetween('date', [$from_date, $to_date])->sum("quantity");
            $consumption = Consumption::all()->where("item_id",$item_id)->where("provience_id",$provience->id)->whereBetween('date', [$from_date, $to_date])->sum("quantity");
            $p = array("production"=>$production,"consumption"=>$consumption);
            $provience_data["provience-".$provience->id] = $p;
        }
        // dd($provience_data);
        return $provience_data;
    }
    public function GetAvailableItems($request){
        $items = Item::all();
        $items_dict = array();
        foreach($items as $item){
            $localproduction = LocalProduction::all()->where("item_id",$item->id);
            if($localproduction->count()>0){
                $items_dict[$item->id] = $item->name_np;
            }
        }
        return $items_dict;
    }
    public function GetYearlyProvienceData($request){ // Production Consumption Export/Import line Chart
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $year = explode("-", $to_date)[0];
      
        $item_id = $request['item_id'];
   
        $proviences = Province::all();
        $yearly_data = [];
        for($i = 0; $i<5; $i++){
            $data = [];
            foreach($proviences as $provience){
                $production = LocalProduction::where("item_id",$item_id)->whereYear('date', '=', $year-$i)->where("provience_id",$provience->id)->get()->sum("quantity");
                $consumption = Consumption::where("item_id",$item_id)->whereYear('date', '=', $year-$i)->where("provience_id",$provience->id)->get()->sum("quantity");
                
                $data["provience-".$provience->id] = array("provience"=>$provience->id,"production"=>$production,"consumption"=>$consumption);
               
            }
            $yearly_data[$year-$i] = $data;
        }
        return $yearly_data;
    }

    public function OpeningLocalProduction($from_year,$item_id){
        $split_year =  intval(explode("-", $from_year)[0]);
        $previous_year = $split_year-1;
        $previous_from_year = $previous_year."-04-01";
        $previous_to_year = $split_year."-03-32";
        
        $production = LocalProduction::where("item_id",$item_id)->whereBetween('date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
        if($production > 0){
            $consumption = Consumption::where("item_id",$item_id)->whereBetween('date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
            
            $import = DepartmentOfCustom::where("item",$item_id)->where("type","import")->whereBetween('asmt_date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
            $export = DepartmentOfCustom::where("item",$item_id)->where("type","export")->whereBetween('asmt_date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
    
            $profit_loss = ($production + $import) - ($consumption+$export);
            return $profit_loss;
            
        } 
        return 0;
    }    
    public function OpeningLocalProductionCorpotation($from_year,$category_id,$item_id){
        $split_year =  intval(explode("-", $from_year)[0]);
        $previous_year = $split_year-1;
        $previous_from_year = $previous_year."-04-01";
        $previous_to_year = $split_year."-03-32";        

        if($category_id == 3){
            $import = NepalOilCorporation::where("item_id",$item_id)->whereBetween('date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
        }
        elseif($category_id == 12){
            $import = SaltTradingLimitedPurchase::where("item_id",$item_id)->whereBetween('date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
        }
        
        if($import > 0){
            $consumption = Consumption::where("item_id",$item_id)->whereBetween('date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
            $export = DepartmentOfCustom::where("item",$item_id)->where("type","export")->whereBetween('asmt_date', [$previous_from_year, $previous_to_year])->get()->sum("quantity");
            $production = 0;
            $profit_loss = ($production + $import) - ($consumption+$export);
            return $profit_loss;            
        } 
        return 0;

    }
    
    
}
