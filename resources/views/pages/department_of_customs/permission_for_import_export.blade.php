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
	<div class="card-body">
		<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
			<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
				<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center exportPage" href="{{route('department-of-custom','export')}}">
					<span class="nav-icon py-3 w-auto">
						<span class="svg-icon svg-icon-3x">
							<i class="far fa-chart-bar icon-2x"></i>
						</span>
					</span>
					<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Export Site Information</span>
				</a>
			</li>
			<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
				<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center importPage" href="{{route('department-of-custom','import')}}">
					<span class="nav-icon py-3 w-auto">
						<span class="svg-icon svg-icon-3x">
							<i class="fas fa-poll-h icon-2x"></i>
						</span>
					</span>
					<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Import Site Information</span>
				</a>
			</li>
			<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
				<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center exportImportPage" href="{{route('permission_import_export')}}">
					<span class="nav-icon py-3 w-auto">
						<span class="svg-icon svg-icon-3x">
							<i class="fas fa-poll-h icon-2x"></i>
						</span>
					</span>
					<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Permission for import and export</span>
				</a>
			</li>
		</ul>
	</div>
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Department Of Customs - Permission for export and import</h3>
        </div>
        <div class="card-toolbar">
			<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('dce-excel-insert',['type'=>'export_import'])}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
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
					<input name="to_date" class="form-control form-control-solid nepdatepicker"  data-single="true" id="nepdatepicker2" required value="{{$to_date}}">
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('permission_import_export')}}" method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th>SN</th>
	                    <th>Date</th>
	                    <th>Title</th>
	                    <th>Amount</th>
                     	<th>Price</th>
	                    <th>Revenue</th>
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
	                    	<input type="text" name="data[{{$key}}][date]"  data-single="true"  class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row->date}}" {{$disabled}}>
	                   </td>
	                    <td>
	                    	<input type="text" name="data[{{$key}}][title]" class="form-control" autocomplete="off" value="{{$row->title}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][amount]" class="form-control" autocomplete="off" value="{{$row->amount}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][price]" class="form-control" autocomplete="off" value="{{$row->price}}" {{$disabled}}>
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue]" class="form-control" autocomplete="off" value="{{$row->revenue}}" {{$disabled}}>
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
	                    	<input type="text" name="data[{{$key}}][date]"  data-single="true"  class="form-control nepdatepicker" autocomplete="off" id="nepstart1">
	                   </td>
	                   <td>
	                    	<input type="text" name="data[{{$key}}][title]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][amount]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][price]" class="form-control" autocomplete="off">
						</td>
						<td>
	                    	<input type="text" name="data[{{$key}}][revenue]" class="form-control" autocomplete="off">
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
	$('.exportImportPage').addClass("active");

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
		$("[name='data["+key+"][title]']",rowClone).val("");
    	$("[name='data["+key+"][amount]']",rowClone).val("");
		$("[name='data["+key+"][price]']",rowClone).val("");
		$("[name='data["+key+"][revenue]']",rowClone).val("");

		$("[name='data["+key+"][id]']",rowClone).attr('name','data['+tableCnt+'][id]');
		$("[name='data["+key+"][date]']",rowClone).attr('name','data['+tableCnt+'][date]');
		$("[name='data["+key+"][title]']",rowClone).attr('name','data['+tableCnt+'][title]');
		$("[name='data["+key+"][amount]']",rowClone).attr('name','data['+tableCnt+'][amount]');
		$("[name='data["+key+"][price]']",rowClone).attr('name','data['+tableCnt+'][price]');
		$("[name='data["+key+"][revenue]']",rowClone).attr('name','data['+tableCnt+'][revenue]');
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
