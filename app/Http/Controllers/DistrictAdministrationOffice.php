<?php

namespace App\Http\Controllers;

use App\Exports\DaoExport;
use App\Imports\DaoImport;
use App\Models\DaoMarketMonitoring;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DistrictAdministrationOffice extends Controller
{
    private $_page = "pages.district_administration_office.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'District Administration Office';
        $this->_data['header'] = true;
    }

    public function marketMonitoring(Request $request)
    {
        $query = DaoMarketMonitoring::query();

        $this->_data['from_date'] = $this->_data['to_date'] = $this->_data['today'] = DB::table('nepali_calendar')->where('edate',date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date') && $request->has('to_date')) {
            $this->_data['from_date'] = $request->from_date;
            $this->_data['to_date'] = $request->to_date;
        }

        if (!empty($this->_data['from_date']) && !empty($this->_data['to_date'])) {
            $query->whereBetween('date',[$this->_data['from_date'],$this->_data['to_date']]);
        } else if (!empty($this->_data['from_date'])) {
            $query->where('date','>=',$this->_data['from_date']);
        } else {
            $query->where('date','=<',$this->_data['to_date']);
        }

        if (auth()->user()->role_id == 3) {
            $query->where('user_id',auth()->user()->id);
        }

        $data = $query->get();
        $this->_data['columns'] = Schema::getColumnListing('dao_market_monitorings');

        $this->_data['data'] = $data;
        $this->_data['user'] = User::find(Auth::id());


        $hierarchyId = auth()->user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {
                    if ($key != count($parentHierarchy)-1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ?' -> ':' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }

                }
            }
        }

        return view($this->_page . 'market_monitoring_create', $this->_data);
    }

    public function marketMonitoringAction(Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['user_id'] = Auth::user()->id;
            $data['locked'] = 1;
            if (!empty($data['no_of_monitored_firm'])) {
                // dd($data);

                DaoMarketMonitoring::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('dao_market_monitoring')->with('success', 'Your Information has been Added .');
    }

    public function marketMonitoringReport(Request $request)
    {
        $query = DaoMarketMonitoring::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate',date('Y-m-d'))->pluck('ndate')->first();
        $this->_data['user_id'] = "0";

        if ($request->has('from_date') && $request->has('to_date')) {
            $this->_data['from_date'] = $request->from_date;
            $this->_data['to_date'] = $request->to_date;
        }

        if (!empty($this->_data['from_date']) && !empty($this->_data['to_date'])) {
            $query->whereBetween('date',[$this->_data['from_date'],$this->_data['to_date']]);
        } else if (!empty($this->_data['from_date'])) {
            $query->where('date','>=',$this->_data['from_date']);
        } else {
            $query->where('date','=<',$this->_data['to_date']);
        }

        if ($request->has('user_id')) {
            $query->where('user_id',$request->user_id);
            $this->_data['user_id'] = $request->user_id;
        }

        $this->_data['data'] = $query->get();

        if (auth()->user()->role_id == 2) {
            $this->_data['hierarchyId'] = auth()->user()->hierarchy->hierarchy_id;
            $this->_data['officeId'] = auth()->user()->office_id;
        }
        $this->_data['columns'] = Schema::getColumnListing('dao_market_monitorings');

        $hierarchyId = auth()->user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {
                    if ($key != count($parentHierarchy)-1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ?' -> ':' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }

                }
            }
        }

        $hierarchyId = auth()->user()->hierarchy->hierarchy_id;
        $parentHierarchy = Hierarchy::ancestorsAndSelf($hierarchyId)->toArray();
        $this->_data['hierarchyTitle'][0] = "";
        $this->_data['hierarchyTitle'][1] = "";
        if (count($parentHierarchy) > 1) {
            foreach ($parentHierarchy as $key => $parent) {
                if ($key > 0) {
                    if ($key != count($parentHierarchy)-1) {
                        $this->_data['hierarchyTitle'][0] .= $parent['name'];
                        $this->_data['hierarchyTitle'][0] .= ($key != count($parentHierarchy) - 2) ?' -> ':' -> ';
                    } else {
                        $this->_data['hierarchyTitle'][1] .= $parent['name'];
                    }

                }
            }
        }

        return view($this->_page . 'market_monitoring_report', $this->_data);
    }

    public function updateLock(Request $request)
    {
        $query = DaoMarketMonitoring::query();

        if ($request->has('id')) {
            $query->where('id',$request->id);
        }

        $data = $query->update(['locked' => $request->lock]);

        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function marketMonitoringExcel(Request $request)
    {
        return view($this->_page.'market_monitoring_excel',$this->_data);
    }

    public function marketMonitoringExcelAction (Request $request)
    {
        $data = Excel::toArray(new DaoImport(),$request->file('sample_excel'));
        $formatData = [];
        $this->_data['columns'] = $heading = Schema::getColumnListing('dao_market_monitorings');

        foreach ($heading as $key=>$head) {
            if(in_array($head, ['id','user_id','locked','created_at','updated_at'])) {
                unset($heading[$key]);
            }
        }

        $heading = array_values($heading);
        foreach ($data[0] as $key=>$row) {
            if ($key > 0 && !empty($row[0])) {
                for ($i=0; $i < count($heading) ; $i++) {
                    $formatData[$key][$heading[$i]] = $row[$i];
                }
            }
        }

        $this->_data['formatData'] = $formatData;

        return view($this->_page . 'verify_market_monitoring_excel', $this->_data);
    }

    public function getMarketMonitoringSample (Request $request,$type)
    {
        return Excel::download(new DaoExport("sample",$type), 'market_monitoring_DAO.xlsx');
    }

    public function marketMonitoringImportColumn()
    {
        return view($this->_page . 'market_monitoring_import_column', $this->_data);
    }

    public function marketMonitoringImportColumnAction(Request $request)
    {
        $data = $request->except('_token');

        Schema::table('dao_market_monitorings', function (Blueprint $table) use ($data) {
            if ($data['data_type'] == "String") {
                $table->string($data['column_name'],255)->nullable();
            } else if ($data['data_type'] == "Integer") {
                $table->integer($data['column_name'],11)->nullable();
            } else {
                $table->text($data['column_name'])->nullable();
            }
        });

        return redirect()->back()->with('success', 'New Column has been Added.');
    }
}
