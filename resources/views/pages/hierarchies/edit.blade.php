<div class="card card-custom">
	<div class="card-header">
		<div class="card-title">
			<h3 class="card-label">
				<span class="d-block text-dark font-weight-bolder">Edit User Hierarchy</span>
			</h3>
		</div>
	</div>
	<div class="card-body">
		<div id="manage_hierarchy">
			<form class="form" id="kt_form" action="{{route('hierarchies.update',$data->id)}}" method="post" enctype="multipart/form-data">
			    {{csrf_field()}}
			    <input type="hidden" name="_method" value="PUT" enctype="multipart/form-data">
			        <div class="form-group row">
			            <div class="col-lg-12">
			                <label>Parent:<span style="color: #e9594d;">*</span></label>
			                {{Form::select('parent_id', $list, $data->parent_id,['class' => 'form-control form-control-solid','required'=>false])}}
			            </div>
			        </div>
			        <div class="form-group row">
			            <div class="col-lg-6">
			                <label>Name:<span style="color: #e9594d;">*</span></label>
			                <input name="name" type="text" class="form-control form-control-solid" placeholder="Enter Name" required autocomplete="off" value="{{$data->name}}" />
			            </div>
						<div class="col-lg-6">
							<label>नाम:<span style="color: #e9594d;">*</span></label>
							<input name="name_ne" type="text" class="form-control form-control-solid" placeholder="Enter Name" required autocomplete="off" value="{{$data->name_ne}}" />
						</div>
			        </div>
			        <div class="row">
			            <div class="col-lg-12">
			                <button type="submit" class="btn btn-primary mr-2">Save</button>
			                <button type="reset" class="btn btn-secondary mr-2">Reset</button>
			            </div>
			        </div>

			</form>
		</div>
	</div>
</div>