@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@if (!empty($hierarchyTitle))
	@include('pages.partials.hierarchy_detail')
@endif
<div class="card card-custom">
	<div class="card-body">
		<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
			<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
				<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center marketMonitoring" href="{{route('icacp-market-monitoring-report')}}">
					<span class="nav-icon py-3 w-auto">
						<span class="svg-icon svg-icon-3x">
							<i class="far fa-chart-bar icon-2x"></i>
						</span>
					</span>
					<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Market Monitoring</span>
				</a>
			</li>


		</ul>
	</div>
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
        	<a class="btn btn-info btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('icacp_market_monitoring_import_column')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import New Column')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>From Date:</label>
					<input name="from_date" class="form-control form-control-solid nepdatepicker" id="nepdatepicker1" required value="{{$from_date}}">
				</div>
				<div class="col-lg-3">
					<label>To Date:</label>
					<input name="to_date" class="form-control form-control-solid nepdatepicker" id="nepdatepicker2" required value="{{$to_date}}">
				</div>
				<div class="col-lg-3">
					<label>User:</label>
					<input name="office_id" type="hidden" class="form-control-solid officeId" value="{{$officeId}}">
					<input name="hierarchy_id" type="hidden" class="form-control-solid hierarchyId" value="{{$hierarchyId}}">
					{{Form::select('user_id',[],$user_id,['class'=>'form-control form-control-solid userList'])}}
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
	    <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	        <thead>
	            <tr>
	                <th>SN</th>
	                <th>Date</th>
	                <th>User</th>
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
	        	<?php $key = 0;?>
	            @foreach($data as $row)
	            <tr>
	                <td>{{$key+1}}</td>
	                <td>
	                	<input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
	                	{{$row->date}}
	               </td>
	               	<td>{{$row->user->name}}</td>
	                <td>
	                	{{$row->no_of_monitored_firm}}
					</td>
					<td>
	                	{{$row->types_of_firm}}
					</td>
					<td>
	                	{{$row->action_taken}}
					</td>
					<td>
	                	{{$row->monitored_by}}
					</td>
					<?php 
	                	for ($i=10; $i < count($columns); $i++) { 
	                		echo '<td>'.$row[$columns[$i]].'</td>';
	                	}
	                ?>
	                <td>
	                	<?php 
		                	if ($row->locked == 1) { ?>
		                		<a class="btn btn-danger btn-sm" href="{{route('icacp_market_monitoring_lock',['lock' => 0,'id'=>$row->id])}}" data-toggle="tooltip" title="Unlock Data">
		            				<i class="fa fa-unlock icon-sm"></i>Unlock
		            			</a>
		                <?php }
		                ?>
	                </td>
	            </tr>
	            @php $key++; @endphp
	            @endforeach
	        </tbody>
	    </table>
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
    $(document).on('change','.officeId', function() {
		var officeId = $(this).val();
		var hierarchyId = $('.hierarchyId').val();
		var userId = {!! $user_id; !!};
		var route =  "<?php echo URL::to("user_list"); ?>";

		if (officeId != 0) {
			var params = '?office_id=' + officeId;
		} else {
			var params = '?hierarchy_id=' + hierarchyId;
		}

		$.ajax({
			type: "GET",
			url: route + params,
			success: function(response) {
				var obj = JSON.parse(response);
				var select = "";
				Object.keys(obj).forEach(function(key) {
					if (userId == obj[key]['id']) {
						select += '<option value="' + obj[key]['id'] + '" selected>' + obj[key]['name'] + '</option >';
					} else {
						select += '<option value="' + obj[key]['id'] + '">' + obj[key]['name'] + '</option >';
					}
				});
				$(".userList").html(select);
			}
		});
	});
	$('.officeId').trigger('change');

	$('.nepdatepicker').nepaliDatePicker(/*{
        language: "english",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
    }*/);
</script>
@endsection
