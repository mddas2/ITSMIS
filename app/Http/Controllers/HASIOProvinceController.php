<?php

namespace App\Http\Controllers;

use App\Exports\HasioExport;
use App\Imports\HasioImport;
use App\Models\HasioFirmRegistration;
use App\Models\HasioMarketMonitoring;
use App\Models\HasioTraining;
use App\Models\TrainingType;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Hierarchy;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class HASIOProvinceController extends Controller
{
    private $_page = "pages.province.home_small_industries_office.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Home And Small Industries Office';
        $this->_data['header'] = true;
    }

    public function marketMonitoring(Request $request)
    {
        $query = HasioMarketMonitoring::query();

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
        $this->_data['columns'] = Schema::getColumnListing('hasio_market_monitorings');

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
                HasioMarketMonitoring::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('hasio_market_monitoring')->with('success', 'Your Information has been Added .');
    }

    public function marketMonitoringReport(Request $request)
    {
        $query = HasioMarketMonitoring::query();

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
        $this->_data['columns'] = Schema::getColumnListing('hasio_market_monitorings');

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
        $query = HasioMarketMonitoring::query();

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
        $data = Excel::toArray(new HasioImport(),$request->file('sample_excel'));
        $formatData = [];
        $this->_data['columns'] = $heading = Schema::getColumnListing('hasio_market_monitorings');

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
        return Excel::download(new HasioExport("sample",$type), 'market_monitoring_HASIO.xlsx');
    }

    public function marketMonitoringImportColumn()
    {
        return view($this->_page . 'market_monitoring_import_column', $this->_data);
    }

    public function marketMonitoringImportColumnAction(Request $request)
    {
        $data = $request->except('_token');

        Schema::table('hasio_market_monitorings', function (Blueprint $table) use ($data) {
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



    //*********************************FIRM REGISTRATION ***********************************************//
    public function firmRegistration (Request $request)
    {
        $query = HasioFirmRegistration::query();
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

        $this->_data['data'] = $query->get();
        $this->_data['columns'] = Schema::getColumnListing('hasio_firm_registrations');
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

        return view($this->_page . 'firm_registration_create', $this->_data);
    }

    public function firmRegistrationAction (Request $request)
    {
        foreach($request->data as $key=>$data) {
            $data['user_id'] = Auth::user()->id;
            // $data['type_of_registered_firm'] = explode(",", $data['type_of_registered_firm']);
            // $data['type_of_registered_firm'] = serialize($data['type_of_registered_firm']);

            // $data['type_of_firm'] = explode(",", $data['type_of_firm']);
            // $data['type_of_firm'] = serialize($data['type_of_firm']);
            $data['locked'] = 1;
            if (!empty($data['date'])) {
                HasioFirmRegistration::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('hasio_firm_registration')->with('success', 'Your Information has been Added .');
    }

    public function updateLockFirmRegistration(Request $request)
    {
        $query = HasioFirmRegistration::query();

        if ($request->has('id')) {
            $query->where('id',$request->id);
        }

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function firmRegistrationExcel(Request $request)
    {
        return view($this->_page.'firm_registration_excel',$this->_data);
    }

    public function getfirmRegistrationSample(Request $request,$type)
    {
        return Excel::download(new HasioExport("sample",$type), 'firm_registration_HASIO.xlsx');
    }

    public function firmRegistrationExcelAction (Request $request)
    {
        $data = Excel::toArray(new HasioImport(),$request->file('sample_excel'));
        $formatData = [];
        $this->_data['columns'] = $heading = Schema::getColumnListing('hasio_firm_registrations');

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

        return view($this->_page . 'verify_firm_registration', $this->_data);
    }

    public function firmRegistrationReport(Request $request)
    {
        $query = HasioFirmRegistration::query();

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
            $this->_data['officeId'] = auth()->user()->office_id;
            $this->_data['hierarchyId'] = auth()->user()->hierarchy->hierarchy_id;

        }
        $this->_data['columns'] = Schema::getColumnListing('dcsc_firm_registrations');

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
        return view($this->_page . 'firm_registration_report', $this->_data);
    }

    public function firmRegistrationImportColumn()
    {
        return view($this->_page . 'firm_registration_import_column', $this->_data);
    }

    public function firmRegistrationImportColumnAction(Request $request)
    {
        $data = $request->except('_token');
        Schema::table('hasio_firm_registrations', function (Blueprint $table) use ($data) {
            if ($data['data_type'] == "String") {
                $table->string($data['column_name'],255)->nullable();
            } else if ($data['data_type'] == "Integer") {
                $table->integer($data['column_name'],11)->nullable();
            } else {
                $table->text($data['column_name'])->nullable();
            }
        });
        return redirect()->back()->with('success', 'New Column has been Added .');
    }



    /*------------ Training --------------*/

    public function addTraining(Request $request)
    {


        $query = HasioTraining::query();

        $this->_data['from_date'] = $this->_data['to_date'] = DB::table('nepali_calendar')->where('edate', date('Y-m-d'))->pluck('ndate')->first();

        if ($request->has('from_date')) {
            $this->_data['from_date'] = $request->from_date;
        }

        if ($request->has('to_date')) {
            $this->_data['to_date'] = $request->to_date;
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

        //$this->_data['columns'] = Schema::getColumnListing('hasio_training');
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
                HasioTraining::updateOrCreate(
                    ['id' => $data['id']],
                    $data
                );
            }
        }

        return redirect()->route('hasio_addTraining')->with('success', 'Your Information has been Added .');
    }


    public function updateLockTraining(Request $request)
    {
        $query = HasioTraining::query();

        if ($request->has('id')) {
            $query->where('id',$request->id);
        }

        $data = $query->update(['locked' => $request->lock]);
        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function trainingExcel(Request $request)
    {


        return view($this->_page.'training_excel',$this->_data);
    }

    public function getTrainingSample(Request $request,$type)
    {
        return Excel::download(new HasioExport("sample",$type), 'training_HASIO.xlsx');
    }

    public function trainingExcelAction (Request $request)
    {
        $data = Excel::toArray(new HasioImport(),$request->file('sample_excel'));
        $formatData = [];
        $this->_data['columns'] = $heading = Schema::getColumnListing('hasio_training');

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

        return view($this->_page . 'verify_training_registration', $this->_data);
    }

    public function trainingReport(Request $request)
    {
        $query = HasioTraining::query();

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
            $this->_data['officeId'] = auth()->user()->office_id;
            $this->_data['hierarchyId'] = auth()->user()->hierarchy->hierarchy_id;

        }
        $this->_data['columns'] = Schema::getColumnListing('dcsc_firm_registrations');

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
        return view($this->_page . 'training_report', $this->_data);
    }


}
