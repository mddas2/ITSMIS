@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom">
 	<div class="card-header flex-wrap border-1">
        <div class="card-title">
            <h3 class="card-label">Export Data</h3>
        </div>
    </div>
	<div class="card-body">
		<form class="form" id="kt_form" action="{{route('department-of-custom',$type)}}" method="post">
	 		{{csrf_field()}}
			<table class="table table-bordered table-hover table-checkable mt-10">
				<thead>
				<tr>
					<th>SN</th>
					<th>HScode</th>
					<th>Item</th>
					<th>Description</th>
					<th>Asmt Date</th>
					<th>Customs</th>
					<th>Unit</th>
					<th>Quantity</th>
					<th>Cif Value</th>
					<th>HS4</th>
					<th>CF</th>
				</tr>
				</thead>
				<tbody id="tb_id">
                <?php $key = 0;?>
				@foreach($formatData as $row)
					<tr>
						<td>{{$key+1}}</td>
						<td>
							<input type="hidden" name="data[{{$key}}][id]" value="">
							<input type="text" name="data[{{$key}}][asmt_date]" class="form-control   "    autocomplete="off" id="nep{{$key}}" value="{{$row['asmt_date']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][hscode]" class="form-control" autocomplete="off" value="{{$row['hscode']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][item]" class="form-control" autocomplete="off" value="{{$row['item']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][description]" class="form-control" autocomplete="off" value="{{$row['description']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][customs]" class="form-control" autocomplete="off" value="{{$row['customs']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][unit_id]" class="form-control" autocomplete="off" value="{{$row['unit_id']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][quantity]" class="form-control" autocomplete="off" value="{{$row['quantity']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][cif_value]" class="form-control" autocomplete="off" value="{{$row['cif_value']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][hs4]" class="form-control" autocomplete="off" value="{{$row['hs4']}}">
						</td>
						<td>
							<input type="text" name="data[{{$key}}][ch]" class="form-control" autocomplete="off" value="{{$row['ch']}}">
						</td>
					</tr>
					@php $key++; @endphp
				@endforeach
				</tbody>
				<tfoot>
				<tr>
					<td colspan="7">
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
	$('.exportPage').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true ,
             paging: false
        });
	$('.nepdatepicker').nepaliDatePicker( );
</script>
@endsection
