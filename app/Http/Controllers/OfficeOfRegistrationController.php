<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeOfCompanyRegistration;
use Auth;
use App\Exports\OfficeOfCompanyRegistrationExport;
use App\Imports\OfficeOfCompanyRegistrationImport;
use DB;
use App\Models\Hierarchy;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;


class OfficeOfRegistrationController extends Controller
{
    private $_page = "pages.office_registration.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Office Of Registration';
        $this->_data['header'] = true;
    }

    public function index(Request $request){

        $this->_data['from_date'] =$this->_data['to_date'] =   date('Y-m-d') ;
        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }



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




        $authResponse = Http::post('http://110.34.25.91:8080/api/auth/login', [
            'username' => 'ministry_user',
            'password' => '0(r_m!n!stry',
        ]);


// for na// 
        $headers = $authResponse->headers();
        $bearer_token =$headers['JwtToken']['0'];

        // $authResponse_data =  json_decode($authResponse->body());



        $get_response = Http::withToken($bearer_token)
            ->get('http://110.34.25.91:8080/api/data/ministry/'.$this->_data['from_date'].'/'.$this->_data['to_date'].'');
        $this->_data['data'] =  json_decode($get_response->body());


//for na//


        return view($this->_page . 'show', $this->_data);

    }

    public function officeRegistration(Request $request)
    {
        $query = OfficeOfCompanyRegistration::query();
        if ($request->has('entry_date')) {
            $query->where('date',$request->entry_date);
        }

        $data = $query->get();

        $this->_data['data'] = $data;
        return view($this->_page . 'create', $this->_data);
    }

    public function officeRegistrationAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['user_id'] = Auth::user()->id;
            $data['types_of_company'] = explode(",", $data['types_of_company']);
            $data['types_of_company'] = serialize($data['types_of_company']);
            OfficeOfCompanyRegistration::updateOrCreate(
               ['id' => $data['id']],
               $data
            );
        }

        return redirect()->route('office_registration')->with('success', 'Your Information has been Added .');
    }

    public function updateLockOfficeRegistration(Request $request)
    {
        $query = OfficeOfCompanyRegistration::query();

        if ($request->has('entry_date')) {
            $query->where('date',$request->entry_date);
        }

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->route('office_registration')->with('success', 'Your Information has been Added .');
    }

    public function officeRegistrationExcel(Request $request)
    {
        return view($this->_page.'import_excel',$this->_data);
    }

    public function getofficeRegistrationSample(Request $request)
    {
        return Excel::download(new OfficeOfCompanyRegistrationExport("sample"), 'office_of_company_registration.xlsx');
    }

    public function officeRegistrationExcelAction (Request $request)
    {
        $data = Excel::toArray(new OfficeOfCompanyRegistrationImport(),$request->file('sample_excel'));
        $formatData = [];
        $heading = ['date','no_of_registered_company','types_of_company','revenue_raised'];
        foreach ($data[0] as $key=>$row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i=0; $i < 4 ; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;

        return view($this->_page . 'verify_excel_data', $this->_data);
    }
}
