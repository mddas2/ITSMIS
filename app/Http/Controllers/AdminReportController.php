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

class AdminReportController extends Controller
{
    private $_page = "pages.admin_report.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Admin Report';
        $this->_data['header'] = true;
    }

    public function index()
    {
        return view($this->_page . 'index', $this->_data);
    }

    public function DOCSRPMarketMoniter(Request $request)
    {
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        return "Api Link broken error";
        $data = json_decode(file_get_contents('https://monitoring.doc.gov.np/Api/External/MonitoringReport/MOICS/007$@g@r255it9999xyzko893498hdjfyenx25846737982luvB/' . $this->_data['from_date'] . '/' . $this->_data['to_date'], false, stream_context_create($arrContextOptions)));
        $this->_data['data'] = $data;

        $frimTypeCount = [];
        $i = 0;
        foreach ($data as $key => $row) {

            $frimTypeCount[$i] = $row->firmType;
            $i++;
        }

        $this->_data['frimTypeCount'] = array_count_values($frimTypeCount);


        return view($this->_page . 'department_Of_market_monitoring', $this->_data);
    }

    public function DOCSRPFirmRegister(Request $request)
    {

        $this->_data['from_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $data = json_decode(file_get_contents('https://online.doc.gov.np/api/WebData/BanijyaFMISDateWiseSummary?appToken=IZ6Hpg&fromDate=' . $this->_data['from_date'] . '&toDate=' . $this->_data['to_date'] . ' ', false, stream_context_create($arrContextOptions)));

        $firmType = [];
        $i = 0;
        foreach ($data->TotalRecords as $firm) {
            $firmType [$i] = $firm->FirmType;
            $i++;
        }
        $this->_data['firmType'] = $firmType;
        $this->_data['data'] = $data;
        return view($this->_page . 'department_Of_firm_register', $this->_data);
    }

    public function ocr(Request $request)
    {
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        $nepFromDate = explode('-',$this->_data['from_date']);
        $fromDate = toEnglish($nepFromDate[0], $nepFromDate[1], $nepFromDate[2],'en');
        $engFromDate=  $fromDate['year'].'-'.$fromDate['month'].'-'.$fromDate['date'] ;
        $engFromDate = date('Y-m-d',strtotime($engFromDate));
        $engToDate  = $engFromDate ;


        if ($request->has('from_date')) {
            $nepFromDate = explode('-',$request->from_date);
            $fromDate = toEnglish($nepFromDate[0], $nepFromDate[1], $nepFromDate[2],'en');
            $engFromDate=  $fromDate['year'].'-'.$fromDate['month'].'-'.$fromDate['date'] ;
            $engFromDate = date('Y-m-d',strtotime($engFromDate));
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $nepFromDate = explode('-',$request->to_date);
            $toDate = toEnglish($nepFromDate[0], $nepFromDate[1], $nepFromDate[2],'en');
            $engToDate=  $toDate['year'].'-'.$toDate['month'].'-'.$toDate['date'] ;
            $engToDate = date('Y-m-d',strtotime($engToDate));

            $this->_data['to_date'] = $request->to_date;
        }


        $authResponse = Http::post('http://110.34.25.91:8080/api/auth/login', [
            'username' => 'ministry_user',
            'password' => '0(r_m!n!stry',
        ]);

        $headers = $authResponse->headers();
        $bearer_token = $headers['JwtToken']['0'];

        $get_response = Http::withToken($bearer_token)
            ->get('http://110.34.25.91:8080/api/data/ministry/' . $engFromDate . '/' .$engToDate. '');
        $this->_data['data'] = json_decode($get_response->body());


        return view($this->_page . 'ocr', $this->_data);
    }

    public function noc(Request $request)
    {
        $query = NepalOilCorporation::query();

        $this->_data['to_date'] = $this->_data['from_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();


        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        $this->_data['item_id'] = '';
        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
            $query->where('item_id', $request->item_id);
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


            $data = $query->latest()->take(100)->get();
        }

        $measurementUnit = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['measurementUnit'] = $measurementUnit;
        $this->_data['items'] = Item::where('item_category_id', 3)->pluck('name', 'id')->toArray();


        $this->_data['data'] = $data;
        return view($this->_page . 'noc', $this->_data);
    }

    public function foodManagement(Request $request)
    {

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


        return view($this->_page . 'food_management', $this->_data);
    }

    public function saltTrading(Request $request)
    {


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
            $data = SaltTradingLimitedPurchase::join('salt_trading_limited_sales as sales', 'sales.item_id', '=', 'salt_trading_limited_purchase.item_id')
                ->join('salt_trading_limited_sales as sDate', 'sDate.date', '=', 'salt_trading_limited_purchase.date')
                ->select('salt_trading_limited_purchase.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('salt_trading_limited_purchase.date', '>=', $this->_data['from_date'])
                ->where('salt_trading_limited_purchase.date', '<=', $this->_data['to_date'])
                ->where('salt_trading_limited_purchase.item_id', $request->item_id)
                ->orderBy('salt_trading_limited_purchase.date', 'asc')
                ->distinct()
                ->get();

        } elseif (!empty($request->has('from_date')) && !empty($request->has('to_date'))) {
            $data = SaltTradingLimitedPurchase::join('salt_trading_limited_sales as sales', 'sales.item_id', '=', 'salt_trading_limited_purchase.item_id')
                ->join('salt_trading_limited_sales as sDate', 'sDate.date', '=', 'salt_trading_limited_purchase.date')
                ->select('salt_trading_limited_purchase.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->where('salt_trading_limited_purchase.date', '>=', $this->_data['from_date'])
                ->where('salt_trading_limited_purchase.date', '<=', $this->_data['to_date'])
                ->orderBy('salt_trading_limited_purchase.date', 'asc')
                ->distinct()
                ->get();

        } else {
            $data = SaltTradingLimitedPurchase::join('salt_trading_limited_sales as sales', 'sales.item_id', '=', 'salt_trading_limited_purchase.item_id')
                ->join('salt_trading_limited_sales as sDate', 'sDate.date', '=', 'salt_trading_limited_purchase.date')
                ->select('salt_trading_limited_purchase.*', 'sales.date as salesDate', 'sales.stock_quantity', 'sales.sales_quantity')
                ->orderBy('salt_trading_limited_purchase.date', 'asc')
                ->distinct()
                ->latest()
                ->take(50)
                ->get();

        }


        $this->_data['items'] = Item::pluck('name', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['data'] = $data;


        return view($this->_page . 'salt_trading', $this->_data);
    }

    public function doc(Request $request, $type)
    {


        $this->_data['item'] = $request->item;
        $this->_data['custom_port'] = $request->customs;

        $this->_data['items'] = DepartmentOfCustom::select('item')->orderBy('item','asc')->distinct()->get();

        $this->_data['customs_ports'] = DepartmentOfCustom::select('customs')->orderBy('customs','asc')->distinct()->get();


        $query = DepartmentOfCustom::query();

        $this->_data['from_date'] = $this->_data['to_date'] = $today =  DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();




        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->item) {
            $this->_data['item'] = $request->item;
        }
        if (!empty( $request->customs)) {

            $this->_data['custom_port']= $request->customs;
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        if (!empty($request->customs)) {

            $query->where('customs',  $request->customs);
        }
        if (!empty($request->item)) {
            $query->where('item',  $request->item);
        }




        if ($request->has('from_date')) {
            if (!empty($request->from_date)) {
                $nepFromDate = explode('-',$request->from_date);
                $fromDate = toEnglish($nepFromDate[0], $nepFromDate[1], $nepFromDate[2],'en');
                $engFromDate=  $fromDate['year'].'-'.$fromDate['month'].'-'.$fromDate['date'] ;
                $engFromDate = date('Y-m-d',strtotime($engFromDate));
                $query->where('asmt_date', '>=', $engFromDate);

                $this->_data['from_date'] = $request->from_date;

            }
            if (!empty($request->to_date)) {

                $nepToDate = explode('-',$request->to_date);
                $toDate = toEnglish($nepToDate[0], $nepToDate[1], $nepToDate[2],'en');
                $engToDate=  $toDate['year'].'-'.$toDate['month'].'-'.$toDate['date'] ;
                $engToDate = date('Y-m-d',strtotime($engToDate));
                $query->where('asmt_date', '<=',$engToDate);

                $this->_data['to_date'] = $request->to_date;
            }


            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;

        $this->_data['type'] = $type;


        return view($this->_page . 'doc', $this->_data);
    }

    public function doi(Request $request)
    {
        $doi = DepartmentOfIndustry::query();
        $fdi = FDIApporval::query();
        $repatriation = RepatriationApproval::query();
        $ipRegistration = IpRegistration::query();
        $technology = TechnologyAggrementApproval::query();
        $facility = FacilityRecommendation::query();
        $ieeRelated = IEERelated::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $doi->where('date_of_registration', '>=', $this->_data['from_date']);
                $fdi->where('date_of_aproval', '>=', $this->_data['from_date']);
                $repatriation->where('date_of_approval', '>=', $this->_data['from_date']);
                $ipRegistration->where('date_of_registration', '>=', $this->_data['from_date']);
                $technology->where('date_of_approval', '>=', $this->_data['from_date']);
                $facility->where('date_of_recomendation', '>=', $this->_data['from_date']);
                $ieeRelated->where('date_of_approval', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $doi->where('date_of_registration', '<=', $this->_data['to_date']);
                $fdi->where('date_of_aproval', '<=', $this->_data['to_date']);
                $repatriation->where('date_of_approval', '<=', $this->_data['to_date']);
                $ipRegistration->where('date_of_registration', '<=', $this->_data['to_date']);
                $technology->where('date_of_approval', '<=', $this->_data['to_date']);
                $facility->where('date_of_recomendation', '<=', $this->_data['to_date']);
                $ieeRelated->where('date_of_approval', '<=', $this->_data['to_date']);
            }

            $doi = $doi->get();
            $fdi = $fdi->get();
            $repatriation = $repatriation->get();
            $ipRegistration = $ipRegistration->get();
            $technology = $technology->get();
            $facility = $facility->get();
            $ieeRelated = $ieeRelated->get();

        } else {


            $doi = $doi->latest()->take(50)->get();
            $fdi = $fdi->latest()->take(50)->get();
            $repatriation = $repatriation->latest()->take(50)->get();
            $ipRegistration = $ipRegistration->latest()->take(50)->get();
            $technology = $technology->latest()->take(50)->get();
            $facility = $facility->latest()->take(50)->get();
            $ieeRelated = $ieeRelated->latest()->take(50)->get();

        }

        $this->_data['doi'] = $doi;
        $this->_data['fdi'] = $fdi;
        $this->_data['repatriation'] = $repatriation;
        $this->_data['ipRegistration'] = $ipRegistration;
        $this->_data['technology'] = $technology;
        $this->_data['facility'] = $facility;
        $this->_data['ieeRelated'] = $ieeRelated;

        return view($this->_page . 'doi', $this->_data);
    }
}
