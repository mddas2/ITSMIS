<div class="card card-custom" style="min-width: 40% !important;">
	<div class="card-header">
		<h3 class="card-title">Add New Indicator</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('indicator_ocr.store')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
			<div class="form-group row">
				<div class="col-lg-6 col-xl-6">
					<label>Indicator Name:</label>
					<input name="name" type="text" class="form-control form-control-solid" required autocomplete="off" />
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

