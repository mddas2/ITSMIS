@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
            	Market Monitoring - District Administration Office
        	</h3>
        </div>
    </div>
	<div class="card-body">
		<form class="form" id="kt_form" action="{{route('dao_market_monitoring')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10">
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
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0; ?>
	                @foreach($formatData as $row)
	                <tr>
	                    <td>{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][id]" value="">
	                    	<input type="text" name="data[{{$key}}][date]"   data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row['date']}}">
	                   </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][no_of_monitored_firm]" class="form-control" autocomplete="off" value="{{$row['no_of_monitored_firm']}}">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][types_of_firm]" class="form-control" autocomplete="off" value="{{$row['types_of_firm']}}">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][action_taken]" class="form-control" autocomplete="off" value="{{$row['action_taken']}}">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][monitored_by]" class="form-control" autocomplete="off" value="{{$row['monitored_by']}}">
						</td>
						<?php 
	                    	for ($i=10; $i < count($columns); $i++) { 
	                    		$value = $row[$columns[$i]];
	                    		echo '<td><input type="text" name="data['.$key.']['.$columns[$i].']" class="form-control" autocomplete="off" value="'.$value.'" ></td>';
	                    	}
	                    ?>
	                </tr>
	                @php $key++; @endphp
	                @endforeach
	            </tbody>
	            <tfoot>
	            	<tr>
	            		<td colspan="6">
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

    $(document).on('click', '#remRow', function() {
	    if (tableCnt > 1) {
	        $(this).closest('tr').remove();
	        tableCnt--;
	    }
	    return false;
	});

	$('.nepdatepicker').nepaliDatePicker(/*{
	 language: "english",
	 ndpYear: true,
	 ndpMonth: true,
	 ndpYearCount: 10
	 }*/);
</script>
@endsection
