<?php

namespace App\Http\Controllers;

use App\Exports\DepartmentOfIndustryFDIApprovalExport;
use App\Exports\FacilityRecommendationExport;
use App\Exports\IEERelatedExport;
use App\Exports\IpRegistraionExport;
use App\Exports\RepatriationApprovalExport;
use App\Exports\TechnologyAggrementApprovalExport;
use App\Imports\DepartmentOfIndustryFDIApprovalImport;
use App\Imports\DOIImport;
use App\Imports\FacilityRecommendationImport;
use App\Imports\IEERelatedImport;
use App\Imports\IpRegistraionImport;
use App\Imports\RepatriationApprovalImport;
use App\Imports\TechnologyAggrementApprovalImport;
use App\Models\FacilityRecommendation;
use App\Models\FDIApporval;
use App\Models\Hierarchy;
use App\Models\IEERelated;
use App\Models\IpRegistration;
use App\Models\RepatriationApproval;
use App\Models\TechnologyAggrementApproval;
use Illuminate\Http\Request;
use App\Models\DepartmentOfIndustry;
use Auth;
use DB;
use App\Exports\DepartmentOfIndustryExport;
use App\Imports\DepartmentOfIndustryImport;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentOfIndustryController extends Controller
{
    private $_page = "pages.department_of_industry.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Department Of Industry';
        $this->_data['header'] = true;
    }

    public function create(Request $request)
    {
        $query = DepartmentOfIndustry::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_registration', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_registration', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;


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
    }

    public function createAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            if (!empty($data['date'])) {
                DepartmentOfIndustry::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('department_of_industries')->with('success', 'Your Information has been Added .');
    }

    public function updateLock(Request $request)
    {
        $query = DepartmentOfIndustry::query();

        if ($request->has('entry_date')) {
            $query->where('date', $request->entry_date);
        }

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('department_of_industries')->with('success', 'Your Information has been Added .');
    }

    public function excelImport(Request $request)
    {
        return view($this->_page . 'import_excel', $this->_data);
    }

    public function excelSample(Request $request)
    {
        return Excel::download(new DepartmentOfIndustryExport("sample"), 'department_of_industry.xlsx');
    }

    public function excelImportAction(Request $request)
    {
        $data = Excel::toArray(new DOIImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_registration', 'name_of_industry', 'location', 'category', 'production_capacity', 'capacity_utilization', 'private_firm', 'proprietorship', 'company', 'fixed', 'working', 'male', 'female'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 13; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'verify_excel_data', $this->_data);
    }


    public function fdiApprovalCreate(Request $request)
    {
        $query = FDIApporval::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_aproval', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_aproval', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {
            $data = $query->latest()->take(20)->get();
        }

        $this->_data['data'] = $data;

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


        return view($this->_page . 'fdi_approval_create', $this->_data);
    }

    public function fdiApprovalCreateAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;
            if (!empty($data['date'])) {
                FDIApporval::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('fdi_approval')->with('success', 'Your Information has been Added .');
    }

    public function fdiApprovalUpdateLock(Request $request)
    {
        $query = FDIApporval::query();

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('fdi_approval')->with('success', 'Your Information has been Added .');
    }

    public function fdiApprovalExcelImport(Request $request)
    {
        return view($this->_page . 'fdi_approval_import_excel', $this->_data);
    }

    public function fdiApprovalExcelSample(Request $request)
    {
        return Excel::download(new DepartmentOfIndustryFDIApprovalExport("sample"), 'doi_fdi_approval.xlsx');
    }

    public function fdiApprovalExcelImportAction(Request $request)
    {
        $data = Excel::toArray(new DepartmentOfIndustryFDIApprovalImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_aproval', 'name_of_investor', 'nationality_of_investor', 'location', 'category', 'production_capacity', 'fixed', 'working', 'male', 'female', 'local', 'foreigner'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 12; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'fdi_approval_verify_excel_data', $this->_data);
    }


    // Repatriation Approval
    public function repatriationApprovalCreate(Request $request)
    {
        $query = RepatriationApproval::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_approval', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_approval', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;


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


        return view($this->_page . 'repatriation_approval_create', $this->_data);
    }

    public function repatriationApprovalCreateAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            if (!empty($data['date'])) {
                RepatriationApproval::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('repatriation_approval')->with('success', 'Your Information has been Added .');
    }

    public function repatriationApprovalUpdateLock(Request $request)
    {
        $query = RepatriationApproval::query();

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('repatriation_approval')->with('success', 'Your Information has been Added .');
    }

    public function repatriationApprovalExcelImport(Request $request)
    {
        return view($this->_page . 'repatriation_approval_import_excel', $this->_data);
    }

    public function repatriationApprovalExcelSample(Request $request)
    {
        return Excel::download(new RepatriationApprovalExport("sample"), 'doi_repatriation_approval.xlsx');
    }

    public function repatriationApprovalExcelImportAction(Request $request)
    {
        $data = Excel::toArray(new RepatriationApprovalImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_approval ', 'name_of_industry', 'nationality_of_foreigner_investor', 'amount', 'currency', 'dividend', 'royalty', 'other'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 8; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'repatriation_approval_verify_excel_data', $this->_data);
    }


// Technology Approval
    public function technologyApprovalCreate(Request $request)
    {
        $query = TechnologyAggrementApproval::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_approval', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_approval', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;


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


        return view($this->_page . 'technology_approval_create', $this->_data);
    }

    public function technologyApprovalCreateAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;
            if (!empty($data['date'])) {
                TechnologyAggrementApproval::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('technology_approval')->with('success', 'Your Information has been Added .');
    }

    public function technologyApprovalUpdateLock(Request $request)
    {
        $query = TechnologyAggrementApproval::query();

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('technology_approval')->with('success', 'Your Information has been Added .');
    }

    public function technologyApprovalExcelImport(Request $request)
    {
        return view($this->_page . 'technology_approval_import_excel', $this->_data);
    }

    public function technologyApprovalExcelSample(Request $request)
    {
        return Excel::download(new TechnologyAggrementApprovalExport("sample"), 'doi_technology_approval.xlsx');
    }

    public function technologyApprovalExcelImportAction(Request $request)
    {
        $data = Excel::toArray(new TechnologyAggrementApprovalImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_approval', 'name_of_industry', 'nationality_of_foreign_investor', 'duration', 'currency', 'type_of_tta'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 6; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'technology_approval_verify_excel_data', $this->_data);
    }


// Ip Registraion
    public function ipRegistrationCreate(Request $request)
    {
        $query = IpRegistration::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_registration', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_registration', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;


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


        return view($this->_page . 'ip_registration_create', $this->_data);
    }

    public function ipRegistrationCreateAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            if (!empty($data['date'])) {
                IpRegistration::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('ip_registration')->with('success', 'Your Information has been Added .');
    }

    public function ipRegistrationUpdateLock(Request $request)
    {
        $query = IpRegistration::query();

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('ip_registration')->with('success', 'Your Information has been Added .');
    }

    public function ipRegistrationExcelImport(Request $request)
    {
        return view($this->_page . 'ip_registration_import_excel', $this->_data);
    }

    public function ipRegistrationExcelSample(Request $request)
    {
        return Excel::download(new IpRegistraionExport("sample"), 'doi_ip_registration.xlsx');
    }

    public function ipRegistrationExcelImportAction(Request $request)
    {
        $data = Excel::toArray(new IpRegistraionImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_registration', 'name_of_industry_person', 'type_of_ip'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 3; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'ip_registration_verify_excel_data', $this->_data);
    }

// Facility Recomendation
    public function facilityRecommendationCreate(Request $request)
    {
        $query = FacilityRecommendation::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_recomendation', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_recomendation', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;


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


        return view($this->_page . 'facility_recommendation_create', $this->_data);
    }

    public function facilityRecommendationCreateAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;
            if (!empty($data['date'])) {
                FacilityRecommendation::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('facility_recommendation')->with('success', 'Your Information has been Added .');
    }

    public function facilityRecommendationUpdateLock(Request $request)
    {
        $query = FacilityRecommendation::query();

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('facility_recommendation')->with('success', 'Your Information has been Added .');
    }

    public function facilityRecommendationExcelImport(Request $request)
    {
        return view($this->_page . 'facility_recommendation_import_excel', $this->_data);
    }

    public function facilityRecommendationExcelSample(Request $request)
    {
        return Excel::download(new FacilityRecommendationExport("sample"), 'doi_facility_recommendation.xlsx');
    }

    public function facilityRecommendationExcelImportAction(Request $request)
    {
        $data = Excel::toArray(new FacilityRecommendationImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_recomendation', 'name_of_industry', 'type_of_recomendation'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 3; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'facility_recommendation_verify_excel_data', $this->_data);

    }


    // IEERelated
    public function ieeRelatedCreate(Request $request)
    {
        $query =  IEERelated::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }


        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date_of_approval', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date_of_approval', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }


        $this->_data['data'] = $data;


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


        return view($this->_page . 'iee_related_create', $this->_data);
    }

    public function ieeRelatedCreateAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            if (!empty($data['date'])) {
                IEERelated::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );

            }

        }

        return redirect()->route('iee_related')->with('success', 'Your Information has been Added .');
    }

    public function ieeRelatedUpdateLock(Request $request)
    {
        $query =  IEERelated::query();

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('iee_related')->with('success', 'Your Information has been Added .');
    }

    public function ieeRelatedExcelImport(Request $request)
    {
        return view($this->_page . 'iee_related_import_excel', $this->_data);
    }

    public function ieeRelatedExcelSample(Request $request)
    {
        return Excel::download(new  IEERelatedExport("sample"), 'doi_iee_related.xlsx');
    }

    public function ieeRelatedExcelImportAction(Request $request)
    {
        $data = Excel::toArray(new IEERelatedImport(), $request->file('sample_excel'));
        $formatData = [];
        $heading = ['date_of_approval', 'name_of_industry', 'no_of_iee_aproval'];
        foreach ($data[0] as $key => $row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i = 0; $i < 3; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;
        return view($this->_page . 'iee_related_verify_excel_data', $this->_data);

    }

}






