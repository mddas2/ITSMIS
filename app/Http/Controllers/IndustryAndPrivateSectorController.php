<?php

namespace App\Http\Controllers;

use App\Models\IndustryAndPrivateSectorProduction;
use App\Models\ItemCategory;
use App\Models\LocalLevelTraining;
use App\Models\LocalProduction;
use App\Models\TrainingType;
use Illuminate\Http\Request;
use App\Models\MeasurementUnit;
use App\Models\User;
use App\Models\Item;
use Auth;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use GuzzleHttp\Client;

class IndustryAndPrivateSectorController extends Controller
{
    private $_page = "pages.industry_and_private_sector.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Industry And Private Sector';
        $this->_data['header'] = true;
    }


    public function add(Request $request)
    {
        $query = IndustryAndPrivateSectorProduction::query();

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

        if ($request->has('item_id') && !empty($request->item_id)) {
            $query->where('item_id', $request->item_id);
        }

        if ($request->has('item_category_id') && !empty($request->item_category_id)) {
            $query->where('item_category_id', $request->item_category_id);
        }

        if (auth()->user()->role_id == 3) {
            $query->where('user_id', auth()->user()->id);
        }


        $data = $query->get();

        //$this->_data['columns'] = Schema::getColumnListing('nepal_oil_corporations');
        $this->_data['items'] = Item::pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name_np', 'id')->toArray();
        $this->_data['category'] = ItemCategory::pluck('name_np', 'id')->toArray();
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


        return view($this->_page . 'create', $this->_data);
    }


    public function addAction(Request $request)
    {

        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;

            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                IndustryAndPrivateSectorProduction::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('industrial_private_sector_add')->with('success', 'Your Information has been Added .');
    }


}
