@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">{{ __('lang.fiscal_year')}}
            </h3>
        </div>
        <!-- <div class="card-toolbar">
			<a  class="btn btn-success btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		</div> -->
    </div>
    <div class="card-body">
	 	<form class="form" id="kt_form" action="{{route('fiscal_years.store')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th>SN</th>
	                    <th>Name</th>
	                    <th>Duration</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0;?>
	                @foreach($data as $fiscalYear)
	                <tr>
	                    <td>{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="fiscal_year[{{$key+1}}][id]" value="{{$fiscalYear->id}}">
	                    	<input type="text" class="form-control" name="fiscal_year[{{$key+1}}][name]" placeholder="Enter Name" value="{{$fiscalYear->name}}" required autocomplete="off" disabled>
	                    </td>
	                    <td>
	                    	<div class="input-daterange input-group">
								<input type="text" class="form-control datepicker" name="fiscal_year[{{$key+1}}][from_date]" placeholder="From " autocomplete="off" value="{{$fiscalYear->from_date}}" disabled/>
								<div class="input-group-append">
									<span class="input-group-text" style="background-color: white;"><i class="fa fa-calendar-alt"></i></span>
								</div>
								<input type="text" class="form-control datepicker" name="fiscal_year[{{$key+1}}][to_date]" placeholder="To" autocomplete="off" value="{{$fiscalYear->to_date}}" disabled/>
							</div>
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
	                    	<input type="hidden" name="fiscal_year[{{$key+1}}][id]" value="">
	                    	<input type="text" class="form-control" name="fiscal_year[{{$key+1}}][name]" placeholder="Enter Name" autocomplete="off"></td>
	                    <td>
	                    	<div class="input-daterange input-group">
								<input type="text" class="form-control datepicker" name="fiscal_year[{{$key+1}}][from_date]" placeholder="From " autocomplete="off" />
								<div class="input-group-append">
									<span class="input-group-text" style="background-color: white;"><i class="fa fa-calendar-alt"></i></span>
								</div>
								<input type="text" class="form-control datepicker" name="fiscal_year[{{$key+1}}][to_date]" placeholder="To" autocomplete="off" />
							</div>
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
	            		<td colspan="2"></td>
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

   	var key = 2;
    var tableCnt  = $('#tb_id tr').length+1;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='fiscal_year["+key+"][name]']",rowClone).val("");
		$("[name='fiscal_year["+key+"][from_date]']",rowClone).val("");
		$("[name='fiscal_year["+key+"][to_date]']",rowClone).val("");
		
		$("[name='fiscal_year["+key+"][name]']",rowClone).attr('name','fiscal_year['+tableCnt+'][name]');
		$("[name='fiscal_year["+key+"][from_date]']",rowClone).attr('name','fiscal_year['+tableCnt+'][from_date]');
		$("[name='fiscal_year["+key+"][to_date]']",rowClone).attr('name','fiscal_year['+tableCnt+'][to_date]');
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

	var arrows = {
      	leftArrow: '<i class="la la-angle-right"></i>',
      	rightArrow: '<i class="la la-angle-left"></i>'
    };

	// $(document).on('focus',".datepicker", function(){
	//     $(this).nepaliDatePicker({
 //            language: "english",
 //            ndpYear: true,
 //            ndpMonth: true,
 //            ndpYearCount: 10
 //        });
	// });

	$('.edit').click(function(e){
		e.preventDefault();
		$(this).parents('tr').find('input').attr('disabled',false);
	});
</script>
@endsection