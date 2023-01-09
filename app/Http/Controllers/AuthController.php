<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private $_app = "";
    private $_page = null;
    private $_data = [];

    public function _construct()
    {
    }

    public function loginAction(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            app(UtilController::class)->getCurrentFiscalYear();
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin_report');
            } else if (Auth::user()->role_id == 2){

                if (!empty(Auth::user()->office_id)){
                    return redirect()->route('user-list-office'); 
                } else {
                    return redirect()->route('user-list-hierarchy'); 
                }
            } else {
                return redirect()->route('user-details');
                // $hierarchyId = Auth::user()->hierarchy->hierarchy_id;
                // if ($hierarchyId == 7) {
                //     return redirect()->route('department-of-custom','export');
                // } else if ($hierarchyId == 8) {
                //     return redirect()->route('dcsc_market_monitoring');
                // } else if ($hierarchyId == 9) {
                //     return redirect()->route('department_of_industries');
                // }
            }
        }

        return redirect()->back()->withInput($request->only('username'))->with(['fail' => 'Credentials did not match our record']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
