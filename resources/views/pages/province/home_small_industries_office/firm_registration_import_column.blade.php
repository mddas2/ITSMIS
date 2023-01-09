<div class="card card-custom" style="min-width: 70% !important;">
	<div class="card-header">
		<h3 class="card-title">Import New Column</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('hasio_firm_registration_import_column')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
        	<div class="form-group row hierarchyRow">
				<div class="col-lg-6">
					<label>Column Name:</label>
					<input name="column_name" type="text" class="form-control form-control-solid name" placeholder="Enter Column Name" required autocomplete="off" />
					<span class="form-text text-muted">
                       	Column name should be all lower case and replace space with underscode (_).
                    </span>
				</div>
				<div class="col-lg-6">
					<label>Data Type:</label>
					@php $dataType = ['Integer' => 'Integer','String' => 'String','Text' => 'Text']; @endphp
					{{Form::select('data_type',$dataType,null,['class'=>'form-control form-control-solid','required'=>true])}}
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
