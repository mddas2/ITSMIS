<div class="card card-custom" style="min-width: 80% !important;">
	<div class="card-header">
		<h3 class="card-title">Add New Industry</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('industries.store')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
			<div class="form-group row">
				<div class="col-lg-6 col-xl-6">
					<label>Industry Name:</label>
					<input name="name" type="text" class="form-control form-control-solid" required autocomplete="off" />
				</div>
				<div class="col-lg-6 col-xl-6">
					<label>Sector:</label>
					@php $sector = ["" => "Select Sector",1 => "Agricultural and forestry", 2 => "Production Oriented", 3 => "others"]; @endphp
					{{Form::select('sector',$sector,null,['class' => 'form-control form-control-solid'])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6 col-xl-6">
					<label>Size:</label>
					@php $size = ["" => "Select Size",1 => "Micro", 2 => "Cottage", 3 => "Large", 4 => "Medium", 5 => "Small"]; @endphp
					{{Form::select('size',$size,null,['class' => 'form-control form-control-solid'])}}
				</div>
				<div class="col-lg-6 col-xl-6">
					<label>Type:</label>
					@php $type = ["" => "Select Type",1 => "Type 1", 2 => "Type 2", 3 => "Type 3", 4 => "Type 4"]; @endphp
					{{Form::select('type',$type,null,['class' => 'form-control form-control-solid'])}}
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
		            <button type="submit" class="btn btn-primary mr-2">Save</button>
	             	<button type="reset" class="btn btn-secondary mr-2">Reset</button>
		        </div>
	        </div>
	    </div>
 	</form>
</div>

