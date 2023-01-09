<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MonthlyProgressReportIndustryExport;
use App\Imports\MonthlyProgressReportIndustryImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FiscalYear;

class ReportBulkImportController extends Controller
{
    private $_app = "";
    private $_page = "pages.report_bulk_import.";
    private $_data = [];

    public function __construct()
    {
        $this->_data['page_title'] = 'Manage Report Input';
    }

    public function monthlyProgressReportIndustryImport()
    {
        $this->_data['fiscalYear'] = FiscalYear::pluck('name','id');
        return view($this->_page.'monthly_progress_report_industry',$this->_data);
    }

    public function monthlyProgressReportIndustryImportAction(Request $request)
    {
        Excel::import(new MonthlyProgressReportIndustryImport($request->fiscal_year_id), request()->file('sample_excel'));
        return redirect()->back()->with('success', 'Your Information has been Added .');
    }

    public function monthlyProgressReportIndustryExport()
    {
        return Excel::download(new MonthlyProgressReportIndustryExport("sample"), 'monthly_progress_report_industry_sample.xlsx');
    }
}
