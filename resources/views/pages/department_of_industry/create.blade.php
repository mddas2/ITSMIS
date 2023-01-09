@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
	@if (!empty($hierarchyTitle))
		@include('pages.partials.hierarchy_detail')
	@endif

	@if (!empty($user->office))
		@include('pages.partials.office_detail')
		<br>
	@endif

<div class="card card-custom gutter-b">
	@include('pages.partials.doi_header_tiles')
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
            	Department Of Industry 
        	</h3>
        </div>
        <div class="card-toolbar">
        	<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('department_of_industries_excel')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>From Date:</label>
					<input name="from_date" class="form-control form-control-solid nepdatepicker" data-single="true"
						   required
						   value="{{$from_date}}">
				</div>
				<div class="col-lg-3">
					<label>To Date:</label>
					<input name="to_date" class="form-control form-control-solid nepdatepicker" data-single="true"
						   required
						   value="{{$to_date}}">
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('department_of_industries')}}" method="post">
	 		{{csrf_field()}}
			<table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th>SN</th>
	                    <th>Date of Registration</th>
	                    <th>Name Of Industry</th>
	                    <th>Location</th>
	                    <th>Category</th>
	                    <th>Production Capacity</th>
	                    <th>Capacity Utilization</th>
	                    <th>Private Firm</th>
	                    <th>Proprietorship</th>
	                    <th>Company</th>
	                    <th>Fixed</th>
	                    <th>Working</th>
	                    <th>Male</th>
	                    <th>Female</th>

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
	                    	<input type="text" name="data[{{$key}}][date_of_registration]"   data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row->date_of_registration}}" {{$disabled}}>
	                   </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][name_of_industry]" class="form-control" autocomplete="off" value="{{$row->name_of_industry}}" {{$disabled}}>
						</td>
						<td>

	                    	<input type="text" name="data[{{$key}}][location]" class="form-control" autocomplete="off" value="{{$row->location}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][category]" class="form-control" autocomplete="off" value="{{$row->category}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][production_capacity]" class="form-control" autocomplete="off" value="{{$row->production_capacity}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][capacity_utilization]" class="form-control" autocomplete="off" value="{{$row->capacity_utilization}}" {{$disabled}}>
						</td>
						<td>
							<input type="text" name="data[{{$key}}][private_firm]" class="form-control" autocomplete="off" value="{{$row->private_firm}}" {{$disabled}}>
						</td>
						<td>
							<input type="text" name="data[{{$key}}][proprietorship]" class="form-control" autocomplete="off" value="{{$row->proprietorship}}" {{$disabled}}>
						</td>
						<td>
							<input type="text" name="data[{{$key}}][company]" class="form-control" autocomplete="off" value="{{$row->company}}" {{$disabled}}>
						</td>
						<td>
							<input type="text" name="data[{{$key}}][fixed]" class="form-control" autocomplete="off" value="{{$row->fixed}}" {{$disabled}}>
						</td>
						<td>
							<input type="text" name="data[{{$key}}][working]" class="form-control" autocomplete="off" value="{{$row->working}}" {{$disabled}}>
						</td>
						<td>
							<input type="text" name="data[{{$key}}][male]" class="form-control" autocomplete="off" value="{{$row->male}}" {{$disabled}}>
						</td>

						<td>
							<input type="text" name="data[{{$key}}][female]" class="form-control" autocomplete="off" value="{{$row->female}}" {{$disabled}}>
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
							<input type="hidden" name="data[{{$key}}][id]"  >
							<input type="text" name="data[{{$key}}][date_of_registration]"   data-single="true" class="form-control nepdatepicker" autocomplete="off"   >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][name_of_industry]" class="form-control" autocomplete="off" >
						</td>
						<td>

							<input type="text" name="data[{{$key}}][location]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][category]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][production_capacity]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][capacity_utilization]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][private_firm]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][proprietorship]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][company]" class="form-control" autocomplete="off">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][fixed]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][working]" class="form-control" autocomplete="off" >
						</td>
						<td>
							<input type="text" name="data[{{$key}}][male]" class="form-control" autocomplete="off" >
						</td>

						<td>
							<input type="text" name="data[{{$key}}][female]" class="form-control" autocomplete="off" >
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
	            		<td colspan="8"></td>
	            		<td colspan="2">
	            			<button class="btn btn-success btn-sm" type="submit">
	            				<i class="fa fa-plu icon-sm"></i>Save Changes
	            			</button>
	            			<?php if ($lock == 1) {?>
	            			<a class="btn btn-info btn-sm" href="{{route('department_of_industries_lock',['lock' => 1])}}">
	            				<i class="fa fa-lock icon-sm"></i>Lock All
	            			</a>
	            			<?php } else {?>
            				<a class="btn btn-danger btn-sm" href="{{route('department_of_industries_lock',['lock' => 0])}}">
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
    $('.registration').addClass("active");

    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true ,
             paging: false ,
        });

    var key = {!! $key !!};
    var tableCnt  = $('#tb_id tr').length;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='data["+key+"][date_of_registration]']",rowClone).val("");
    	$("[name='data["+key+"][date_of_registration]']",rowClone).attr('id',"nepstart"+tableCnt+1);
		$("[name='data["+key+"][name_of_industry]']",rowClone).val("");
		$("[name='data["+key+"][location]']",rowClone).val("");
    	$("[name='data["+key+"][category]']",rowClone).val("");
    	$("[name='data["+key+"][production_capacity]']",rowClone).val("");
    	$("[name='data["+key+"][capacity_utilization]']",rowClone).val("");
    	$("[name='data["+key+"][private_firm]']",rowClone).val("");
    	$("[name='data["+key+"][proprietorship]']",rowClone).val("");
    	$("[name='data["+key+"][company]']",rowClone).val("");
    	$("[name='data["+key+"][fixed]']",rowClone).val("");
    	$("[name='data["+key+"][working]']",rowClone).val("");
    	$("[name='data["+key+"][male]']",rowClone).val("");
    	$("[name='data["+key+"][female]']",rowClone).val("");
    	$("[name='data["+key+"][locked]']",rowClone).val("");

        $("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
        $("[name='data["+key+"][date_of_registration]']",rowClone).attr('name','data['+tableCnt+'][date_of_registration]');
        $("[name='data["+key+"][name_of_industry]']",rowClone).attr('name','data['+tableCnt+'][name_of_industry]');
        $("[name='data["+key+"][location]']",rowClone).attr('name','data['+tableCnt+'][location]');
        $("[name='data["+key+"][category]']",rowClone).attr('name','data['+tableCnt+'][category]');
        $("[name='data["+key+"][production_capacity]']",rowClone).attr('name','data['+tableCnt+'][production_capacity]');
        $("[name='data["+key+"][capacity_utilization]']",rowClone).attr('name','data['+tableCnt+'][capacity_utilization]');
        $("[name='data["+key+"][private_firm]']",rowClone).attr('name','data['+tableCnt+'][private_firm]');
        $("[name='data["+key+"][proprietorship]']",rowClone).attr('name','data['+tableCnt+'][proprietorship]');
        $("[name='data["+key+"][company]']",rowClone).attr('name','data['+tableCnt+'][company]');
        $("[name='data["+key+"][fixed]']",rowClone).attr('name','data['+tableCnt+'][fixed]');
        $("[name='data["+key+"][working]']",rowClone).attr('name','data['+tableCnt+'][working]');
        $("[name='data["+key+"][male]']",rowClone).attr('name','data['+tableCnt+'][male]');
        $("[name='data["+key+"][female]']",rowClone).attr('name','data['+tableCnt+'][female]');
        $("[name='data["+key+"][locked]']",rowClone).attr('name','data['+tableCnt+'][locked]');

		$("td#remRow",rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
		$('.sn',rowClone).html(tableCnt + 1);
    	tb_id.append(rowClone);
    	tableCnt++;


    	$('.nepdatepicker').nepaliDatePicker();

    	
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

	$('.nepdatepicker').nepaliDatePicker( );
</script>
@endsection
