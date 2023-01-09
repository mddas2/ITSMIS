<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Hierarchy;
use DB;
use Illuminate\Support\Facades\Http;

class TestApiController extends Controller
{
    public function index(){

         $authResponse = Http::post('http://110.34.25.91:8080/api/auth/login', [
            'username' => 'ministry_user',
            'password' => '0(r_m!n!stry',
        ]);

        $headers = $authResponse->headers();
        $bearer_token =$headers['JwtToken']['0'];

       // $authResponse_data =  json_decode($authResponse->body());



        $get_response = Http::withToken($bearer_token)
            ->get('http://110.34.25.91:8080/api/data/ministry/2001-01-13/2022-02-14');
        $ocr_response_data =  json_decode($get_response->body());


        dd($get_response_data);


        /*$client = new Client();
       $res = $client->request('POST', 'https://110.34.25.91:8080/api/auth/login', [
           'form_params' => [
               'username' => 'ministry_user',
               'password' => '0(r_m!n!stry',
           ]
       ]);

       echo $res->getStatusCode();
       // 200
       echo $res->getHeader('content-type');
       // 'application/json; charset=utf8'
       echo $res->getBody();*/

    }

    public function marketMonitoring(Request $request)
    {
        $this->_data['from_date'] =$this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }
        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        //$this->_data['data'] = json_decode(file_get_contents('https://monitoring.doc.gov.np/Api/External/MonitoringReport/MOICS/007$@g@r255it9999xyzko893498hdjfyenx25846737982luvB/' . $this->_data['from_date'], false, stream_context_create($arrContextOptions)));
        $this->_data['data'] = json_decode(file_get_contents('https://monitoring.doc.gov.np/Api/External/MonitoringReport/MOICS/007$@g@r255it9999xyzko893498hdjfyenx25846737982luvB/'. $this->_data['from_date'].'/'.$this->_data['to_date'] , false, stream_context_create($arrContextOptions)));
        //$client = new Client();
        // $client->setDefaultOption('verify', asset('assets/cacert.pem'));
        //$res = $client->request('GET','https://monitoring.doc.gov.np/Api/External/MonitoringReport/MOICS/007$@g@r255it9999xyzko893498hdjfyenx25846737982luvB/2078-08-20');


        $this->_data['user'] = User::find(Auth::id());


        $hierarchyId = auth()->user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {
                    if ($key != count($parentHierarchy) - 1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ? ' -> ' : ' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }

                }
            }
        }
        return view($this->_page . 'market_monitoring_api', $this->_data);
    }



}
