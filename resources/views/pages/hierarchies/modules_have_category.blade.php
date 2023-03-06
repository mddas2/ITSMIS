@extends('layout.default')
@section('content')
<div class="card card-custom">
 	<div class="card-header">
  		<h3 class="card-title">
   			Manage Access Level
  		</h3>
 	</div>
 	<form class="form" id="kt_form" action="{{route('StoreModuleHasCategory')}}" method="post" enctype="multipart/form-data">
 		{{csrf_field()}}
		<div class="card-body">
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Modules:</label>
                    {{Form::select('module_id',$modules,null,['class'=>'form-control form-control-solid hierarchyList','required'=>true,'size' => 8])}}
				</div>
				<div class="col-lg-6">
					<label>category list:</label>
						<ul class="officeList">
							
						</ul>
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
		var module_id = $(this).val();
		var route = '{{route('getModuleHasCategory')}}';
		var officeId = [];
		$.ajax({
			type: "GET",
			url: route + '?module_id=' + module_id,
			success: function(response) {
				
				if (response.length > 0) {
					$('.modules').val(response);
				}
			}
		});

		var route =  '{{route("getModuleHasCategoryList")}}';
		$.ajax({
			type: "GET",
			url: route + '?module_id=' + module_id,
			success: function(response) {
				// var obj = JSON.parse(response);
				// var select = "";
				$(".officeList").empty();
				Object.keys(response).forEach(function(key) {
					console.log(response[key]['name'])
					$(".officeList").append('<li>'+response[key]['name']+'</li>')
				
				});
			}
		});
	});
	$('.hierarchyList').trigger('change');
</script>

@endsection