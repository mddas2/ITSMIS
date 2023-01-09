@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
	<div class="card-body">
		@include('pages.partials.ocr_input_header_tiles')
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
		<form method="get" action="{{route('disaggregated_data_ocr')}}" id="filterForm">
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
					<label>Company Type</label>
					<?php 
						$companies = [
							"public" => "Public Company",
							"private" => "Private Company",
							"non_profit" => "Non Profit Company"
						]
					?>
					{{Form::select('company_type',$companies,$companyType,['class' => 'form-control company'])}}
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('disaggregated_data_ocr',['fiscal_year_id'=> $fiscalYearId,'company_type' => $companyType])}}" method="post">
	 		{{csrf_field()}}
	 		<table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
			    <thead>
			        <tr>
			            <th></th>
			            <th>Domestic Investment</th>
			         	<th>Foreign Investment</th>
			      		<th>Domestic + Foreign</th>
			            <th>Employment Creation No</th>
			        </tr>
			    </thead>
			    <tbody id="tb_id">
			    	<?php 
			    		if (!$data->isEmpty()){
			        		foreach($data as $key=>$row) :
					?>
			        <tr>
			            <td>
			                <input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
			                <input type="hidden" name="data[{{$key}}][entry_date]" value="{{$currentDate}}">
			                <input type="hidden" name="data[{{$key}}][province]" value="{{$row->province}}">
			                {{$row->province}}
			            </td>
			            <?php 
			                $params = unserialize($row->param);
			                $value = unserialize($row->value);
			            ?>
			            @foreach ($params as $cnt=>$param)
			                 <td>
			                    <input type="hidden" name="data[{{$key}}][param][$cnt]" value="{{$param[$cnt]}}">
			                    <input type="text" name="data[{{$key}}][value][$cnt]" value="{{$value[$cnt]}}" autocomplete="off" class="form-control">
			                </td>
			            @endforeach
			        </tr>
			        <?php 
			        	endforeach;
			        } else { 
			        	$provinces = ["Province 1","Province 2","Province 3","Province 4","Province 5","Province 6","Province 7"];
			    		foreach ($provinces as $key=>$province):
			    	?>
			    	<tr>
			    		<td>
			                <input type="hidden" name="data[{{$key}}][id]">
			                <input type="hidden" name="data[{{$key}}][entry_date]" value="{{$currentDate}}">
			    			<input type="hidden" name="data[{{$key}}][province]" value="{{$province}}">
							{{$province}}
						</td>
						<td>
			    			<input type="hidden" name="data[{{$key}}][param][0]" value="domestic_investment">
			    			<input type="text" name="data[{{$key}}][value][0]" value="" autocomplete="off" class="form-control">
						</td>
						<td>
			    			<input type="hidden" name="data[{{$key}}][param][1]" value="foreign_investment">
			    			<input type="text" name="data[{{$key}}][value][1]" value="" autocomplete="off" class="form-control">
						</td>
						<td>
			    			<input type="hidden" name="data[{{$key}}][param][2]" value="domestic_foreign">
			    			<input type="text" name="data[{{$key}}][value][2]" value="" autocomplete="off" class="form-control">
						</td>
						<td>
			    			<input type="hidden" name="data[{{$key}}][param][3]" value="employment_creation">
			    			<input type="text" name="data[{{$key}}][value][3]" value="" autocomplete="off" class="form-control">
						</td>
			    	</tr>
			        <?php 
			        	endforeach;
			    		}
			        ?>
			    </tbody>
			    <tfoot>
			    	<tr>
			    		<td colspan="4"></td>
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
	$('.disaggData').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true 
        });

	$('.filter').click(function(e){
		$('#filterForm').submit();
	});
</script>
@endsection
