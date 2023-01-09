<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hierarchy;
use App\Models\UserHierarchy;
use Illuminate\Support\Facades\Hash;
use App\Models\District;
use App\Models\Office;
use App\Models\Upload;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $_page = "pages.users.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage User';
        $this->_data['header'] = true;
    }

    public function index(Request $request)
    {
        $this->_data['office_id'] = "";
        $this->_data['hierarchy_id'] = "";
        $query = DB::table('users')
            ->select('users.*','roles.name as role','uploads.path as upload_path')
            ->join('roles','users.role_id','=','roles.id')
            ->join('user_hierarchies','user_hierarchies.user_id','=','users.id')
            ->leftJoin('uploads','uploads.id','=','users.upload_id')
           // ->join('office','office.id','=','users.office_id')
            ->where('users.deleted_at','=',null);

        if ($request->has('hierarchy_id') && !empty($request->hierarchy_id)) {
            $descendants = Hierarchy::descendantsOf($request->hierarchy_id)->pluck('id')->toArray();
            array_push($descendants,$request->hierarchy_id);
            $query->whereIn('user_hierarchies.hierarchy_id',$descendants);
            $this->_data['hierarchy_id'] = $request->hierarchy_id;
        }
        if ($request->has('is_office') && $request->is_office == "false") {

            $query->where('users.office_id','=',0);
        }

        // if ($request->has('office_id') && !empty($request->office_id)) {
        //     $query->where('users.office_id','=',$request->office_id);
        //     $this->_data['office_id'] = $request->office_id;
        // }

        $this->_data['data'] = $query->get();
        return view($this->_page . 'index', $this->_data);
    }

    public function userByOffice(Request $request)
    {
        $office = auth()->user()->office_id;
        $this->_data['data'] = DB::table('users')
                ->select('users.*','roles.name as role')
                ->join('roles','users.role_id','=','roles.id')
                ->where('users.office_id','=',$office)
                ->whereNotIn('users.role_id',[1,2])
                ->where('users.deleted_at','=',null)
                ->get();

        $this->_data['user'] = User::find(auth()->user()->id); 

        $hierarchyId = Auth::user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {                    
                    if ($key != count($parentHierarchy)-1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ?' -> ':' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }
                    
                }
            }
        }    
        return view($this->_page . 'list_by_office', $this->_data);
    }

    public function create(Request $request)
    {
        $list = ["0" => 'Select Hierarchy'];
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

        if ($request->has('hierarchy_id')) {
            $this->_data['hierarchy_id'] = $request->hierarchy_id;
        } else {
            $this->_data['hierarchy_id'] = "";
        }

        if ($request->has('office_id')) {
            $this->_data['office_id'] = $request->office_id;
        } else {
            $this->_data['office_id'] = "";
        }
        
        $this->_data['office'] = Office::pluck('name','id');
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];  
        $user->password = Hash::make($data['password']); 
        $user->office_id = $data['office_id'];   
        $user->post = $data['post'];   
        $user->address = $data['address'];   
        $user->email = $data['email'];    
        $user->contact = $data['contact'];    
        $user->role_id = $data['role_id']; // CHANGE LATER

        if (!empty($data['document'])) {
            $upload = new Upload();
            $upload->type = "identity_document";
            $docPath = 'identity_docs/'.$data['hierarchy_id'];
            $upload->path = $data['document']->storeAs($docPath, $data['document']->getClientOriginalName(), 'public'); 
            $upload->save();
            $user->upload_id = $upload->id;
        }

        if ($user->save()) {
            $userHie = new UserHierarchy();
            $userHie->user_id = $user->id;
            $userHie->hierarchy_id = $data['hierarchy_id'];
            $userHie->save();
            return redirect()->back()->with('success', 'Your Information has been Added .');
        }
          
        return redirect()->back()->with('fail', 'Your Information could not be added .');
    }

    public function edit($id)
    {
        $list = ["0" => 'Select Hierarchy'];
        $this->_data['list'] = $list;

        $nodes = Hierarchy::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
            foreach ($categories as $category) {
                $list[$category->id] =  $prefix . ' ' . $category->name;
                $this->_data['list'] = $list;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);

        $this->_data['data'] = User::find($id);
        $this->_data['office'] = Office::pluck('name','id');
        return view($this->_page . 'edit', $this->_data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'hierarchy_id'=>'required'
        ]);

        $data = $request->input();
        $user = User::findOrFail($id);
        $user->fill($data);
        if ($user->save()){
            return redirect()->back()->with('success', 'Your Information has been Updated .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if ($data->delete()){
            return redirect()->back()->with('success', "User has been removed.");
        }
        return redirect()->back()->with('fail', "User could not be deleted.");
    }

    public function getUserList(Request $request)
    {
        $query = DB::table('users')
            ->select('users.*')
            ->join('user_hierarchies','user_hierarchies.user_id','=','users.id')
            ->join('office','office.id','=','users.office_id');

        if ($request->has('hierarchy_id')) {
            $query->where('user_hierarchies.hierarchy_id','=',$request->hierarchy_id);
        }

        if ($request->has('office_id')) {
            $query->where('users.office_id','=',$request->office_id);
        }

        if (auth()->user()->role_id == 1) {
            $query->where('users.role_id','!=',1);
        } else if (auth()->user()->role_id == 2) {
            $query->whereNotIn('users.role_id',[1,2]);
        }

        $users = $query->get();
        $list = [];
        $list[0]['id'] = "";
        $list[0]['name'] = "Select User";
        $cnt = 1;
        foreach ($users as $key=>$user) {
            $list[$cnt]['id'] = $user->id;
            $list[$cnt]['name'] = $user->name;
            $cnt++;
        }
        if($request->ajax()){
            return json_encode($list);
        } else {
            return $list;
        }
    }

    public function editCredential(Request $request)
    {
        $this->_data['data'] = User::where('id',$request->id)->first();
        $this->_data['request'] = $request->all();
        return view($this->_page.'edit_credential',$this->_data);
    }

    public function editCredentialAction(Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required',
            'new_c_password' => 'required|same:new_password'
        ]);

        $user = User::find($request['id']);
        if ($request['is_user'] == 1) {
             if (User::where(['id' => $request['id']])->update(['password'=>Hash::make($request->new_password),'username'=>$request->username])) {
                    return redirect()->back()->with('success', 'User credential has been changed .');
                } else {
                    return redirect()->back()->with('fail', 'User Credential could not be changed .');
                }
        } else {
            if (Hash::check($request['old_password'], $user->password)) {
                if (User::where(['id' => $id])->update(['password'=>Hash::make($request->new_password),'username'=>$request->username])) {
                    return redirect()->back()->with('success', 'User credential has been changed .');
                } else {
                    return redirect()->back()->with('fail', 'User Credential could not be changed .');
                }
            } else {
                return redirect()->back()->with('fail', 'User Old Password is incorrect');
            }
        }
        
    }

    public function checkUsername(Request $request)
    {
        $username = User::where('id','!=',$request->id)->where('username',$request->username)->pluck('username')->first();
        if (!empty($username)) {
            return false;
        } else {
            return true;
        }
    }

    public function checkOldPassword(Request $request,$id)
    {
        $this->validate($request, [
            'old_password' => 'required',
        ]);
        $user = User::find($id);
        if (Hash::check($request['old_password'], $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function userByHierarchy()
    {
        $hierarchyId = Auth::user()->hierarchy->hierarchy_id;

        $this->_data['hierarchy_id'] = $hierarchyId;

        //users
        $query = DB::table('users')
            ->select('users.*','roles.name as role')
            ->join('roles','users.role_id','=','roles.id')
            ->join('user_hierarchies','user_hierarchies.user_id','=','users.id')
            ->where('users.office_id','=',0)
            ->where('users.deleted_at','=',null)
            ->where('users.role_id','=',3);

        
        $descendants = Hierarchy::descendantsOf($hierarchyId)->pluck('id')->toArray();
        array_push($descendants,$hierarchyId);
        $query->whereIn('user_hierarchies.hierarchy_id',$descendants);
        $this->_data['users'] = $query->get();

        //offices
        $query = Office::query();
        $query->whereIn('hierarchy_id',$descendants);

        $this->_data['offices'] = $query->get();

        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {                    
                    if ($key != count($parentHierarchy)-1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ?' -> ':' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }
                    
                }
            }
        }
        return view($this->_page . 'list_by_hierarchy', $this->_data);
    }

    public function userDetails()
    {
        $lang = Session::get('applocale');
        $this->_data['user'] = User::find(auth()->user()->id);
    //    dd($this->_data['user']);
        $hierarchyId = Auth::user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {                    
                    if ($key != count($parentHierarchy)-1) {
                        if($lang == 'np'){
                            $this->_data['hierarchyTitle'][0] .= $parent['name_ne'];
                        }else{
                            $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        }

                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ?' -> ':' -> ';
                    } else {
                        if($lang == 'np'){
                            $this->_data['hierarchyTitle'][1] .= $parent['name_ne'];
                        }else{
                            $this->_data['hierarchyTitle'][1] .= $parent['name'];
                        }

                    }
                    
                }
            }
        }
        return view($this->_page . 'users_detail', $this->_data);
    }
}
