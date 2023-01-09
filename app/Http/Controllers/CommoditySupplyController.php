<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommoditySupply;
use App\Models\FiscalYear;
use App\Models\Item;
use App\Models\MeasurementUnit;
use App\Models\Hierarchy;
use App\Exports\CommoditySupplyExport;
use App\Imports\CommoditySupplyImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class CommoditySupplyController extends Controller
{
    private $_page = "pages.commodity_supply.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Commodity Supply Data';
        $this->_data['header'] = true;
    }

    public function index(Request $request)
    {
        $this->_data['fiscalYearId'] = "";
        $this->_data['data'] = "";
        if ($request->has('fiscal_year_id')) {
            $this->_data['fiscalYearId'] = $request->fiscal_year_id;
            $this->_data['fiscalYearName'] = app(UtilController::class)->getFiscalYearName($request->fiscal_year_id);
            $this->_data['data'] = CommoditySupply::where('fiscal_year_id',$request->fiscal_year_id)->get();
        }
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['items'] = Item::pluck('name','id')->prepend('Select');
        return view($this->_page . 'index', $this->_data);
    }

    public function create(Request $request)
    {
        $this->_data['fiscalYearId'] = $request->fiscal_year_id;
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['items'] = Item::pluck('name','id')->prepend('Select');
        $this->_data['units'] = MeasurementUnit::pluck('name','id')->prepend('Select');
        return view($this->_page . 'create', $this->_data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'entry_date' => 'required',
            'fiscal_year_id' => 'required',
            'item_id'=>'required',
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        if (CommoditySupply::create($data)) { 
             return redirect()->route('commodities_supply.index',['fiscal_year_id'=>$request->fiscal_year_id])->with('success', 'Your Information has been Added .');
        }
        return redirect()->route('commodities_supply.index')->with('success', 'Your Information has been Added .');
    }

    public function bulkSave(Request $request)
    {
        foreach($request->data as $data) {
            if (!empty($data['item_id'])) {
                $data['fiscal_year_id'] = $request->fiscal_year_id;
                $data['entry_date'] = app(UtilController::class)->getCurrentNepaliDate();
                CommoditySupply::updateOrCreate(
                   ['id' => $data['id']],
                   $data
                ); 
           }
        }

        return redirect()->route('commodities_supply.index',['fiscal_year_id' => $request->fiscal_year_id])->with('success', 'Your Information has been Added .');
    }

    public function getCommoditySupplyReport(Request $request)
    {
        $this->_data['hierarchy_id'] = "";
        $this->_data['user_id'] = "";
        $this->_data['item_id'] = "";
        $this->_data['fiscal_year_id'] = "";

        $query = CommoditySupply::query();
        if ($request->has('user_id') && !empty($request->user_id)) {
            $this->_data['hierarchy_id'] = $request->hierarchy_id;
            $this->_data['user_id'] = $request->user_id;
            $query->where('user_id',$request->user_id);
        }

        if ($request->has('item_id') && !empty($request->item_id)) {
            $this->_data['item_id'] = $request->item_id;
            $query->where('item_id',$request->item_id);
        }

        if ($request->has('fiscal_year_id') && !empty($request->fiscal_year_id)) {
            $this->_data['fiscal_year_id'] = $request->fiscal_year_id;
            $query->where('fiscal_year_id',$request->fiscal_year_id);
        }
        $this->_data['data'] = $query->get();
        $list = ["" => "Select User Type"];
        $nodes = Hierarchy::get()->toTree();
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$list) {
            foreach ($categories as $category) {
                $list[$category->id] =  $prefix . ' ' . $category->name;
                $this->_data['hierarchyList'] = $list;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($nodes);
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        $this->_data['items'] = Item::pluck('name','id');
        return view($this->_page . 'report', $this->_data);
    }

    public function bulkImportExcel(Request $request)
    {
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        return view($this->_page.'bulk_import',$this->_data);
    }

    public function bulkImportExcelAction(Request $request)
    {
        Excel::import(new CommoditySupplyImport($request->fiscal_year_id), request()->file('sample_excel'));
        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function allDataExport()
    {
        return Excel::download(new CommoditySupplyExport("sample"), 'commodity_export_sample.xlsx');
    }
}
