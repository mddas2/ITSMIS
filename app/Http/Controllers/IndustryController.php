<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;

class IndustryController extends Controller
{
    private $_app = "";
    private $_page = "pages.industries.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Industry';
        $this->_data['header'] = true;
    }

    public function create(Request $request)
    {
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        if (Industry::create($data)) {
            return redirect()->back()->with('success', 'Your Information has been Added .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }
}
