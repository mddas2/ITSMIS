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
            <h3 class="card-label">Input as per monthly progress report to be provided to ministry</h3>
        </div>
        <div class="card-toolbar">
			<a data-fancybox data-type="ajax" data-src="{{route('industries.create')}}" class="btn btn-primary btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>New Industries</a>&nbsp;
			
			<a  class="btn btn-success btn-sm" href="{{route('monthly_progress_report_industry_import')}}"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Entry Date</label>
					<input name="entry_date" class="form-control datepicker" value={{$currentDate}} required>
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
		<form class="form" id="kt_form" action="{{route('monthly-progress-report-industries',['fiscal_year_id'=> $fiscalYearId])}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th rowspan="2">SN</th>
	                    <th rowspan="2" style="min-width: 500px !important;">Indicators</th>
	                    <th colspan="2">Unit</th>
	                    <th rowspan="2">Actions</th>
	                </tr>
	                <tr>
	                	<th>Number</th>
	                	<th>Progress</th>

	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0;?>
	                @foreach($industryData as $data)
	                <?php //dd($data);?>
	                <tr>
	                    <td>{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][entry_date]" value="{{$currentDate}}">
	                    	<input type="hidden" name="data[{{$key}}][id]" value="{{$data['id']}}">
	                    	<input type="hidden" name="data[{{$key}}][industry_id]" value="{{$data['industry_id']}}" class="form-control" >
	                    	<input type="text" name="data[{{$key}}][name]" value="{{$data['name']}}" class="form-control" autocomplete="off">
	                    </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][number]" value="{{$data['number']}}" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][progress]" value="{{$data['progress']}}" class="form-control" autocomplete="off">
						</td>
	                    <td>
	                        <a href="" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
	                    </td>
	                </tr>
	                @php $key++; @endphp
	                @endforeach
	                <tr id="firstRow">
	                    <td class="sn">{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][entry_date]" value="{{$currentDate}}" class="currentDate">
	                    	<input type="hidden" name="data[{{$key}}][id]" value="">
	                    	<input type="text" name="data[{{$key}}][name]" class="form-control" autocomplete="off">
	                   </td>
	                   <td>
	                    	<input type="text" name="data[{{$key}}][number]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][progress]" class="form-control" autocomplete="off">
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
	            		<td colspan="3"></td>
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
	$('.monthlyProgressReport').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true ,
             paging: false
        });

    var key = {!! $key !!};
    var tableCnt  = $('#tb_id tr').length;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='data["+key+"][name]']",rowClone).val("");
		$("[name='data["+key+"][number]']",rowClone).val("");
		$("[name='data["+key+"][progress]']",rowClone).val("");

		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][entry_date]']",rowClone).attr('name','data['+tableCnt+'][entry_date]');
		$("[name='data["+key+"][name]']",rowClone).attr('name','data['+tableCnt+'][name]');
		$("[name='data["+key+"][number]']",rowClone).attr('name','data['+tableCnt+'][number]');
		$("[name='data["+key+"][progress]']",rowClone).attr('name','data['+tableCnt+'][progress]');
		$("td#remRow",rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
		$('.sn',rowClone).html(tableCnt + 1);
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
