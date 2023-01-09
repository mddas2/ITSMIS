<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentOfCustom;
use App\Models\Item;
use App\Models\MeasurementUnit;
use App\Exports\DOCExport;
use App\Imports\DOCImport;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use App\Models\User;
use App\Models\PermissionForExportImport;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DB;

class DepartmentOfCustomController extends Controller
{
    private $_page = "pages.department_of_customs.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Department Of Customs';
        $this->_data['header'] = true;
        $this->_data['users'] = User::where('role_id', '!=', '1')->pluck('name', 'id')->toArray();
        // dd(auth()->check());
        // $this->_data['user'] = User::find(Auth::id());
        // dd(Auth::id());
    }

    public function export(Request $request, $type)
    {
        $query = DepartmentOfCustom::query();
        $this->_data['from_date'] = $this->_data['to_date'] = $this->_data['today'] = date('Y-m-d');


        if ($request->has('from_date')) {

            $custom_from_date = explode('-', $this->_data['from_date']);
            $custom_from_date[2] = '00';
            $this->_data['from_date'] = implode('-', $custom_from_date);
        }

        if ($request->has('to_date')) {
            $custom_to_date = explode('-', $this->_data['to_date']);
            $custom_to_date[2] = '32';
            $this->_data['to_date'] = implode('-', $custom_to_date);
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        /*if ($request->has('item_id') && !empty($request->item_id)) {
            $query->where('item_id',$request->item_id);
        }*/

        if ($request->has('from_date')) {
            if (!empty($this->_data['from_date'])) {
                $query->where('asmt_date', '>=', $this->_data['from_date']);
            }
            if (!empty($this->_data['to_date'])) {
                $query->where('asmt_date', '<=', $this->_data['to_date']);
            }

            $data = $query->get();
        } else {


            $data = $query->latest()->take(20)->get();
        }

        // dd($data);
        $items = Item::pluck('name', 'id')->skip(0)->take(10)->toArray();
        $measurementUnit = MeasurementUnit::pluck('name', 'id')->toArray();
        $this->_data['columns'] = Schema::getColumnListing('dcsc_market_monitorings');
        $this->_data['data'] = $data;
        $this->_data['items'] = $items;
        $this->_data['measurementUnit'] = $measurementUnit;
        $this->_data['type'] = $type;
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

    public function exportAction(Request $request, $type)
    {

        foreach ($request->data as $key => $data) {

            $data['user_id'] = Auth::user()->id;
            $data['type'] = $type;

            $date = str_replace('/', '-', $data['asmt_date']);
            $data['asmt_date'] = date('Y-m-d', strtotime($date));


            if (!empty($data['date'])) {
                DepartmentOfCustom::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );

            }


        }


        return redirect()->route('department-of-custom', $type)->with('success', 'Your Information has been Added .');

    }

    public function updateLockExport(Request $request)
    {
        if (Auth::user()->role_id != 1 && $request->lock == 0) {
            return redirect()->route('department-of-custom', $request->type)->with('fail', 'Sorry, The data has already been locked. Please contact administrator to unlock the data');
        } else {
            DepartmentOfCustom::where('type', $request->type)->update(['locked' => $request->lock]);
            return redirect()->route('department-of-custom', $request->type)->with('success', 'Your Information has been Added .');
        }
    }

    public function excelDataInsert(Request $request, $type)
    {
        $this->_data['type'] = $type;

        return view($this->_page . 'bulk_import', $this->_data);
    }

    public function excelDataInsertAction(Request $request, $type)
    {


        $formatData = [];
        $year = $request->year;
        $month = $request->month;
        $this->_data['date'] = $year . '-' . $month . '-01';

        if ($type == "export") {
            $data = Excel::toArray(new DOCImport('Export'), $request->file('sample_excel'));

            $heading = ['hscode', 'item', 'description', 'asmt_date', 'customs', 'unit_id', 'quantity', 'cif_value', 'hs4', 'ch'];

            foreach (array_chunk($data['Export'] , 500) as $TopKey => $topRow) {

                foreach ($topRow as $key => $row) {
                    if ($key > 0 && !empty($row[0])) {
                        for ($i = 0; $i < 12; $i++) {

                            if ($i == 3) {

                                $date = str_replace('/', '-', $row[$i]);
                                $formatData[$key][$heading[$i]] = date('Y-m-d', strtotime($date));
                            }elseif ($i != 10 && $i != 11) {
                                $formatData[$key][$heading[$i]] = $row[$i];
                            } elseif ($i == 10) {
                                $formatData[$key]['type'] = $type;
                            } elseif ($i == 11) {
                                $formatData[$key]['user_id'] = Auth::user()->id;
                            }

                        }


                    }


                }

                DepartmentOfCustom::insert($formatData) ;
            }




            $this->_data['formatData'] = $formatData;

            //return view($this->_page . 'verify_export_import_excel', $this->_data);
            return redirect()->route('department-of-custom', $type)->with('success', 'Your Information has been Added .');
        } else {
            $data = Excel::toArray(new DOCImport('Import'), $request->file('sample_excel'));
            $heading = ['hscode', 'item', 'description', 'asmt_date', 'customs', 'unit_id', 'quantity', 'cif_value', 'hs4', 'ch'];

            foreach (array_chunk($data['Import'] , 500) as $TopKey => $topRow) {

                foreach ($topRow as $key => $row) {
                    if ($key > 0 && !empty($row[0])) {
                        for ($i = 0; $i < 12; $i++) {

                            if ($i == 3) {

                                $date = str_replace('/', '-', $row[$i]);
                                $formatData[$key][$heading[$i]] = date('Y-m-d', strtotime($date));
                            }elseif ($i != 10 && $i != 11) {
                                $formatData[$key][$heading[$i]] = $row[$i];
                            } elseif ($i == 10) {
                                $formatData[$key]['type'] = $type;
                            } elseif ($i == 11) {
                                $formatData[$key]['user_id'] = Auth::user()->id;
                            }

                        }


                    }


                }

                DepartmentOfCustom::insert($formatData) ;
            }


            $this->_data['type'] = $type;
            $this->_data['formatData'] = $formatData;


            $this->_data['items'] = Item::pluck('name', 'id')->skip(0)->take(10);
            $this->_data['units'] = MeasurementUnit::pluck('name', 'id')->toArray();
           // return view($this->_page . 'verify_excel_data', $this->_data);
            return redirect()->route('department-of-custom', $type)->with('success', 'Your Information has been Added .');
        }

    }

    public function getSample(Request $request, $type)
    {

        return Excel::download(new DOCExport("sample", $type), 'department_of_custom_export.xlsx');
    }

    public function importExport(Request $request)
    {
        $query = PermissionForExportImport::query();

        $this->_data['from_date'] = $this->_data['to_date'] = $this->_data['today'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

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


        if (auth()->user()->role_id == 3) {
            $query->where('user_id', auth()->user()->id);
        }

        $data = $query->get();

        $this->_data['columns'] = Schema::getColumnListing('permission_for_export_import');

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
        return view($this->_page . 'permission_for_import_export', $this->_data);
    }

    public function importExportAction(Request $request)
    {
        foreach ($request->data as $key => $data) {
            $data['user_id'] = Auth::user()->id;
            $data['locked'] = 1;
            if (!empty($data['date'])) {
                // dd($data);
                PermissionForExportImport::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('permission_import_export')->with('success', 'Your Information has been Added .');
    }
}
