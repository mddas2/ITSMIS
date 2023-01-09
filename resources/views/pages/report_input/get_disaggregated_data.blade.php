@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <div class="card-body">
		@include('pages.partials.report_input_header_tiles')
	</div>
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Disaggregated Data</h3>
        </div>
    </div>
	<div class="card-body">
		<form>
            <div class="row mb-6">
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label>User Type :</label>
                    {{Form::select('hierarchy_id',$hierarchyList,$hierarchy_id,['class' => 'form-control userType'])}}
                </div>
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label>User :</label>
                    {{Form::select('user_id',[],$user_id,['class' => 'form-control userList'])}}
                </div>
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label>Fiscal Year:</label>
                    {{Form::select('fiscal_year_id',$fiscalYear,$fiscal_year_id,['class' => 'form-control'])}}
                </div>
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label>Size Wise Category</label>
					<?php 
						$category = [
							"micro" => "Micro Enterprise",
							"cottage" => "Cottage Industry",
							"large" => "Large Industry",
							"medium" => "Medium Industry",
							"small" => "Small Industry"
						]
					?>
					{{Form::select('industry_size',$category,$industry_size,['class' => 'form-control industry'])}}
                </div>
                <div class="col-lg-2 mb-lg-0 mb-6">
                    <button class="btn btn-primary btn-primary--icon" id="kt_search" style="margin-top: 25px;">
                        <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                        </span>
                    </button>&#160;&#160;
                </div>
            </div>
		</form>
		<form class="form" id="kt_form"  method="post">
	 		{{csrf_field()}}
	        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
	            <thead>
	                <tr>
	                    <th rowspan="2">SN</th>
                        <th rowspan="2">Fiscal Year</th>
                        <th rowspan="2">Entry Date</th>
                        <th rowspan="2">User</th>
                        <?php if (in_array($industry_size,["micro","cottage"])) { ?>
                            <th rowspan="2">Investment</th>
                            <th colspan="2">Employment</th>
                        <?php } else { ?>
                            <th rowspan="2">Domestic Investment</th>
                            <th rowspan="2">Foreign Investment</th>
                            <th rowspan="2">Domestic + Foreign</th>
                            <th colspan="2">Employment</th>
                    <?php } ?>
	                </tr>
                    <tr>
                        <th>Male</th>
                        <th>Female</th>
                    </tr>
	            </thead>
		        <tbody id="tb_id">
                @foreach ($data as $key=>$row)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->fiscalYear->name}}</td>
                    <td>{{$row->entry_date}}</td>
                    <td>{{$row->user->name}}</td>
                    <?php 
                        $params = unserialize($row->param);
                        $value = unserialize($row->value);
                    ?>
                    @foreach ($value as $cnt=>$val)
                        <td>{{$val}}</td>
                    @endforeach
                </tr>
                @endforeach
	            </tbody>
	            
	        </table>
        </form>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script type="text/javascript">
    var table = $('#kt_datatable');
    table.DataTable({
        responsive: true 
    });

    $('.userType').change(function(e){
        var value = $(this).val();
        var user = "{{$user_id}}";
        var route = "<?php echo URL::to("user_list"); ?>";
        $.ajax({
            url: route + '?hierarchy_id=' + value,
            type: 'GET',
            success: function (data) {
                var obj = JSON.parse(data);
                console.log(obj);
				var select = "<option value=''>Select</option>";
				obj.forEach(function(i, v) {
					if (user == i.id) {
						select += '<option selected value="' + i.id + '">' + i.name + '</option>';
					} else {
						select += '<option value="' + i.id + '">' + i.name + '</option>';
					}
				});
				$(".userList").html(select);
            }
        });
    });
    $('.userType').trigger('change');
    $('.disaggData').addClass("active");
</script>
@endsection
