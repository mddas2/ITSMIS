<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Session;
use DB;

class UtilController extends Controller
{
    private $userRepository;
    private $_app = "";
    private $_data = [];

    public function __construct()
    {

    }

    public function changeLanguage($lang)
    {

        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        if (Session::get('applocale') == 'en') {
            return redirect(url('/locale/en'));
        } elseif (Session::get('applocale') == 'np') {
            return redirect(url('/locale/np'));
        }

    }

    public function getCurrentFiscalYear()
    {
        $currentDate = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->first();
        $fiscalYear = DB::table('fiscal_years')->whereRaw('"' . $currentDate->ndate . '" between from_date and to_date')->first();
        if (empty($fiscalYear)) {
            $fiscalYear = DB::table('fiscal_years')->first();
        }
        Session::put('fiscal_year', $fiscalYear);
    }

    public function getFiscalYearName($id)
    {
        $fiscalYear = DB::table('fiscal_years')->where('id', $id)->first('name');
        return $fiscalYear->name;
    }

    public function getCurrentNepaliDate()
    {
        $currentDate = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->first();
        return $currentDate->ndate;
    }
}
