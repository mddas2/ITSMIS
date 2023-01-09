@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
	<div class="card-body">
		@include('pages.partials.industry_input_header_tiles')
	</div>
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Area Wise Training Report</h3>
        </div>
        <div class="card-toolbar">
			<a  class="btn btn-success btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>{{ __('Import CSV')}}</a>

		</div>
    </div>
	<div class="card-body">
		<form>
			<div class="form-group row">
				<div class="col-lg-3">
					<label>Fiscal Year</label>
					{{Form::select('fiscal_year_id',$fiscalYear,$fiscalYearId,['class' => 'form-control'])}}
				</div>
				<div class="col-lg-3" style="margin-top: 24px;">
					<button type="submit" class="btn btn-secondary">Filter</button>
				</div>
			</div>
		</form>
		<form class="form" id="kt_form" action="{{route('areawise_training_report',['fiscal_year_id'=> $fiscalYearId])}}" method="post">
	 		{{csrf_field()}}
	 		<div class="table-responsive">
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th rowspan="2">SN</th>
	                    <th rowspan="2" colspan="2" style="min-width: 300px;">Completed training thematic</th>
                     	<th rowspan="2" style="min-width: 120px;">Target</th>
	                    <th rowspan="2" style="min-width: 120px;">Achievement</th>
	                    <th colspan="12" style="text-align: center;">Number Of Completed Training</th>
	                    <th rowspan="2" style="min-width: 220px;">Cause Of Non Achieving Target</th>
	                    <th rowspan="2"  style="min-width: 220px;">Remarks</th>

	                </tr>
	               <tr>
	                	<?php 
	                		$months = [
								'4' => 'Shrawan',
								'5' => 'Bhadau',
								'6' => 'Aswin',
								'7' => 'Kartik',
								'8' => 'Mansir',
								'9' => 'Poush',
								'10' => 'Magh',
								'11' => 'Falgun',
								'12' => 'Chaitra',
								'1' => 'Baishakh',
								'2' => 'Jestha',
								'3' => 'Asar',
							];
	                	?>
	                	@foreach ($months as $month)
	                	<th>{{$month}}</th>
	                	@endforeach
	                </tr>
	            </thead>
	            <tbody id="tb_id">
	            	@foreach ($data as $key=>$row)
	            	<tr>
	            		<?php 
	            			$rowspan = 1;
	            			$colspan = 2;
	            			if (!empty($row['sub_training'])) {
	            				$rowspan = count($row['sub_training']);
	            				$colspan = 1;
	            			}

	            			if ($key == 4) {
	            			}
	            		?>
	            		<td rowspan="{{$rowspan}}">{{$key+1}}</td>
	            		<td rowspan="{{$rowspan}}" colspan="{{$colspan}}">{{$row['name']}}</td>
	            		<?php if (!empty($row['sub_training'])) { ?>
	            				<td>
	            					{{$row['sub_training'][0]}}
	            				</td>
	            		<?php 	
	            			}
	            		?>
	            		<td>
	            			<input type="hidden" name="data[{{$key}}][id]" value="{{!empty($row['report'])?$row['report']['id']:''}}" />
	            			<input type="hidden" name="data[{{$key}}][training_type_id]" value="{{$row['training_id']}}" />
	            			<input name="data[{{$key}}][target][0]" class="form-control" value="{{!empty($row['report'])?$row['report']['target'][0]:''}}"></td>
	            		<td><input name="data[{{$key}}][achievement][0]" class="form-control" value="{{!empty($row['report'])?$row['report']['achievement'][0]:''}}"></td>
	            		<?php foreach ($months as $month) {?>
	            			<td><input name="data[{{$key}}][monthly_completed_report][0][{{$month}}]" class="form-control" value="{{!empty($row['report'])?$row['report']['monthly_completed_report'][0][$month]:''}}"></td>
	            		<?php	
	            			}
	            		?>
	            		<td><input name="data[{{$key}}][non_achieving_target_cause][0]" class="form-control" value="{{!empty($row['report'])?$row['report']['non_achieving_target_cause'][0]:''}}"></td>
	            		<td><input name="data[{{$key}}][remarks][0]" class="form-control" value="{{!empty($row['report'])?$row['report']['remarks'][0]:''}}"></td>
	            	</tr>
	            	<?php 
	            		if ($rowspan > 1) { 
	            			foreach ($row['sub_training'] as $cnt=>$subTraining) :
	            				if ($cnt > 0) :
        			?>
	            			<tr>
	            				<td>
	            					{{$row['sub_training'][$cnt]}}
	            				</td>
	            				<td><input name="data[{{$key}}][target][{{$cnt}}]" class="form-control" value="{{!empty($row['report'])?$row['report']['target'][$cnt]:''}}"></td>
			            		<td><input name="data[{{$key}}][achievement][{{$cnt}}]" class="form-control" value="{{!empty($row['report'])?$row['report']['achievement'][$cnt]:''}}"></td>
			            		<?php foreach ($months as $month) { ?>
			            			<td><input name="data[{{$key}}][monthly_completed_report][{{$cnt}}][{{$month}}]" class="form-control" value="{{!empty($row['report'])?$row['report']['monthly_completed_report'][$cnt][$month]:''}}"></td>
			            		<?php	
			            			}
			            		?>
			            		<td><input name="data[{{$key}}][non_achieving_target_cause][{{$cnt}}]" class="form-control" value="{{!empty($row['report'])?$row['report']['non_achieving_target_cause'][$cnt]:''}}"></td>
			            		<td><input name="data[{{$key}}][remarks][{{$cnt}}]" class="form-control" value="{{!empty($row['report'])?$row['report']['remarks'][$cnt]:''}}"></td>
            				</tr>
	            		<?php 
	            			endif;

	            			endforeach;	
	            			}
	            		?>

	            	@endforeach
	            </tbody>
	            <tfoot>
	            	<tr>
	            		<td colspan="18"></td>
	            		<td>
	            			<button class="btn btn-success btn-sm" type="submit">
	            				<i class="fa fa-plu icon-sm"></i>Save Changes
	            			</button>
	            		</td>
	            	</tr>
	            </tfoot>
	        </table>
	    </div>
        </form>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script type="text/javascript">
	$('.areawiseTraining').addClass("active");
    var table = $('#kt_datatable');
    table.DataTable({
    	responsive: true,
            scrollX: true
        });

    var key = 2;
    var tableCnt  = $('#tb_id tr').length+1;
    var tb_id = $('#tb_id');
    $('.add').click(function(e){
    	var rowClone = $("#firstRow").clone();
    	$("[name='data["+key+"][name]']",rowClone).val("");
		$("[name='data["+key+"][number]']",rowClone).val("");
		$("[name='data["+key+"][progress]']",rowClone).val("");
		
		$("[name='data["+key+"][name]']",rowClone).attr('name','data['+tableCnt+'][name]');
		$("[name='data["+key+"][number]']",rowClone).attr('name','data['+tableCnt+'][number]');
		$("[name='data["+key+"][progress]']",rowClone).attr('name','data['+tableCnt+'][progress]');
		$("td#remRow",rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
		$('.sn',rowClone).html(tableCnt + 1);
    	tb_id.append(rowClone);
    	tableCnt++;
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
</script>
@endsection
