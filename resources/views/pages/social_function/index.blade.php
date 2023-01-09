@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Manage Social Function Types</h3>
        </div>
    </div>
	<div class="card-body">
		<form class="form" id="kt_form" action="{{route('social_functions.store')}}" method="post">
	 		{{csrf_field()}}
	 		<div class="table-responsive">
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th style="min-width: 100px;">SN</th>
	                    <th>Name</th>
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
	            		<td colspan="1"></td>
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
		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][name]']",rowClone).attr('name','data['+tableCnt+'][name]');
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
