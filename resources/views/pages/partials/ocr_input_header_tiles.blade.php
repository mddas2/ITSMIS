<?php $fiscal_year = session('fiscal_year');?>
<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
	<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
		<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center monthlyProgressReport"  href="{{route('monthly_progress_report_ocr',['fiscal_year_id' =>$fiscal_year->id ])}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="far fa-chart-bar icon-2x"></i>
				</span>
			</span>
			<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Monthly Progress Report</span>
		</a>
	</li>
	<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
		<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center disaggData" href="{{route('disaggregated_data_ocr',['fiscal_year_id' =>$fiscal_year->id,'company_type' => 'public'])}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
			<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Disaggregated Data</span>
		</a>
	</li>
</ul>