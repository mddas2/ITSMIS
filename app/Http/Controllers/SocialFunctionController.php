<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialFunction;

class SocialFunctionController extends Controller
{
    private $_page = "pages.social_function.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Social Function';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = SocialFunction::all();
        return view($this->_page . 'index', $this->_data);
    }

    public function store(Request $request)
    {
        foreach($request->data as $data) { 
            if (!empty($data['name'])) {
               SocialFunction::updateOrCreate(
                   ['id' => $data['id']],
                   ['name' => $data['name']]
                ); 
           }
        }

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }
}
