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
    </div>
	<div class="card-body">
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
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	<?php $key = 0; ?>
	                @foreach($formatData as $row)
	                <tr>
	                    <td>{{$key+1}}</td>
	                    <td>
	                    	<input type="hidden" name="data[{{$key}}][id]" value="">
	                    	<input type="text" name="data[{{$key}}][date]" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row['date']}}" >
	                   </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][no_of_registered_company]" class="form-control" autocomplete="off" value="{{$row['no_of_registered_company']}}" >
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][types_of_company]" class="form-control" autocomplete="off" value="{{$row['types_of_company']}}" >
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue_raised]" class="form-control" autocomplete="off" value="{{$row['revenue_raised']}}" >
						</td>
	                </tr>
	                @php $key++; @endphp

	                @endforeach
	            </tbody>
	            <tfoot>
	            	<tr>
	            		<td colspan="2">
	            			<button class="btn btn-success btn-sm" type="submit">
	            				<i class="fa fa-plu icon-sm"></i>Save Changes
	            			</button>
	            		</td>
	            		<td colspan="2"></td>
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

	$('.nepdatepicker').nepaliDatePicker(/*{
        language: "english",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
    }*/);
</script>
@endsection
