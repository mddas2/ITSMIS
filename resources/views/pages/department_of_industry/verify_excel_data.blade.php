@extends('layout.default')
@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title">
				<h3 class="card-label">
					Department Of Industry -    FDI Approval
				</h3>
			</div>
		</div>
		<div class="card-body">
			<form class="form" id="kt_form" action="{{route('fdi_approval')}}" method="post">
				{{csrf_field()}}
				<table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
					<thead>
					<tr>
						<th>SN</th>
						<th>Date of Approval</th>
						<th>Name Of Investor</th>
						<th>Nationality Of Investor</th>
						<th>Location</th>
						<th>Category</th>
						<th>Production Capacity</th>
						<th>Fixed</th>
						<th>Working</th>
						<th>Male</th>
						<th>Female</th>
						<th>Local</th>
						<th>Foreigner</th>

					</tr>
					</thead>
					<tbody id="tb_id">
                    <?php $key = 0;?>
					@foreach($formatData as $row)
						<tr>
							<td>{{$key+1}}</td>
							<td>
								<input type="hidden" name="data[{{$key}}][id]" value=" ">
								<input type="text" name="data[{{$key}}][date_of_aproval]"   data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row['date_of_aproval']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][name_of_investor]" class="form-control" autocomplete="off" value="{{$row['name_of_investor']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][nationality_of_investor]" class="form-control" autocomplete="off" value="{{$row['nationality_of_investor']}}" >
							</td>
							<td>

								<input type="text" name="data[{{$key}}][location]" class="form-control" autocomplete="off" value="{{$row['location']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][category]" class="form-control" autocomplete="off" value="{{$row['category']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][production_capacity]" class="form-control" autocomplete="off" value="{{$row['production_capacity']}}" >
							</td>

							<td>
								<input type="text" name="data[{{$key}}][fixed]" class="form-control" autocomplete="off" value="{{$row['fixed']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][working]" class="form-control" autocomplete="off" value="{{$row['working']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][male]" class="form-control" autocomplete="off" value="{{$row['male']}}" >
							</td>

							<td>
								<input type="text" name="data[{{$key}}][female]" class="form-control" autocomplete="off" value="{{$row['female']}}" >
							</td>
							<td>
								<input type="text" name="data[{{$key}}][local]" class="form-control" autocomplete="off" value="{{$row['local']}}" >
							</td>

							<td>
								<input type="text" name="data[{{$key}}][foreigner]" class="form-control" autocomplete="off" value="{{$row['foreigner']}}" >
							</td>

						</tr>
						@php $key++; @endphp
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<td colspan="2">
							<button class="btn btn-primary btn-sm add" type="submit">
								<i class="icon-sm"></i>Save Changes
							</button>
						</td>
						<td colspan="6"></td>
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
        $('.nepdatepicker').nepaliDatePicker();
	</script>
@endsection
