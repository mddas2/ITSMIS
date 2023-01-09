@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
	<div class="card-body">
		@include('pages.partials.industry_input_header_tiles')
	</div>
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Training Attendees Report</h3>
        </div>
          <div class="card-toolbar">
			<a  class="btn btn-success btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Fiscal Year</label>
					{{Form::select('fiscal_year_id',$fiscalYear,$fiscalYearId,['class' => 'form-control'])}}
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('training_attendees_report',['fiscal_year_id'=> $fiscalYearId])}}" method="post">
	 		{{csrf_field()}}
	 		<div class="table-responsive">
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th style="min-width: 100px;">SN</th>
	                    <th style="min-width: 300px;">Name Of Training</th>
	                     <?php 
		                	$arr = [
		                		'Training Duration',
		                		'Attendees',
		                		'Completed Training',
		                		'Trainners',
		                		'Assistant Trainers',
		                		'Attendees want to involve in employment',
		                		'Attendees want to involve in self-employment',
		                		'Training Supervision',
		                	];
		                ?>
	                 	@foreach($arr as $a)
                     	<th>{{$a}}</th>
                     	@endforeach
	                    <th style="min-width: 220px;">Remarks</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0;?>
		            	@foreach ($data as $row)
		            		<tr>
			                    <td>{{$key+1}}</td>
			                    <td>
			                    	<input type="hidden" name="data[{{$key}}][id]" value="{{$row['id']}}">
			                    	<input  type="text" name="data[{{$key}}][name]" class="form-control" value="{{$row['name']}}" disabled>
			                    </td>
								<?php 
									$arr = unserialize($row['attendes_report']);
								?>
								@foreach ($arr as $k=>$a)
								<td>
			                    	<input type="text" name="data[{{$key}}][attendes_report][{{$k}}]" class="form-control" disabled value={{$a}}>
								</td>
								@endforeach
								<td>
			                    	<input type="text" name="data[{{$key}}][remarks]" value="{{$row['remarks']}}" class="form-control" disabled>
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
		                    	<input type="text" name="data[{{$key}}][name]" class="form-control" >
		                   	</td>
							@foreach ($arr as $a)
							<td>
		                    	<input type="text" name="data[{{$key}}][attendes_report][{{$a}}]" class="form-control">
							</td>
							@endforeach
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
	            		<td colspan="10"></td>
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
	$('.trainingAttendees').addClass("active");
	var arr = {!! json_encode($arr) !!};
    var table = $('#kt_datatable');
    table.DataTable({
            scrollX: true
        });

    var key = {!! $key !!};
    var tableCnt  = $('#tb_id tr').length;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='data["+key+"][name]']",rowClone).val("");
		$("[name='data["+key+"][remarks]']",rowClone).val("");
		Object.keys(arr).forEach(function(k){
			$("[name='data["+key+"][attendes_report]["+arr[k]+"]']",rowClone).val("");
		});

		
		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][name]']",rowClone).attr('name','data['+tableCnt+'][name]');
		$("[name='data["+key+"][remarks]']",rowClone).attr('name','data['+tableCnt+'][remarks]');
		Object.keys(arr).forEach(function(k){
			$("[name='data["+key+"][attendes_report]["+arr[k]+"]']",rowClone).attr('name','data['+tableCnt+'][attendes_report]['+arr[k]+']');
		});
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
