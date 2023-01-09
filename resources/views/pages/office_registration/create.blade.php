@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
            	Office of Company Registration 
        	</h3>
        </div>
        <div class="card-toolbar">
        	<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('office_registration_excel')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Entry Date</label>
					<input name="entry_date" class="form-control nepdatepicker"  required>
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('office_registration')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th>SN</th>
	                    <th>Date</th>
	                    <th>No of Registered Company</th>
	                    <th>
	                    	Types Of Company 
	                    	<span class="d-block text-muted pt-2 font-size-sm">add comma separated</span>
	                    </th>
                     	<th>Revenue Raised</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0; $lock=1;?>
	                @foreach($data as $row)

	                <?php 
	                	if ($row->locked == 1) {
	                		$disabled = "disabled";
	                	} else {
	                		$disabled = "false";
	                	}
	                ?>
	                <tr>
	                    <td>{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
	                    	<input type="text" name="data[{{$key}}][date]" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row->date}}" {{$disabled}}>
	                   </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][no_of_registered_company]" class="form-control" autocomplete="off" value="{{$row->no_of_registered_company}}" {{$disabled}}>
						</td>
						<td>
							<?php 
								$unserialize = unserialize($row->types_of_company);
								$types = implode(",",$unserialize);
							?>
	                    	<input type="text" name="data[{{$key}}][types_of_company]" class="form-control" autocomplete="off" value="{{$types}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue_raised]" class="form-control" autocomplete="off" value="{{$row->revenue_raised}}" {{$disabled}}>
						</td>
	                    <td>
	                    	<?php if ($disabled != "disabled") {?>
	                        <a href="" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        	<?php }?>
	                    </td>
	                    <?php if ($row->locked == 1) {
	                    	$lock = 0;
	                    }?>
	                </tr>
	                @php $key++; @endphp
	                @endforeach
	                <tr id="firstRow">
	                    <td class="sn">{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][id]" value="">
	                    	<input type="text" name="data[{{$key}}][date]" class="form-control nepdatepicker" autocomplete="off" id="nepstart1">
	                   </td>
	                   <td>
	                    	<input type="text" name="data[{{$key}}][no_of_registered_company]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][types_of_company]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue_raised]" class="form-control" autocomplete="off">
						</td>
	                    <td id='remRow'>
	                       
	                    </td>
	                </tr>
	            </tbody>
	            <tfoot>
	            	<tr>
	            		<td colspan="2">
	            			<button class="btn btn-primary btn-sm add" type="button">
	            				<i class="fa fa-plus icon-sm"></i>Add New Row
	            			</button>
	            		</td>
	            		<td colspan="2"></td>
	            		<td colspan="2">
	            			<button class="btn btn-success btn-sm" type="submit">
	            				<i class="fa fa-plu icon-sm"></i>Save Changes
	            			</button>
	            			<?php if ($lock == 1) {?>
	            			<a class="btn btn-info btn-sm" href="{{route('office_registration_lock',['lock' => 1])}}">
	            				<i class="fa fa-lock icon-sm"></i>Lock All
	            			</a>
	            			<?php } else {?>
            				<a class="btn btn-danger btn-sm" href="{{route('office_registration_lock',['lock' => 0])}}">
	            				<i class="fa fa-unlock icon-sm"></i>Unlock All
	            			</a>
            				<?php } ?>
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
	$('.marketMonitoring').addClass("active");
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
    	$("[name='data["+key+"][date]']",rowClone).val("");
    	$("[name='data["+key+"][date]']",rowClone).attr('id',"nepstart"+tableCnt+1);
		$("[name='data["+key+"][no_of_registered_company]']",rowClone).val("");
		$("[name='data["+key+"][types_of_company]']",rowClone).val("");
    	$("[name='data["+key+"][revenue_raised]']",rowClone).val("");

		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][date]']",rowClone).attr('name','data['+tableCnt+'][date]');
		$("[name='data["+key+"][no_of_registered_company]']",rowClone).attr('name','data['+tableCnt+'][no_of_registered_company]');
		$("[name='data["+key+"][types_of_company]']",rowClone).attr('name','data['+tableCnt+'][types_of_company]');
		$("[name='data["+key+"][revenue_raised]']",rowClone).attr('name','data['+tableCnt+'][revenue_raised]');
		$("td#remRow",rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
		$('.sn',rowClone).html(tableCnt + 1);
    	tb_id.append(rowClone);
    	tableCnt++;


    	$('.nepdatepicker').nepaliDatePicker(/*{
	        language: "english",
	        ndpYear: true,
	        ndpMonth: true,
	        ndpYearCount: 10
	    }*/);

    	
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

	$('.nepdatepicker').nepaliDatePicker(/*{
	 language: "english",
	 ndpYear: true,
	 ndpMonth: true,
	 ndpYearCount: 10
	 }*/);
</script>
@endsection
