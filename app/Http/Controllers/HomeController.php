<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hierarchy;

class HomeController extends Controller
{
    private $_app = "";
    private $_page = "pages.home.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Dashboard';
        $this->_data['header'] = true;
    }

    public function dashboardMap()
    {
        return view($this->_page . 'maps', $this->_data);
    }

    public function dashboardChart()
    {
        return view($this->_page . 'charts', $this->_data);
    }

    public function dashboardReport()
    {
        return view($this->_page . 'reports',$this->_data);
    }

    public function dashboardCalendar()
    {
        return view($this->_page . 'calendar', $this->_data);
    }
}
