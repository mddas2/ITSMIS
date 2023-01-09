@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Arrangement of supply of essential commodities</h3>
        </div>
        <div class="card-toolbar">
			<a data-fancybox data-type="ajax" data-src="{{route('commodities_supply.create',['fiscal_year_id'=>$fiscalYearId])}}" class="btn btn-primary btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('lang.add_new_data')}}</a>&nbsp;
			<a  class="btn btn-success btn-sm" href="{{route('bulk_excel_commodities_supply')}}"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Fiscal Year</label>
					{{Form::select('fiscal_year_id',$fiscalYear,$fiscalYearId,['class' => 'form-control'])}}
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('bulk_commidities_supply',['fiscal_year_id'=> $fiscalYearId])}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th rowspan="2">SN</th>
	                    <th rowspan="2" style="min-width: 160px !important;">Products</th>
	                    <th>A</th>
	                    <th>B</th>
	                    <th>C</th>
	                    <th>D</th>
	                    <th>E</th>
	                    <th>F</th>
	                    <th rowspan="2">Remarks</th>
	                    <th rowspan="2">Actions</th>
	                </tr>
	                <tr>
	                	<th>Opening Stock</th>
	                	<th>Productive</th>
	                	<th>Import</th>
	                	<th>Export</th>
	                	<th>Consumption</th>
	                	<th>Closing Stock</th>

	                </tr>
	            </thead>
		        <tbody id="tb_id">
	            	<?php $key = 0;?>
	                @foreach($data as $row)
	                <tr>
	                    <td>{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
	                    	<input type="hidden" name="data[{{$key}}][fiscal_year_id]" value="{{$fiscalYearId}}">
	                    	@php $cnt = $key; @endphp
	                    	{{Form::select('data['.$cnt.'][item_id]',$items,$row->item_id,['class' => 'form-control','disabled'=>true])}}
	                    </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][opening]" value="{{$row->opening}}" class="form-control" disabled>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][productive]" value="{{$row->productive}}" class="form-control" disabled>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][import]" value="{{$row->import}}" class="form-control" disabled>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][export]" value="{{$row->export}}" class="form-control" disabled>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][consumption]" value="{{$row->consumption}}" class="form-control" disabled>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][closing]" value="{{$row->closing}}" class="form-control" disabled>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][remarks]" value="{{$row->remarks}}" class="form-control" disabled>
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
	                    	<input type="hidden" name="data[{{$key}}][fiscal_year_id]" value="{{$fiscalYearId}}">
	                    	@php $cnt = $key; @endphp
	                    	{{Form::select('data['.$cnt.'][item_id]',$items,"",['class' => 'form-control'])}}
	                   </td>
	                   <td>
	                    	<input type="text" name="data[{{$key}}][opening]" class="form-control">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][productive]" class="form-control">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][import]" class="form-control">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][export]" class="form-control">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][consumption]" class="form-control">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][closing]" class="form-control">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][remarks]" class="form-control">
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
	            		<td colspan="8"></td>
	            		<td>
	            			<button class="btn btn-success btn-sm" type="submit">
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
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true 
        });

    var key = {!! $key !!};
    var tableCnt  = $('#tb_id tr').length;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='data["+key+"][item_id]']",rowClone).val("");
		$("[name='data["+key+"][opening]']",rowClone).val("");
		$("[name='data["+key+"][productive]']",rowClone).val("");
		$("[name='data["+key+"][import]']",rowClone).val("");
		$("[name='data["+key+"][export]']",rowClone).val("");
		$("[name='data["+key+"][consumption]']",rowClone).val("");
		$("[name='data["+key+"][closing]']",rowClone).val("");
		$("[name='data["+key+"][remarks]']",rowClone).val("");
		
		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][item_id]']",rowClone).attr('name','data['+tableCnt+'][item_id]');
		$("[name='data["+key+"][opening]']",rowClone).attr('name','data['+tableCnt+'][opening]');
		$("[name='data["+key+"][productive]']",rowClone).attr('name','data['+tableCnt+'][productive]');
		$("[name='data["+key+"][import]']",rowClone).attr('name','data['+tableCnt+'][import]');
		$("[name='data["+key+"][export]']",rowClone).attr('name','data['+tableCnt+'][export]');
		$("[name='data["+key+"][consumption]']",rowClone).attr('name','data['+tableCnt+'][consumption]');
		$("[name='data["+key+"][closing]']",rowClone).attr('name','data['+tableCnt+'][closing]');
		$("[name='data["+key+"][remarks]']",rowClone).attr('name','data['+tableCnt+'][remarks]');
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
