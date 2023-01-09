<div class="card card-custom" style="min-width: 70% !important;">
	<div class="card-header">
		<h3 class="card-title">Edit User Details</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('users.update',$data->id)}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="hidden" name="_method" value="PUT" enctype="multipart/form-data">
		<div class="card-body">
        	<div class="form-group row hierarchyRow">
				<div class="col-lg-6">
					<label>Hierarchy:<span style="color: #e9594d;">*</span></label>
					{{Form::select('hierarchy_id',$list,$data->hierarchy->hierarchy_id,['class'=>'form-control form-control-solid hierarchyList','required'=>true])}}
				</div>
				<div class="col-lg-6">
					<label>{{ __('lang.office') }}:</label>
					{{Form::select('office_id',["0" => "Select Office"],$data->office_id,['class'=>'form-control form-control-solid officeList','required'=>true])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Name:<span style="color: #e9594d;">*</span></label>
					<input name="name" type="text" class="form-control form-control-solid name" placeholder="Enter name" required autocomplete="off" value="{{$data->name}}"/>
				</div>
				<div class="col-lg-6">
					<label>नाम:<span style="color: #e9594d;">*</span></label>
					<input name="name_ne" type="text" class="form-control form-control-solid name" placeholder="Enter name in Nepali" required autocomplete="off" value="{{$data->name_ne}}"/>
				</div>

			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Post:<span style="color: #e9594d;">*</span></label>
					<input name="post" type="text" class="form-control form-control-solid" placeholder="Enter Post" autocomplete="off" value="{{$data->post}}" />
				</div>
				<div class="col-lg-6">
					<label>पद:<span style="color: #e9594d;">*</span></label>
					<input name="post_ne" type="text" class="form-control form-control-solid" placeholder="Enter Post in Nepali" autocomplete="off" value="{{$data->post_ne}}" />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Role:<span style="color: #e9594d;">*</span></label>
                    <?php
                    if (auth()->user()->role_id == 1) {
                        $roles = [2 => "Admin",3 => "User"];
                    } else {
                        $roles = [3 => "User"];
                    }
                    ?>
					{{Form::select('role_id',$roles,$data->role_id,['class'=>'form-control form-control-solid','required'=>true])}}
				</div>
				<div class="col-lg-6">
					<label>{{ __('lang.address') }}:</label>
					<input name="address" type="text" class="form-control form-control-solid" placeholder="Enter Address" autocomplete="off" value="{{$data->address}}" />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('lang.email_address') }}:<span style="color: #e9594d;">*</span></label>
					<input name="email" type="email" class="form-control form-control-solid" placeholder="Enter Email Address" required autocomplete="off" value="{{$data->email}}" />
				</div>
				<div class="col-lg-6">
					<label>{{ __('lang.phone_number') }}:</label>
					<input name="contact" type="text" class="form-control form-control-solid" placeholder="Enter Phone Number" autocomplete="off" value="{{$data->contact}}" />
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
<script type="text/javascript">
	var roleId = {!! auth()->user()->role_id !!};
	if (roleId != 1) {
		$('.hierarchyRow').css('display','none');
	}
	
	$(document).on('change','.hierarchyList', function() {
		var hierarchy = $(this).val();
		var officeId = {!! !empty($data->office_id)?$data->office_id : 0 !!};
		var route =  "<?php echo URL::to("office_list"); ?>";
		$.ajax({
			type: "GET",
			url: route + '?hierarchy_id=' + hierarchy,
			success: function(response) {
				var obj = JSON.parse(response);
				var select = "";
				Object.keys(obj).forEach(function(key) {
					if (officeId == key) {
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
