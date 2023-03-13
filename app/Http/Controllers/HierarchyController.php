<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hierarchy;
use App\Models\AccessLevel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Models\ItemCategory;

class HierarchyController extends Controller
{
    private $_app = "";
    private $_page = "pages.hierarchies.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Hierarchy';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = Hierarchy::get()->toFlatTree();
        return view($this->_page . 'index', $this->_data);
    }

    public function create(Request $request)
    {
        $list = ["0" => "Select Parent"];
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
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        if (Hierarchy::create($request->all())) {
            return redirect()->back()->with('success', 'Your Information has been Added .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function edit($id)
    {
        $list = ["" => "Select Parent"];
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
        $this->_data['data'] = Hierarchy::find($id);
        return view($this->_page . 'edit', $this->_data);
    }

    public function update(Request $request,$id)
    {
        $data = $request->input();
        $hierarchy = Hierarchy::findOrFail($id);
        $hierarchy->fill($data);
        if ($hierarchy->save()) {
            return redirect()->back()->with('success', 'Your Information has been Updated .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function getTreeView()
    {


        $result = Hierarchy::all();
        $this->_data['tree'] = [];
        if (!$result->isEmpty()) {
            $new = array();
            foreach ($result as $a){
                $selected = false;
                if ($a->parent_id != 0) {
                    $icon = "fas fa-window-maximize text-info";
                } else {
                   // $selected = true;
                    $icon = "fas fa-window-restore text-success";
                }
                $lang = Session::get('applocale');

                if($lang == 'np'){
                    $text = $a->name_ne;
                }else{
                    $text = $a->name;
                }
                $new[!empty($a->parent_id)?$a->parent_id:0][] = ['id'=>$a->id,'text'=>$text,'state'=>['opened'=>false,'selected'=>$selected],'icon' => $icon];
            }
            $this->_data['tree'] = $this->createTree($new, $new[0]);
        }
        return view($this->_page . 'tree_view', $this->_data);
    }

    public function createTree(&$list, $parent){
        $tree = array();
        foreach ($parent as $k=>$l){
            if(isset($list[$l['id']])){
                $l['children'] = $this->createTree($list, $list[$l['id']]);
            }
            $tree[] =$l;
        }
        return $tree;
    }

    public function deleteNode($id)
    {

    }

    public function accessLevel(Request $request)
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

        $lang = Session::get('applocale');

        if($lang == 'np'){
            $this->_data['modules'] = [
                '1' => 'भन्सार विभाग',
                '2' => 'वाणिज्य, आपूर्ति र उपभोक्ता अधिकार संरक्षण विभाग',
                '3' => 'उद्योग विभाग',
                '4' => 'नेपाल आयल निगम',
                '5' => 'खाद्य व्यवस्थापन र व्यापार कम्पनी',
                '6' => 'साल्ट ट्रेडिङ लिमिटेड',
                '7' => 'स्थानीय तह',
                '8' => 'जिल्ला प्रशासन कार्यालय',
                '9' => 'प्रदेश स्तर - घर तथा साना उद्योग कार्यालय',
                '10' => 'प्रदेश स्तर - उद्योग, वाणिज्य तथा उपभोक्ता संरक्षण निर्देशनालय',
                '11' => 'गृह उद्योग प्रवर्द्धन केन्द्र',
                '12' => 'उद्योग र निजी क्षेत्र',
                '13' => 'कम्पनी रजिष्‍ट्रारको कार्यालय',
            ];
        }else{
            $this->_data['modules'] = [
                '1' => 'Department Of Custom',
                '2' => 'Deparment Of Commerce, Supply and Consumer Right Protection',
                '3' => 'Department Of Industry',
                '4' => 'Nepal Oil Corporation',
                '5' => 'Food Management and Trading Company',
                '6' => 'Salt Trading Corporation',
                '7' => 'Local Level',
                '8' => 'District Administration Office',
                '9' => 'Province Level - Home And Small Industrial Office',
                '10' => 'Province Level - Directorate of Industry, Commerce and Consumer Protection',
                '11' => 'Home Industry Promotion Center',
                '12' => 'Industry And Private Sector',
                '13' => 'Office of The Company Registrar',
            ];
        }



        return view($this->_page . 'access_level', $this->_data);
    }

    public function accessLevelAction(Request $request)
    {
        $data = $request->except('_token');

        $data['office_id'] = !empty($data['office_id'])?serialize($data['office_id']):"";
        $data['module_id'] = serialize($data['module_id']);

        $accessLevel = AccessLevel::where('hierarchy_id',$data['hierarchy_id'])->first();
        $id = !empty($accessLevel)?$accessLevel['id']:0;
        AccessLevel::updateOrCreate(
           ['id' => $id],
           $data
        );

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }


    public function getAccessLevel(Request $request)
    {
        $query = AccessLevel::query();

        if ($request->has('hierarchy_id')) {
            $query->where('hierarchy_id',$request->hierarchy_id);
        }

        $data = $query->first();
        $return = ['office' => [],'module'=>[]];
        if (!empty($data)) {
            $return = [
                'office' => !empty($data->office_id)?unserialize($data->office_id):"",
                'module' => unserialize($data->module_id)
            ];

            return json_encode($return);
        } else {
            return json_encode($return);
        }
    }
}
