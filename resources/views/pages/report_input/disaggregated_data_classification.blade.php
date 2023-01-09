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
            <h3 class="card-label">Disaggregated Data (Based On Classification)</h3>
        </div>
        <div class="card-toolbar">
			<a  class="btn btn-success btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		</div>
    </div>
	<div class="card-body">
		<form method="get" action="{{route('disaggregated_data_classification')}}" id="filterForm">
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
		<form class="form" id="kt_form" action="{{route('disaggregated_data_classification',['fiscal_year_id'=> $fiscalYearId,'industry_size' => $industrySize])}}" method="post">
	 		{{csrf_field()}}
 			<table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
			    <thead>
			        <tr>
			            <th>Indicators</th>
			            <th>Total No.</th>
			            <th>Investment</th>
			        </tr>
			    </thead>
			    <tbody id="tb_id">
			    	<?php 
			    		if (!empty($data)){
			    			$indicators = unserialize($data->indicators);
			    			$total_no = unserialize($data->total_no);
			    			$investment = unserialize($data->investment);
			        		foreach($indicators as $key=>$indicator) : 
					?>
			       	<tr>
			    		<td>
			    			<input type="hidden" name="data[id]" value="{{$data->id}}">
			    			<input type="hidden" name="data[entry_date]" value="{{$currentDate}}">
			    			<input type="hidden" name="data[indicators][{{$key}}]" value="{{$indicator}}">
							{{$indicator}}
						</td>
						<td>
			    			<input type="text" name="data[total_no][{{$key}}]" autocomplete="off" class="form-control" value="{{$total_no[$key]}}">
						</td>
						<td>
			    			<input type="text" name="data[investment][{{$key}}]" autocomplete="off" class="form-control" value="{{$investment[$key]}}">
						</td>
			    	</tr>
			        <?php 
			        	endforeach;
			        } else { 
			        	$indicators = [
			        		"Agriculture and forestry",
			        		"Production-oriented",
			        		"Export-oriented",
			        		"Energy-oriented",
			        		"Mining",
			        		"Tourism",
			        		"Construction",
			        		"Information and communication technology",
			        		"Services",
			        		"Total"
			        	];
			    		foreach ($indicators as $key=>$indicator):
			    	?>
			    	<tr>
			    		<td>
			    			<input type="hidden" name="data[id]">
			    			<input type="hidden" name="data[entry_date]" value="{{$currentDate}}">
			    			<input type="hidden" name="data[indicators][{{$key}}]" value="{{$indicator}}">
							{{$indicator}}
						</td>
						<td>
			    			<input type="text" name="data[total_no][{{$key}}]" autocomplete="off" class="form-control">
						</td>
						<td>
			    			<input type="text" name="data[investment][{{$key}}]" autocomplete="off" class="form-control">
						</td>
			    	</tr>
			        <?php 
			        	endforeach;
			    		}
			        ?>
			    </tbody>
			    <tfoot>
			    	<tr>
			    		<td colspan="2"></td>
			    		<td>
			    			<button class="btn btn-success btn-sm text-align-center" type="submit">
			    				<i class="fa fa-plu icon-sm"></i>Save Changes
			    			</button>
			    		</td>
			    	</tr>
			    </tfoot>
			</table>
        </form>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script type="text/javascript">
	$('.disaggClassification').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true ,
            order : false

        });

</script>
@endsection
