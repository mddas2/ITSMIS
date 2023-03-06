@extends('layout.default')
@section('content')
<div class="card card-custom">
 	<div class="card-header">
  		<h3 class="card-title">
   			Manage Access Level
  		</h3>
 	</div>
 	<form class="form" id="kt_form" action="{{route('hierarchies.access_level')}}" method="post" enctype="multipart/form-data">
 		{{csrf_field()}}
		<div class="card-body">
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Modules:</label>
					
                    {{Form::select('module_id',$modules,null,['class'=>'form-control form-control-solid hierarchyList','required'=>true,'size' => 8])}}
				</div>
				<div class="col-lg-6">
					<label>category list:</label>
					{{Form::select('office_id[]',[],null,['class'=>'form-control form-control-solid officeList','size' => 8,'multiple'=>true])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-12">
					<label>Category:</label>
                    {{Form::select('id[]',$categories,null,['class'=>'form-control form-control-solid modules','required'=>true,'size' => 8,'multiple'=>true,'required'=>true])}}
					
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-lg-9 ml-lg-auto">
					<button type="submit" class="btn btn-primary mr-2">Submit</button>
					<button type="reset" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-multipleselectsplitter.js')}}"></script>
<script type="text/javascript">
	var roleId = {!! auth()->user()->role_id !!};

	$(document).on('change','.hierarchyList', function() {
		var hierarchy = $(this).val();
		var route = '{{route('getModuleHasCategory')}}';
		var officeId = [];
		$.ajax({
			type: "GET",
			url: route + '?hierarchy_id=' + hierarchy,
			success: function(response) {
				var obj = JSON.parse(response);
				console.log(obj);
				if (obj.office.length > 0) {
					officeId = obj.office;
				}
				if (obj.module.length > 0) {
					$('.modules').val(obj.module);
				}
			}
		});

		var route =  "<?php echo URL::to("office_list"); ?>";
		$.ajax({
			type: "GET",
			url: route + '?hierarchy_id=' + hierarchy,
			success: function(response) {
				var obj = JSON.parse(response);
				var select = "";
				Object.keys(obj).forEach(function(key) {
					if (officeId.includes(key)) {
						select += '<option value="' + key + '" selected>' + obj[key] + '</option >';
					} else {
						select += '<option value="' + key + '">' + obj[key] + '</option >';
					}
				});
				$(".officeList").html(select);
			}
		});
	});
	$('.hierarchyList').trigger('change');
</script>

@endsection