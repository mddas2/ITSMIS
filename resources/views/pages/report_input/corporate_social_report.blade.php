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
            <h3 class="card-label">Corporate Social Responsibility Report</h3>
        </div>
        <div class="card-toolbar">
			<a  class="btn btn-success btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		</div>
    </div>
	<div class="card-body">
		<form method="get" action="{{route('corporate_social_responsibility')}}" id="filterForm">
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Entry Date</label>
					<input name="current_date" class="form-control datepicker" value={{$currentDate}} required>
				</div>
				<div class="col-lg-3">
					<label>Fiscal Year</label>
					{{Form::select('fiscal_year_id',$fiscalYear,$fiscalYearId,['class' => 'form-control'])}}
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('corporate_social_responsibility',['fiscal_year_id'=> $fiscalYearId])}}" method="post">
	 		{{csrf_field()}}
	 		<div class="table-responsive">
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th style="min-width: 100px;">SN</th>
	                    <th>Name Of Industry</th>
	                    <th>Social Function</th>
	                    <th>Total Budget</th>
	                    <th>Net Expenditure</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0;?>
		            	@foreach ($data as $row)
		            		<tr>
			                    <td>{{$key+1}}</td>
			                    <td>
			                    	<input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
	                    			{{Form::select('data['.$key.'][industry_id]',$industries,$row->industry_id,['class' => 'form-control','disabled'=>true])}}
			                    </td>
			                    <td>
	                    			{{Form::select('data['.$key.'][social_function_id]',$socialFunction,$row->social_function_id,['class' => 'form-control','disabled'=>true])}}
			                    </td>
								<td>
			                    	<input type="text" name="data[{{$key}}][total_budget]" value="{{$row->total_budget}}" class="form-control" disabled>
								</td>
								<td>
			                    	<input type="text" name="data[{{$key}}][net_expenditure]" value="{{$row->net_expenditure}}" class="form-control" disabled>
								</td>
			                    <td>
			                        <a href="#" class="btn btn-icon btn-success btn-xs mr-2 edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pen"></i></a>
			                        <a href="" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
			                    </td>
			                </tr>
			                 @php $key++; @endphp
		            	@endforeach
	            		<tr id="firstRow">
		                    <td class="sn">{{$key+1}}</td>
		                    <td>
		                    	<input type="hidden" name="data[{{$key}}][id]" value="">
		                    	{{Form::select('data['.$key.'][industry_id]',$industries,null,['class' => 'form-control'])}}
		                   	</td>
							<td>
		                    	{{Form::select('data['.$key.'][social_function_id]',$socialFunction,null,['class' => 'form-control'])}}
							</td>
							<td>
			                    	<input type="text" name="data[{{$key}}][total_budget]" class="form-control" autocomplete="off">
								</td>
								<td>
			                    	<input type="text" name="data[{{$key}}][net_expenditure]" class="form-control" autocomplete="off">
								</td>
		                    <td id='remRow'>
		                       
		                    </td>
		                </tr>
	            </tbody>
	            <tfoot>
	            	<tr>
	            		<td>
	            			<button class="btn btn-primary btn-sm add" type="button">
	            				<i class="fa fa-plus icon-sm"></i>Add New Row
	            			</button>
	            		</td>
	            		<td colspan="4"></td>
	            		<td>
	            			<button class="btn btn-success btn-sm" type="submit">
	            				<i class="fa fa-plu icon-sm"></i>Save Changes
	            			</button>
	            		</td>
	            	</tr>
	            </tfoot>
	        </table>
	    </div>
        </form>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script type="text/javascript">
	$('.corpSocial').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
            scrollX: true
        });

    var key = {!! $key !!};
    var tableCnt  = $('#tb_id tr').length;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='data["+key+"][industry_id]']",rowClone).val("");
		$("[name='data["+key+"][social_function_id]']",rowClone).val("");
		$("[name='data["+key+"][total_budget]']",rowClone).val("");
		$("[name='data["+key+"][net_expenditure]']",rowClone).val("");

		
		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][industry_id]']",rowClone).attr('name','data['+tableCnt+'][industry_id]');
		$("[name='data["+key+"][social_function_id]']",rowClone).attr('name','data['+tableCnt+'][social_function_id]');
		$("[name='data["+key+"][total_budget]']",rowClone).attr('name','data['+tableCnt+'][total_budget]');
		$("[name='data["+key+"][net_expenditure]']",rowClone).attr('name','data['+tableCnt+'][net_expenditure]');
		$("td#remRow",rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
		$('.sn',rowClone).html(tableCnt+1);
    	tb_id.append(rowClone);
    	tableCnt++;
    });

    $(document).on('click', '#remRow', function() {
	    if (tableCnt > 1) {
	        $(this).closest('tr').remove();
	        tableCnt--;
	    }
	    return false;
	});

	$('.edit').click(function(e){
		e.preventDefault();
		$(this).parents('tr').find('input').attr('disabled',false);
		$(this).parents('tr').find('select').attr('disabled',false);
	});
</script>
@endsection
