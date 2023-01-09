<div class="card card-custom" style="max-width: 50% !important;">
	<div class="card-header">
		<h3 class="card-title">Add Training Type</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('training_types.store')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Training Type:</label>
					<input name="name" type="text" class="form-control form-control-solid" required  />
				</div>
				<div class="col-lg-6">
					<label>Training Type (In Nepali):</label>
					<input name="name_np" type="text" class="form-control form-control-solid" required  />
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

