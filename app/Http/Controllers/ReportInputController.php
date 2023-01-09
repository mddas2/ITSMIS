<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiscalYear;
use App\Models\MonthlyProgressReportIndustry;
use App\Models\Industry;
use App\Models\DisaggregatedDataIndustry;
use App\Models\DisaggregatedDataClassification;
use App\Models\MonthlyProgressReportOcr;
use App\Models\IndicatorOcr;
use App\Models\DisaggregatedDataOcr;
use App\Models\TrainingType;
use App\Models\MonthlyTrainingReport;
use App\Models\AreawiseTrainingReport;
use App\Models\DemographicWiseTraining;
use App\Models\TrainingAttendeesReport;
use App\Models\CorporateSocialResponsibilityReport;
use App\Models\SocialFunction;
use App\Models\Hierarchy;
use App\Models\Item;
use Auth;
class ReportInputController extends Controller
{
    private $_app = "";
    private $_page = "pages.report_input.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Report Input';
    }

    public function monthlyProgressReportIndustry(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['industryData'] = [];
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $reports = MonthlyProgressReportIndustry::where('fiscal_year_id',$request->fiscal_year_id)->get();
            $industries = Industry::all();

            $reportData = [];
            $industryData = [];

            foreach ($reports as $report) {
                $reportData[$report->industry_id] = $report;
            }

            foreach($industries as $key=>$industry) {
                $industryData[$key]['id'] = isset($reportData[$industry->id])?$reportData[$industry->id]['id']:'';
                $industryData[$key]['name'] = $industry->name;
                $industryData[$key]['industry_id'] = $industry->id;
                $industryData[$key]['number'] = isset($reportData[$industry->id])?$reportData[$industry->id]['number']:'';
                $industryData[$key]['progress'] = isset($reportData[$industry->id])?$reportData[$industry->id]['progress']:'';
            }

            $this->_data['industryData'] = $industryData;
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['currentDate'] = app(UtilController::class)->getCurrentNepaliDate();

        return view($this->_page . 'monthly_progress_report_industry', $this->_data);
    }

    public function monthlyProgressReportIndustryAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            if (!empty($data['id']) || !empty($data['name'])) {
                $data['fiscal_year_id'] = $request->fiscal_year_id;
                if (empty($data['industry_id'])) {
                    $industry = Industry::create(['name' => $data['name']]);
                    $data['industry_id'] = $industry->id;
                } 
                $data['user_id'] = Auth::user()->id;
                MonthlyProgressReportIndustry::updateOrCreate(
                   ['id' => $data['id']],
                   $data
                ); 
            }
        }

        return redirect()->route('monthly-progress-report-industries',['fiscal_year_id' => $request->fiscal_year_id])->with('success', 'Your Information has been Added .');
    }

    public function getMonthlyProgressReport(Request $request)
    {
        $this->_data['hierarchy_id'] = "";
        $this->_data['user_id'] = "";
        $this->_data['item_id'] = "";
        $this->_data['fiscal_year_id'] = "";

        $query = MonthlyProgressReportIndustry::query();
        if ($request->has('user_id')  && !empty($request->user_id)) {
            $this->_data['hierarchy_id'] = $request->hierarchy_id;
            $this->_data['user_id'] = $request->user_id;
            $query->where('user_id',$request->user_id);
        }

        if ($request->has('fiscal_year_id') && !empty($request->fiscal_year_id)) {
            $this->_data['fiscal_year_id'] = $request->fiscal_year_id;
            $query->where('fiscal_year_id',$request->fiscal_year_id);
        }
        $this->_data['data'] = $query->get();
        $list = ["" => "Select User Type"];
        $nodes = Hierarchy::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
            foreach ($categories as $category) {
                $list[$category->id] =  $prefix . ' ' . $category->name;
                $this->_data['hierarchyList'] = $list;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        return view($this->_page . 'get_monthly_progress_report', $this->_data);
    }

    public function disaggregatedDataIndustry(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['industrySize'] = "";
        $currentDate= app(UtilController::class)->getCurrentNepaliDate();
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id') && $request->has('industry_size')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $this->_data['industrySize'] = $request->industry_size;
            $this->_data['data'] = DisaggregatedDataIndustry::where('fiscal_year_id', $request->fiscal_year_id)->where('entry_date',$currentDate)->where('industry_size',$request->industry_size)->get();
        }
        $this->_data['fiscalYearId'] = $request->fiscal_year_id;
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['currentDate'] = $currentDate;
        return view($this->_page . 'disaggregated_data_industry', $this->_data);
    }

    public function disaggregatedDataIndustryAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['fiscal_year_id'] = $request->fiscal_year_id;
            $data['industry_size'] = $request->industry_size;
            $data['param'] = serialize($data['param']);
            $data['value'] = serialize($data['value']);
            $data['user_id'] = Auth::user()->id;

            DisaggregatedDataIndustry::updateOrCreate(
               ['id' => $data['id']],
               $data
            ); 
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function getDisaggregatedData(Request $request)
    {
        $this->_data['data'] = [];
        $this->_data['hierarchy_id'] = "";
        $this->_data['user_id'] = "";
        $this->_data['fiscal_year_id'] = "";
        $this->_data['industry_size'] = "";
        $isFilter = false;
        $query = DisaggregatedDataIndustry::query();
        if ($request->has('user_id') && !empty($request->user_id)) {
            $this->_data['hierarchy_id'] = $request->hierarchy_id;
            $this->_data['user_id'] = $request->user_id;
            $query->where('user_id',$request->user_id);
            $isFilter = true;
        }

        if ($request->has('fiscal_year_id') && !empty($request->fiscal_year_id)) {
            $this->_data['fiscal_year_id'] = $request->fiscal_year_id;
            $query->where('fiscal_year_id',$request->fiscal_year_id);
            $isFilter = true;
        }

        if ($request->has('industry_size') && !empty($request->industry_size)) {
            $this->_data['industry_size'] = $request->industry_size;
            $query->where('industry_size',$request->industry_size);
            $isFilter = true;
        }
        if ($isFilter) {
            $this->_data['data'] = $query->get();
        }
        
        $list = ["" => "Select User Type"];
        $nodes = Hierarchy::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
            foreach ($categories as $category) {
                $list[$category->id] =  $prefix . ' ' . $category->name;
                $this->_data['hierarchyList'] = $list;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        return view($this->_page . 'get_disaggregated_data', $this->_data);
    }

    public function corporateSocial(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['industrySize'] = "";
        $currentDate = app(UtilController::class)->getCurrentNepaliDate();
        $this->_data['currentDate'] = $currentDate;
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id') || $request->has('current_date')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            if ($request->has('current_date')) {
                $this->_data['currentDate'] = $currentDate = $request->current_date;
            } 
            
            $this->_data['data'] = CorporateSocialResponsibilityReport::where('fiscal_year_id', $request->fiscal_year_id)->where('entry_date',$currentDate)->get();
        }
        $this->_data['fiscalYearId'] = $request->fiscal_year_id;
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['industries'] = Industry::pluck('name','id')->prepend('Select Industry',"");
        $this->_data['socialFunction'] = SocialFunction::pluck('name','id')->prepend('Select Social Function',"");
        return view($this->_page . 'corporate_social_report', $this->_data);
    }

    public function corporateSocialAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['fiscal_year_id'] = $request->fiscal_year_id;
            if ($request->has('current_date')) {
                $data['entry_date'] = $request->current_date;
            } else {
                $data['entry_date'] = app(UtilController::class)->getCurrentNepaliDate();
            }
            $data['user_id'] = Auth::user()->id;
            CorporateSocialResponsibilityReport::updateOrCreate(
               ['id' => $data['id']],
               $data
            ); 
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function disaggregatedDataClassification(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['industrySize'] = "";
        $currentDate= app(UtilController::class)->getCurrentNepaliDate();
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id') && $request->has('industry_size')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $this->_data['industrySize'] = $request->industry_size;
            $this->_data['data'] = DisaggregatedDataClassification::where('fiscal_year_id', $request->fiscal_year_id)->where('entry_date',$currentDate)->where('industry_size',$request->industry_size)->first();
        }
        $this->_data['fiscalYearId'] = $request->fiscal_year_id;
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['currentDate'] = $currentDate;
        return view($this->_page . 'disaggregated_data_classification', $this->_data);
    }

    public function disaggregatedDataClassificationAction(Request $request)
    {
        $data['fiscal_year_id'] = $request['fiscal_year_id'];
        $data['industry_size'] = $request['industry_size'];
        $data['entry_date'] = $request['data']['entry_date'];
        $data['id'] = $request['data']['id'];
        $data['indicators'] = serialize($request['data']['indicators']);
        $data['total_no'] = serialize($request['data']['total_no']);
        $data['investment'] = serialize($request['data']['investment']);
        $data['user_id'] = Auth::user()->id;
        DisaggregatedDataClassification::updateOrCreate(
           ['id' => $data['id']],
           $data
        ); 
        
        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function monthlyProgressReportOcr(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $reports = MonthlyProgressReportOcr::where('fiscal_year_id',$request->fiscal_year_id)->get();
            $indicators = IndicatorOcr::all();

            $reportData = [];
            $data = [];

            foreach ($reports as $report) {
                $reportData[$report->indicators_id] = $report;
            }

            foreach($indicators as $key=>$indicator) {
                $data[$key]['id'] = isset($reportData[$indicator->id])?$reportData[$indicator->id]['id']:'';
                $data[$key]['name'] = $indicator->name;
                $data[$key]['indicators_id'] = $indicator->id;
                $data[$key]['number'] = isset($reportData[$indicator->id])?$reportData[$indicator->id]['number']:'';
                $data[$key]['progress'] = isset($reportData[$indicator->id])?$reportData[$indicator->id]['progress']:'';
            }

            $this->_data['data'] = $data;
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['currentDate'] = app(UtilController::class)->getCurrentNepaliDate();

        return view($this->_page . 'monthly_progress_report_ocr', $this->_data);
    }

    public function monthlyProgressReportOcrAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            if (!empty($data['id']) || !empty($data['name'])) {
                $data['fiscal_year_id'] = $request->fiscal_year_id;
                if (empty($data['indicators_id'])) {
                    $indicators = IndicatorOcr::create(['name' => $data['name']]);
                    $data['indicators_id'] = $indicators->id;
                } 
                $data['user_id'] = Auth::user()->id;
                MonthlyProgressReportOcr::updateOrCreate(
                   ['id' => $data['id']],
                   $data
                ); 
            }
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function disaggregatedDataOcr(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['companyType'] = "";
        $currentDate= app(UtilController::class)->getCurrentNepaliDate();
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id') && $request->has('company_type')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $this->_data['companyType'] = $request->company_type;
            $this->_data['data'] = DisaggregatedDataOcr::where('fiscal_year_id', $request->fiscal_year_id)->where('entry_date',$currentDate)->where('company_type',$request->company_type)->get();
        }
        $this->_data['fiscalYearId'] = $request->fiscal_year_id;
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['currentDate'] = $currentDate;
        return view($this->_page . 'disaggregated_data_ocr', $this->_data);
    }

    public function disaggregatedDataOcrAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['fiscal_year_id'] = $request->fiscal_year_id;
            $data['company_type'] = $request->company_type;
            $data['param'] = serialize($data['param']);
            $data['value'] = serialize($data['value']);
            $data['user_id'] = Auth::user()->id;
            DisaggregatedDataOcr::updateOrCreate(
               ['id' => $data['id']],
               $data
            ); 
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function monthlyTrainingReport(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['companyType'] = "";
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $report = MonthlyTrainingReport::where('fiscal_year_id',$request->fiscal_year_id)->get()->toArray();
            $reportData = [];
            foreach ($report as $r){
                $reportData[$r['training_type_id']] = $r;
            }

            $data =[];
            $training = TrainingType::where('types','monthly_report_training')->get()->toArray();
            foreach($training as $key=>$t) {
                $data[$key]['training_id'] = $t['id'];
                $data[$key]['name'] = $t['name'];
                $data[$key]['sub_training'] = "";
                if (!empty($t['sub_training'])) {
                    $data[$key]['sub_training'] = unserialize($t['sub_training']);
                }
                $data[$key]['report'] = [];
                if (isset($reportData[$t['id']])) {
                    $data[$key]['report']['id'] = $reportData[$t['id']]['id'];   
                    $data[$key]['report']['target'] = unserialize($reportData[$t['id']]['target']);
                    $data[$key]['report']['achievement'] = unserialize($reportData[$t['id']]['achievement']);
                    $data[$key]['report']['monthly_completed_report'] = unserialize($reportData[$t['id']]['monthly_completed_report']);
                    $data[$key]['report']['non_achieving_target_cause'] = unserialize($reportData[$t['id']]['non_achieving_target_cause']);
                    $data[$key]['report']['remarks'] = unserialize($reportData[$t['id']]['remarks']);    
                }
            }
            $this->_data['data'] = $data;
 
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');

        return view($this->_page . 'monthly_training_report', $this->_data);
    }

    public function monthlyTrainingReportAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['fiscal_year_id'] = $request->fiscal_year_id;
            $data['training_type_id'] = $data['training_type_id'];
            $data['target'] = serialize($data['target']);
            $data['achievement'] = serialize($data['achievement']);
            $data['monthly_completed_report'] = serialize($data['monthly_completed_report']);
            $data['non_achieving_target_cause'] = serialize($data['non_achieving_target_cause']);
            $data['remarks'] = serialize($data['remarks']);
            $data['user_id'] = Auth::user()->id;
            MonthlyTrainingReport::updateOrCreate(
               ['id' => $data['id']],
               $data
            ); 
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function areawiseTrainingReport(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['companyType'] = "";
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $report = AreawiseTrainingReport::where('fiscal_year_id',$request->fiscal_year_id)->get()->toArray();
            $reportData = [];
            foreach ($report as $r){
                $reportData[$r['training_type_id']] = $r;
            }
            $data =[];
            $training = TrainingType::where('types','area_wise_training')->get()->toArray();
            foreach($training as $key=>$t) {
                $data[$key]['training_id'] = $t['id'];
                $data[$key]['name'] = $t['name'];
                $data[$key]['sub_training'] = "";
                if (!empty($t['sub_training'])) {
                    $data[$key]['sub_training'] = unserialize($t['sub_training']);
                }
                $data[$key]['report'] = [];
                if (isset($reportData[$t['id']])) {
                    $data[$key]['report']['id'] = $reportData[$t['id']]['id'];   
                    $data[$key]['report']['target'] = unserialize($reportData[$t['id']]['target']);
                    $data[$key]['report']['achievement'] = unserialize($reportData[$t['id']]['achievement']);
                    $data[$key]['report']['monthly_completed_report'] = unserialize($reportData[$t['id']]['monthly_completed_report']);
                    $data[$key]['report']['non_achieving_target_cause'] = unserialize($reportData[$t['id']]['non_achieving_target_cause']);
                    $data[$key]['report']['remarks'] = unserialize($reportData[$t['id']]['remarks']);    
                }
            }
            $this->_data['data'] = $data;
 
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');

        return view($this->_page . 'areawise_training_report', $this->_data);
    }

    public function areawiseTrainingReportAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['fiscal_year_id'] = $request->fiscal_year_id;
            $data['training_type_id'] = $data['training_type_id'];
            $data['target'] = serialize($data['target']);
            $data['achievement'] = serialize($data['achievement']);
            $data['monthly_completed_report'] = serialize($data['monthly_completed_report']);
            $data['non_achieving_target_cause'] = serialize($data['non_achieving_target_cause']);
            $data['remarks'] = serialize($data['remarks']);
            $data['user_id'] = Auth::user()->id;
            AreawiseTrainingReport::updateOrCreate(
               ['id' => $data['id']],
               $data
            ); 
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function demoGraphicWiseTrainingReport(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $this->_data['data'] = DemographicWiseTraining::where('fiscal_year_id',$request->fiscal_year_id)->get()->toArray();
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');

        return view($this->_page . 'demographic_wise_training_report', $this->_data);
    }

    public function demoGraphicWiseTrainingReportAction(Request $request)
    {
        foreach($request->data as $data) {
          //   dd($data);
            if (!empty($data['name'])) {
                $data['fiscal_year_id'] = $request->fiscal_year_id;
                $data['achievement_segregation'] = serialize($data['achievement_segregation']);
                $data['user_id'] = Auth::user()->id;
                DemographicWiseTraining::updateOrCreate(
                   ['id' => $data['id']],
                   $data
                ); 
           }
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function trainingAttendeesReport(Request $request)
    {   
        $this->_data['fiscalYearId'] = "";
        $this->_data['data'] = [];
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $this->_data['data'] = TrainingAttendeesReport::where('fiscal_year_id',$request->fiscal_year_id)->get()->toArray();
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');

        return view($this->_page . 'training_attendees_report', $this->_data);
    }

    public function trainingAttendeesReportAction(Request $request)
    {
        foreach($request->data as $data) {
            if (!empty($data['name'])) {
                $data['fiscal_year_id'] = $request->fiscal_year_id;
                $data['attendes_report'] = serialize($data['attendes_report']);
                $data['user_id'] = Auth::user()->id;
                TrainingAttendeesReport::updateOrCreate(
                   ['id' => $data['id']],
                   $data
                ); 
           }
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }
}
