<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Hierarchy;
use App\Models\District;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Session;

class OfficeController extends Controller
{
    private $_page = "pages.office.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Office';
    }

    public function index(Request $request)
    {
       
        $this->_data['hierarchy_id'] = "";
        $query = DB::table('office')
            ->select('office.*',DB::raw('COUNT(users.id) as total_users'))
            ->join('hierarchies','hierarchies.id','=','office.hierarchy_id')
            ->leftJoin('users','users.office_id','=','office.id');

        $query = Office::query();

        if ($request->has('hierarchy_id')) {
            $descendants = Hierarchy::descendantsOf($request->hierarchy_id)->pluck('id')->toArray();
            array_push($descendants,$request->hierarchy_id);
            $query->whereIn('hierarchy_id',$descendants);
            $this->_data['hierarchy_id'] = $request->hierarchy_id;
        }

        $this->_data['data'] = $query->get();
        return view($this->_page . 'index', $this->_data);
    }

    public function create(Request $request)
    {
        $list = [];
        $this->_data['list'] = $list;
        $nodes = Hierarchy::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
            foreach ($categories as $category) {
                $lang = Session::get('applocale');
                if($lang == 'np'){
                    $list[$category->id] =  $prefix . ' ' . $category->name_ne;
                }else{
                    $list[$category->id] =  $prefix . ' ' . $category->name;
                }


                $this->_data['list'] = $list;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);
        $this->_data['hierarchy_id'] = $request->hierarchy_id;
        $lang = Session::get('applocale');
        if($lang == 'np'){
            $this->_data['province'] = Province::pluck('name_ne','id')->prepend("प्रदेश चयन गर्नुहोस्","0")->toArray();
        }else{
            $this->_data['province'] = Province::pluck('name','id')->prepend("Select Province","0")->toArray();
        }

        $this->_data['code'] = Office::orderBy('id','DESC')->pluck('code')->first();
        //$this->_data['code'] = $this->_data['code']  +1 ;
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['code'] = strtoupper(substr($data['name'], 0, 2)) .'-'. mt_rand(1111,9999);;
        $office = Office::create($data); 

        if (!empty($office)) {
            return redirect()->route('hierarchies.tree_view')->with('success', 'Your Information has been Added .');
        } else {
            return redirect()->route('hierarchies.tree_view')->with('fail', 'Your Information could not be added.');
        }
    }

    public function edit($id)
    {
        $list = [];
        $this->_data['list'] = $list;
        $nodes = Hierarchy::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
            foreach ($categories as $category) {
                $lang = Session::get('applocale');
                if($lang == 'np'){
                    $list[$category->id] =  $prefix . ' ' . $category->name_ne;
                }else{
                    $list[$category->id] =  $prefix . ' ' . $category->name;
                }

                $this->_data['list'] = $list;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);
        $this->_data['officeData'] = Office::find($id);
        $this->_data['province'] = Province::pluck('name','id')->prepend("Select Province","0")->toArray();
        return view($this->_page.'edit',$this->_data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'hierarchy_id'=>'required',
            'code' => 'required',
        ]);

        $data = $request->input();
        $office = Office::findOrFail($id);
        $office->fill($data);
        if ($office->save()){
            return redirect()->back()->with('success', 'Your Information has been Updated .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function getOfficeList (Request $request)
    {
        $lang = Session::get('applocale');
        if ($request->has('hierarchy_id')) {
            $hierarchy = Hierarchy::find($request->hierarchy_id);
            $descendants = Hierarchy::descendantsOf($request->hierarchy_id)->pluck('id')->toArray();
            array_push($descendants,$request->hierarchy_id);




            if($lang == 'np'){
                $office = Office::whereIn('hierarchy_id',$descendants)->pluck('name_ne','id')->prepend($hierarchy->name,"0")->toArray();
            }else{
                $office = Office::whereIn('hierarchy_id',$descendants)->pluck('name','id')->prepend($hierarchy->name,"0")->toArray();
            }
        } else {
            if($lang == 'np'){
                $office = Office::pluck('name_ne','id')->prepend("कार्यालय चयन गर्नुहोस्","0")->toArray();
            }else{
                $office = Office::pluck('name','id')->prepend("Select Office","0")->toArray();
            }

        }

        if($request->ajax()){
            return json_encode($office);
        } else {
            return $office;
        }
    }

    public function getDistrictList(Request $request)
    {
        if ($request->has('province_id')) {
            $lang = Session::get('applocale');
            if($lang == 'np'){
                $district = District::where('province_id',$request->province_id)->pluck('nepali_name','id')->prepend("प्रदेश चयन  जिल्ला","0")->toArray();
            }else{
                $district = District::where('province_id',$request->province_id)->pluck('alt_name','id')->prepend("Select District","0")->toArray();
            }
        } else {
            $district = District::pluck('alt_name','id')->prepend("Select District","0")->toArray();
        }

        if($request->ajax()){
            return json_encode($district);
        } else {
            return $district;
        }
    }

    public function getMunicipalityList(Request $request)
    {
        if ($request->has('district_id')) {
            $lang = Session::get('applocale');
            if($lang == 'np'){
                $municipality = Municipality::where('district_id',$request->district_id)->pluck('alt_name','id')->prepend("नगरपालिका चयन  जिल्ला","0")->toArray();
            }else{
                $municipality = Municipality::where('district_id',$request->district_id)->pluck('alt_name','id')->prepend("Select Municipality","0")->toArray();
            }
        } else {
            $municipality = Municipality::pluck('alt_name','id')->prepend("Select Municipality","0")->toArray();
        }

        if($request->ajax()){
            return json_encode($municipality);
        } else {
            return $municipality;
        }
    }
}
