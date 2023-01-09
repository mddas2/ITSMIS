<?php

namespace App\Http\Controllers;

use App\Models\HipcTraining;

use App\Models\TrainingType;
use Illuminate\Http\Request;
use App\Models\MeasurementUnit;
use App\Models\User;
use Auth;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use GuzzleHttp\Client;

class HipcController extends Controller
{
    private $_page = "pages.home_and_small_industry_promotion_center.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Home Industry Promotion Center';
        $this->_data['header'] = true;
    }


    public function addTraining(Request $request)
    {


        $query = HipcTraining::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        if (!empty($this->_data['from_date'])) {
            $query->where('date', '>=', $this->_data['from_date']);
        }
        if (!empty($this->_data['to_date'])) {
            $query->where('date', '<=', $this->_data['to_date']);
        }

        if ($request->has('program_ne') && !empty($request->item_id)) {
            $query->where('program_ne', $request->item_id);
        }

        if ($request->has('training_type_id') && !empty($request->item_category_id)) {
            $query->where('training_type_id', $request->item_category_id);
        }

        if (auth()->user()->role_id == 3) {
            $query->where('user_id', auth()->user()->id);
        }


        $data = $query->get();

        //$this->_data['columns'] = Schema::getColumnListing('hipc_training');
        $this->_data['training_types'] = TrainingType::pluck('name_np', 'id')->toArray();
        $this->_data['data'] = $data;
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

        return view($this->_page . 'training_create', $this->_data);
    }

    public function addTrainingAction(Request $request)
    {

        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                HipcTraining::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('hipc_addTraining')->with('success', 'Your Information has been Added .');
    }
}
