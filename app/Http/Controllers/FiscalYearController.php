<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiscalYear;

class FiscalYearController extends Controller
{
    private $_page = "pages.fiscal_years.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Fiscal Year';
        $this->_data['header'] = true;
    }

    public function index()
    {
        $this->_data['data'] = FiscalYear::all();
        return view($this->_page . 'index', $this->_data);
    }

    public function store(Request $request)
    {
        foreach($request->fiscal_year as $data) {
            if (!empty($data['name'])) {
               FiscalYear::updateOrCreate(
                   ['id' => $data['id']],
                   ['name' => $data['name'], 'from_date' => $data['from_date'], 'to_date'=> $data['to_date']]
                ); 
           }
        }

        return redirect()->route('fiscal_years.index')->with('success', 'Your Information has been Added .');
    }
}
