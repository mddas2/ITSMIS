@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@if (!empty($user))
	@include('pages.partials.office_detail')
	<br>
@endif
<div class="card card-custom gutter-b">
	{{--@include('pages.partials.corporation_office_header_tiles')--}}

	<div class="card-body">
		<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
			<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
				<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center noc" href="{{route('noc_add')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fab fa-bitbucket icon-2x"></i>
					</span>
				</span>
					<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Nepal Oil Corporation</span>
				</a>
			</li>
			{{--<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
				<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center food" href="{{route('food_trading_add')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-braille icon-2x"></i>
					</span>
				</span>
					<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Food Management and Trading Company</span>
				</a>
			</li>--}}
		</ul>
	</div>


 	<div class="card-header flex-wrap border-1 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
            	Nepal Oil Corporation
        	</h3>
        </div>
		<div class="card-toolbar">
			<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax"
			   data-src="{{route('noc-excel-insert')}}"><i
						class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>From Date:</label>
					<input name="from_date" class="form-control form-control-solid nepdatepicker"  data-single="true" id="nepdatepicker1" required value="{{$from_date}}">
				</div>
                <div class="col-lg-3">
                    <label>To Date:</label>
                    <input name="to_date" class="form-control form-control-solid nepdatepicker"  data-single="true" id="nepdatepicker2" required value="{{$to_date}}">
                </div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('noc_add')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th  rowspan="2">SN</th>
	                    <th  rowspan="2">Date</th>
	                    <th  rowspan="2">Item(Product Description)</th>
	                    <th  rowspan="2">Import Quantity</th>
	                    <th rowspan="2">Unit</th>
                        <th rowspan="2">Import Cost (Per Unit)</th>
                        <th colspan="2">Stock</th>



	                    <?php
/*	                    	for ($i=11; $i < count($columns); $i++) {
	                    		$column = ucfirst(str_replace('_'," ", $columns[$i]));
	                    		echo '<th>'.$column.'</th>';
	                    	}
	                    */?>
						<th rowspan="2">Sales Quantity</th>
	                    <th  rowspan="2">Actions</th>
	                </tr>
                    <tr>
                        <td>Stock Date</td>
                        <td>Stock Quantity</td>
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
	                    	{{Form::select('data['.$key.'][item_id]',$items,$row->item_id,['class' => 'form-control'])}}
						</td>
						<td>
							<input type="text" name="data[{{$key}}][quantity]" class="form-control"
								   autocomplete="off" value="{{$row->quantity}}" {{$disabled}}>
						</td>
						<td>
							{{Form::select('data['.$key.'][unit_id]',$measurementUnit,$row->unit_id,['class' => 'form-control', $disabled])}}
						</td>
                        <td>
                            <input type="text" name="data[{{$key}}][import_cost]" class="form-control"
                                   autocomplete="off" value="{{$row->import_cost}}" {{$disabled}}>
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][stock_date]" class="form-control nepdatepicker-date" autocomplete="off"  id="nep{{$key}}-alt" value="{{$row->stock_date}}" {{$disabled}}>
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][stock_quantity]" class="form-control" autocomplete="off"   value="{{$row->stock_quantity}}" {{$disabled}}>
                        </td>
						<td>
							<input type="text" name="data[{{$key}}][sales_quantity]" class="form-control" autocomplete="off"   value="{{$row->sales_quantity}}" {{$disabled}}>
						</td>
					{{--	<?php
	                    	for ($i=11; $i < count($columns); $i++) {
	                    		$value = $row[$columns[$i]];
	                    		echo '<td><input type="text" name="data['.$key.']['.$columns[$i].']" class="form-control" autocomplete="off" value="'.$value.'" '.$disabled.'></td>';
	                    	}
	                    ?>--}}
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
	                    	<input type="text" name="data[{{$key}}][date]"  data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nepstart1">
	                   </td>
	                   <td>
	                    	{{Form::select('data['.$key.'][item_id]',$items,null,['class' => 'form-control'])}}
						</td>

						<td>
							<input type="text" name="data[{{$key}}][quantity]" class="form-control" autocomplete="off">
						</td>
						<td>
							{{Form::select('data['.$key.'][unit_id]',$measurementUnit,2,['class' => 'form-control'])}}
						</td>
                        <td>
                            <input type="text" name="data[{{$key}}][import_cost]" class="form-control" autocomplete="off">
                        </td>
                        <td>

                            <input type="text" name="data[{{$key}}][stock_date]" class="form-control  nepdatepicker-date" autocomplete="off"  >
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][stock_quantity]" class="form-control" autocomplete="off">
                        </td>
						<td>
							<input type="text" name="data[{{$key}}][sales_quantity]" class="form-control" autocomplete="off">
						</td>
						<?php
/*	                    	for ($i=11; $i < count($columns); $i++) {
	                    		echo '<td><input type="text" name="data['.$key.']['.$columns[$i].']" class="form-control" autocomplete="off"></td>';
	                    	}
	                    */?>
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
	            		<td colspan="<?php echo count($columns) - 5; ?>"></td>
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
	$('.noc').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
        responsive: true ,
     	paging: false
    });



    $('.nepdatepicker-date').nepaliDatePicker(/*{
        language: "english",
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
    }*/);

    var key = {!! $key !!};
    var tableCnt = $('#tb_id tr').length;
    var tb_id = $('#tb_id');
    $('.add').click(function (e) {
        var rowClone = $("#firstRow").clone();
        $("[name='data[" + key + "][date]']", rowClone).val("");
        $("[name='data[" + key + "][date]']", rowClone).attr('id', "nepstart" + tableCnt + 1);
        $("[name='data[" + key + "][item_id]']", rowClone).val("");
        $("[name='data[" + key + "][quantity]']", rowClone).val("");
        $("[name='data[" + key + "][import_cost]']", rowClone).val("");
        $("[name='data[" + key + "][stock_date]']", rowClone).val("");
        $("[name='data[" + key + "][stock_date]']", rowClone).attr('id', "nepstart1" + tableCnt + 1);
        $("[name='data[" + key + "][stock_quantity]']", rowClone).val("");
        $("[name='data[" + key + "][sales_quantity]']", rowClone).val("");

        $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
        $("[name='data[" + key + "][date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
        $("[name='data[" + key + "][item_id]']", rowClone).attr('name', 'data[' + tableCnt + '][item_id]');
        $("[name='data[" + key + "][quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity]');
        $("[name='data[" + key + "][import_cost]']", rowClone).attr('name', 'data[' + tableCnt + '][import_cost]');
        $("[name='data[" + key + "][stock_date]']", rowClone).attr('name', 'data[' + tableCnt + '][stock_date]');
        $("[name='data[" + key + "][stock_quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][stock_quantity]');
        $("[name='data[" + key + "][sales_quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][sales_quantity]');
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
        $('.nepdatepicker-date').nepaliDatePicker(/*{
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 10
        }*/);



    });

    $(document).on('click', '#remRow', function () {
        if (tableCnt > 1) {
            $(this).closest('tr').remove();
            tableCnt--;
        }
        return false;
    });
</script>
@endsection
