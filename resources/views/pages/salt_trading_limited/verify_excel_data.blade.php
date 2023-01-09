@extends('layout.default')
@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
	<div class="card card-custom">
		<div class="card-header flex-wrap border-1">
			<div class="card-title">
				<h3 class="card-label">Salt Trading Limited </h3>
			</div>
		</div>
		<div class="card-body">
			<form class="form" id="kt_form" action="{{route('salt_trading_add',$type)}}" method="post">
				{{csrf_field()}}
				<table class="table table-bordered table-hover table-checkable mt-10">
					<thead>
					<tr>
						<th>SN</th>
						<th>Date</th>
						<th>Item</th>
						<th>Unit</th>
						@if($type == 'purchase')
							<th>Quantity</th>

						@endif


						@if($type == 'SalesStock')
							<th>Stock Quantity</th>
							<th>Sales Quantity</th>
						@endif
					</tr>
					</thead>
					<tbody id="tb_id">
                    <?php $key = 0;?>
					@foreach($formatData as $row)
						<tr>
							<td>{{$key+1}}</td>
							<td>
								<input type="hidden" name="data[{{$key}}][id]" value=" ">
								<input type="text" name="data[{{$key}}][date]"   data-single="true" class="form-control nepdatepicker"
									   autocomplete="off" id="nep{{$key}}" value="{{$row['date']}}">
							</td>
							<td>
								{{Form::select('data['.$key.'][item_id]',$items,$row['item_id'],['class' => 'form-control'])}}
							</td>


							<td>
								{{Form::select('data['.$key.'][quantity_unit]',$units,$row['quantity_unit'],['class' => 'form-control'])}}
							</td>
							@if($type == 'purchase')
								<td>
									<input type="text" name="data[{{$key}}][quantity]" class="form-control "
										   autocomplete="off" value="{{$row['quantity']}}">
								</td>

							@endif
							@if($type == 'SalesStock')
								<td>
									<input type="text" name="data[{{$key}}][stock_quantity]" class="form-control"
										   autocomplete="off" value="{{$row['stock_quantity']}}">
								</td>

								<td>
									<input type="text" name="data[{{$key}}][sales_quantity]" class="form-control"
										   autocomplete="off" value="{{$row['sales_quantity']}}">
								</td>
							@endif
							<td>

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

        var key = {!! $key !!};
        var tableCnt  = $('#tb_id tr').length;
        var tb_id = $('#tb_id');
        $('.add').click(function (e) {
            var rowClone = $("#firstRow").clone();
            $("[name='data[" + key + "][date]']", rowClone).val("");
            $("[name='data[" + key + "][date]']", rowClone).attr('id', "nepstart" + tableCnt + 1);
            $("[name='data[" + key + "][item_id]']", rowClone).val("");
            $("[name='data[" + key + "][quantity]']", rowClone).val("");
            $("[name='data[" + key + "][quantity_unit]']", rowClone).val("");
            $("[name='data[" + key + "][per_unit_price]']", rowClone).val("");
            $("[name='data[" + key + "][total_price]']", rowClone).val("");
            if ( type == 'SalesStock' ) {
                $("[name='data[" + key + "][profit_per_unit]']", rowClone).val("");
                $("[name='data[" + key + "][stock_amount]']", rowClone).val("");
            }


            $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
            $("[name='data[" + key + "][date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
            $("[name='data[" + key + "][item_id]']", rowClone).attr('name', 'data[' + tableCnt + '][item_id]');
            $("[name='data[" + key + "][quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity]');
            $("[name='data[" + key + "][quantity_unit]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity_unit]');
            $("[name='data[" + key + "][per_unit_price]']", rowClone).attr('name', 'data[' + tableCnt + '][per_unit_price]');
            $("[name='data[" + key + "][total_price]']", rowClone).attr('name', 'data[' + tableCnt + '][total_price]');


            if ( type == 'SalesStock' ) {
                $("[name='data[" + key + "][profit_per_unit]']", rowClone).attr('name', 'data[' + tableCnt + '][profit_per_unit]');
                $("[name='data[" + key + "][stock_amount]']", rowClone).attr('name', 'data[' + tableCnt + '][stock_amount]');
            }


            $("td#remRow", rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
            $('.sn', rowClone).html(tableCnt + 1);
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
