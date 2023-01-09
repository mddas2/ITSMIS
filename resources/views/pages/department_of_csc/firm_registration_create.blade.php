@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
	@if (!empty($hierarchyTitle))
		@include('pages.partials.hierarchy_detail')
	@endif
@if (!empty($user))
	@include('pages.partials.office_detail')
	<br>
@endif
<div class="card card-custom gutter-b">
	@include('pages.partials.dcsc_header_tiles')
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
            	Firm Registration - Department of Commerce, Supply and Consumer Right Protection
        	</h3>
        </div>
        <div class="card-toolbar">
        	<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('dcsc_firm_registration_excel')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>From Date:</label>
					<input name="from_date" class="form-control form-control-solid nepdatepicker"  required value="{{$from_date}}">
				</div>
				<div class="col-lg-3">
					<label>To Date:</label>
					<input name="to_date" class="form-control form-control-solid nepdatepicker"  required value="{{$to_date}}">
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('dcsc_firm_registration')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th>SN</th>
	                    <th>Date</th>
	                    <th>No of Registered Firm</th>
	                    <th>Types Of Registered Firm</th>
	                    <th>No of Firm Renewal</th>
	                    <th>Types Of Firm Renewal</th>
                     	<th>Firm Cancellation</th>
	                    <th>Revenue Raised</th>
	                    <?php 
	                    	for ($i=12; $i < count($columns); $i++) { 
	                    		$column = ucfirst(str_replace('_'," ", $columns[$i]));
	                    		echo '<th>'.$column.'</th>';
	                    	}
	                    ?>
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
	                    	<input type="text" name="data[{{$key}}][no_of_registered_firm]" class="form-control" autocomplete="off" value="{{$row->no_of_registered_firm}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][type_of_registered_firm]" class="form-control" autocomplete="off" value="{{$row->type_of_registered_firm}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][no_of_firm_renewal]" class="form-control" autocomplete="off" value="{{$row->no_of_firm_renewal}}" {{$disabled}}>
						</td>
						<td>													
	                    	<input type="text" name="data[{{$key}}][type_of_firm]" class="form-control" autocomplete="off" value="{{$row->type_of_firm}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][firm_cancellation]" class="form-control" autocomplete="off" value="{{$row->firm_cancellation}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue_raised]" class="form-control" autocomplete="off" value="{{$row->revenue_raised}}" {{$disabled}}>
						</td>
						<?php 
	                    	for ($i=12; $i < count($columns); $i++) { 
	                    		$value = $row[$columns[$i]];
	                    		echo '<td><input type="text" name="data['.$key.']['.$columns[$i].']" class="form-control" autocomplete="off" value="'.$value.'" '.$disabled.'></td>';
	                    	}
	                    ?>
	                    <td>
	                    	<?php if ($disabled == "disabled") {?>
	                        <a href="javascript:;" class="btn btn-danger btn-xs mr-2"></i>Locked</a>
                        	<?php }?>
	                    </td>
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
	                    	<input type="text" name="data[{{$key}}][no_of_registered_firm]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][type_of_registered_firm]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][no_of_firm_renewal]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][type_of_firm]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][firm_cancellation]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue_raised]" class="form-control" autocomplete="off">
						</td>
						<?php 
	                    	for ($i=12; $i < count($columns); $i++) { 
	                    		echo '<td><input type="text" name="data['.$key.']['.$columns[$i].']" class="form-control" autocomplete="off"></td>';
	                    	}
	                    ?>
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
	            		<td colspan="<?php echo count($columns) - 6; ?>"></td>
	            		<td colspan="1">
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
	$('.firmRegistration').addClass("active");
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
		$("[name='data["+key+"][no_of_registered_firm]']",rowClone).val("");
		$("[name='data["+key+"][type_of_registered_firm]']",rowClone).val("");
    	$("[name='data["+key+"][no_of_firm_renewal]']",rowClone).val("");
		$("[name='data["+key+"][type_of_firm]']",rowClone).val("");
    	$("[name='data["+key+"][firm_cancellation]']",rowClone).val("");
		$("[name='data["+key+"][revenue_raised]']",rowClone).val("");

		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][date]']",rowClone).attr('name','data['+tableCnt+'][date]');
		$("[name='data["+key+"][no_of_registered_firm]']",rowClone).attr('name','data['+tableCnt+'][no_of_registered_firm]');
		$("[name='data["+key+"][type_of_registered_firm]']",rowClone).attr('name','data['+tableCnt+'][type_of_registered_firm]');
		$("[name='data["+key+"][no_of_firm_renewal]']",rowClone).attr('name','data['+tableCnt+'][no_of_firm_renewal]');
		$("[name='data["+key+"][type_of_firm]']",rowClone).attr('name','data['+tableCnt+'][type_of_firm]');
		$("[name='data["+key+"][firm_cancellation]']",rowClone).attr('name','data['+tableCnt+'][firm_cancellation]');
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
