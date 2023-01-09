<?php

namespace App\Http\Controllers;

use App\Exports\FMTExport;
use App\Imports\FMTImport;
use App\Models\FoodManagementTradingSales;
use Illuminate\Http\Request;
use App\Models\FoodManagementTradingCo;
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

class FoodMgmtTradingController extends Controller
{
    private $_page = "pages.food_management_trading.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Food Management Trading Company';
        $this->_data['header'] = true;
    }

    public function importColumn()
    {
        return view($this->_page . 'import_column', $this->_data);
    }

    public function importColumnAction(Request $request)
    {
        $data = $request->except('_token');
        Schema::table('nepal_oil_corporations', function (Blueprint $table) use ($data) {
            if ($data['data_type'] == "String") {
                $table->string($data['column_name'], 255)->nullable();
            } else if ($data['data_type'] == "Integer") {
                $table->integer($data['column_name'])->length(11)->nullable();
            } else {
                $table->text($data['column_name'])->nullable();
            }
        });
        return redirect()->back()->with('success', 'New Column has been Added .');
    }

    public function add(Request $request, $type)
    {
        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        $this->_data['type'] = $type;
        if ($type == 'purchase'){
            $query = FoodManagementTradingCo::query();
        }else{
            $query = FoodManagementTradingSales::query();
        }


         $this->_data['item_id'] = '';
        if ($request->has('item_id') && !empty($request->item_id)) {

            $this->_data['item_id'] = $request->item_id;
            $query->where('item_id', $request->item_id);
        }



        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
        }

        if (auth()->user()->role_id == 3) {
            $query->where('user_id', auth()->user()->id);
        }

        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('date', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('date', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }




        //$this->_data['columns'] = Schema::getColumnListing('nepal_oil_corporations');
        $this->_data['items'] = Item::where('item_category_id', 1)->pluck('name_np', 'id')->toArray();
        $this->_data['units'] = MeasurementUnit::pluck('name_np', 'id')->toArray();
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

        return view($this->_page . 'purchase', $this->_data);
    }

    public function addAction(Request $request, $type)
    {


        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;
            $data['type'] = $type;
            //$data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                if ($type == 'purchase'){
                    FoodManagementTradingCo::updateOrCreate(
                        ['id' => $data['id']],
                        $data
                    );
                }else{
                    FoodManagementTradingSales::updateOrCreate(
                        ['id' => $data['id']],
                        $data
                    );
                }

            }
        }

        return redirect()->route('food_trading_add', $type)->with('success', 'Your Information has been Added .');
    }

    public function excelDataInsert(Request $request, $type)
    {
        $this->_data['type'] = $type;

        return view($this->_page . 'bulk_import', $this->_data);
    }

    public function excelDataInsertAction(Request $request, $type)
    {
        $data = Excel::toArray(new FMTImport($type), $request->file('sample_excel'));

        $formatData = [];


        $this->_data['items'] = Item::pluck('name', 'id')->skip(0)->take(10);
        $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['type'] = $type;


        if ($type == "purchase") {
            $heading = ['date', 'item_id',  'quantity_unit','quantity',];
            foreach ($data['Purchase'] as $key => $row) {
                if ($key > 0 && !empty($row[0])) {
                    for ($i = 0; $i < 4; $i++) {
                        if ($i == 1) {
                            $item = Item::where('name', $row[$i])->first();
                            $row[$i] = $item->id;
                        }
                        if ($i == 2) {
                            $unit = MeasurementUnit::where('name', $row[$i])->first();
                            $row[$i] = $unit->id;
                        }
                        $formatData[$key][$heading[$i]] = $row[$i];
                    }
                }
            }


            $this->_data['formatData'] = $formatData;

            return view($this->_page . 'verify_excel_data', $this->_data);
        } elseif ($type == "SalesStock") {

            $heading = ['date', 'item_id',  'quantity_unit',   'stock_quantity', 'sales_quantity'];

            foreach ($data['Sales&Stock'] as $key => $row) {
                if ($key > 0 && !empty($row[0])) {

                    for ($i = 0; $i < 5; $i++) {
                        if ($i == 1) {
                            $item = Item::where('name', $row[$i])->first();
                            $row[$i] = $item->id;
                        }
                        if ($i == 2) {
                            $unit = MeasurementUnit::where('name', $row[$i])->first();
                            $row[$i] = $unit->id;
                        }
                        $formatData[$key][$heading[$i]] = $row[$i];
                    }
                }
            }

            $this->_data['formatData'] = $formatData;

            return view($this->_page . 'verify_excel_data', $this->_data);
        }

    }

    public function getSample(Request $request, $type)
    {
        return Excel::download(new FMTExport("sample", $type), 'food_mamagement_' . $type . '.xlsx');
    }
}
