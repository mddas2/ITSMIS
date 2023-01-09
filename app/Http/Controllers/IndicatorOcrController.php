<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndicatorOcr;

class IndicatorOcrController extends Controller
{
    private $_app = "";
    private $_page = "pages.indicator_ocr.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Indicators';
        $this->_data['header'] = true;
    }

    public function create(Request $request)
    {
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        if (IndicatorOcr::create($data)) {
            return redirect()->back()->with('success', 'Your Information has been Added .');
        }
        return redirect()->back()->with('fail', 'Information could not be added .');
    }
}
