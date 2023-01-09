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
<div class="card card-custom">
	@include('pages.partials.icacp_header_tiles')
</div>
<br>
<div class="card card-custom">
 	<div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
            	Market Monitoring - Province Level - Directorate of Industry, Commerce and Consumer Protection
			</h3>
        </div>
        <div class="card-toolbar">
        	<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('icacp_market_monitoring_excel')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>From Date:</label>
					<input name="from_date" class="form-control form-control-solid nepdatepicker" data-single="true"  id="nepdatepicker1" required value="{{$from_date}}">
				</div>
				<div class="col-lg-3">
					<label>To Date:</label>
					<input name="to_date" class="form-control form-control-solid nepdatepicker"  data-single="true" required value="{{$to_date}}">
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('icacp_market_monitoring')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" >
	            <thead>
	                <tr>
	                    <th>SN</th>
	                    <th>Date</th>
	                    <th>No of Monitored Firm</th>
	                    <th>
	                    	Types Of Firm 
	                    </th>
                     	<th>Action Taken</th>
	                    <th>Monitored By</th>
	                    <?php 
	                    	for ($i=10; $i < count($columns); $i++) { 
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
	                    	<input type="text" name="data[{{$key}}][date]"  data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row->date}}" {{$disabled}}>
	                   </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][no_of_monitored_firm]" class="form-control" autocomplete="off" value="{{$row->no_of_monitored_firm}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][types_of_firm]" class="form-control" autocomplete="off" value="{{$row->types_of_firm}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][action_taken]" class="form-control" autocomplete="off" value="{{$row->action_taken}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][monitored_by]" class="form-control" autocomplete="off" value="{{$row->monitored_by}}" {{$disabled}}>
						</td>
						<?php 
	                    	for ($i=10; $i < count($columns); $i++) { 
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
	                    	<input type="text" name="data[{{$key}}][date]"  data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nepstart1" value="{{$today}}">
	                   </td>
	                   <td>
	                    	<input type="text" name="data[{{$key}}][no_of_monitored_firm]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][types_of_firm]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][action_taken]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][monitored_by]" class="form-control" autocomplete="off">
						</td>
						<?php 
	                    	for ($i=10; $i < count($columns); $i++) { 
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
	            		<td colspan="4"></td>
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
		$("[name='data["+key+"][no_of_monitored_form]']",rowClone).val("");
		$("[name='data["+key+"][types_of_firm]']",rowClone).val("");
    	$("[name='data["+key+"][action_taken]']",rowClone).val("");
		$("[name='data["+key+"][monitored_by]']",rowClone).val("");

		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][date]']",rowClone).attr('name','data['+tableCnt+'][date]');
		$("[name='data["+key+"][no_of_monitored_form]']",rowClone).attr('name','data['+tableCnt+'][no_of_monitored_form]');
		$("[name='data["+key+"][types_of_firm]']",rowClone).attr('name','data['+tableCnt+'][types_of_firm]');
		$("[name='data["+key+"][action_taken]']",rowClone).attr('name','data['+tableCnt+'][action_taken]');
		$("[name='data["+key+"][monitored_by]']",rowClone).attr('name','data['+tableCnt+'][monitored_by]');
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
