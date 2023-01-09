@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
	<div class="card-body">
		@include('pages.partials.dor_input_header_tiles')
	</div>
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Disaggregated Data</h3>
        </div>
        <div class="card-toolbar">
			<a  class="btn btn-success btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		</div>
    </div>
	<div class="card-body">
		<form method="get" action="{{route('disaggregated_data_industry')}}" id="filterForm">
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Entry Date</label>
					<input name="entry_date" class="form-control datepicker" value={{$currentDate}} required>
				</div>
				<div class="col-lg-3">
					<label>Fiscal Year</label>
					{{Form::select('fiscal_year_id',$fiscalYear,$fiscalYearId,['class' => 'form-control'])}}
				</div>
				<div class="col-lg-3">
					<label>Size Wise Category</label>
					<?php 
						$category = [
							"micro" => "Micro Enterprise",
							"cottage" => "Cottage Industry",
							"large" => "Large Industry",
							"medium" => "Medium Industry",
							"small" => "Small Industry"
						]
					?>
					{{Form::select('industry_size',$category,$industrySize,['class' => 'form-control industry'])}}
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('disaggregated_data_industry',['fiscal_year_id'=> $fiscalYearId,'industry_size' => $industrySize])}}" method="post">
	 		{{csrf_field()}}
	 		@if (in_array($industrySize,["micro","cottage"]))
	 			@include('pages.partials.disaggregated_data_industry.micro_cottage')
	 		@else
	 			@include('pages.partials.disaggregated_data_industry.large_medium_small')
	 		@endif
        </form>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script type="text/javascript">
	$('.disaggData').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true 
        });

	$('.filter').click(function(e){
		$('#filterForm').submit();
	})
</script>
@endsection
