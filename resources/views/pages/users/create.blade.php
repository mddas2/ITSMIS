<div class="card card-custom" style="min-width: 70% !important;">
	<div class="card-header">
		<h3 class="card-title">Create New User</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
        	<div class="form-group row hierarchyRow">
				<div class="col-lg-6">
					<label>Hierarchy:<span style="color: #e9594d;">*</span></label>
					{{Form::select('hierarchy_id',$list,$hierarchy_id,['class'=>'form-control form-control-solid hierarchyList','required'=>true])}}
				</div>
				<div class="col-lg-6">
					<label>{{ __('lang.office') }}:</label>
					{{Form::select('office_id',["0" => "Select Office"],$office_id,['class'=>'form-control form-control-solid officeList'])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-4">
					<label>Provience<span style="color: #e9594d;">*</span></label>
					<select name="provience_id" id="provience_id" class="form-control form-control-solid">
						<option value="1">Provience 1</option>
						<option value="2">Provience 2</option>
						<option value="3">Provience 3</option>
						<option value="4">Provience 4</option>
						<option value="5">Provience 5</option>
						<option value="6">Provience 6</option>
						<option value="7">Provience 7</option>
					</select>
				</div>
				<div class="col-lg-4">
					<label>District:</label>
					<select name="district_id" id="district_id" class="form-control form-control-solid">
						
					</select>
				</div>
				<div class="col-lg-4">
					<label>Municipalitys:</label>
					<select name="municipality_id" id = "muncipality_id" class="form-control form-control-solid">
	
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Name:<span style="color: #e9594d;">*</span></label>
					<input name="name" type="text" class="form-control form-control-solid name" placeholder="Enter name" required autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>नाम:<span style="color: #e9594d;">*</span></label>
					<input name="name_ne" type="text" class="form-control form-control-solid  " placeholder="Enter name in Nepali " required autocomplete="off" />
				</div>

			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Post:<span style="color: #e9594d;">*</span></label>
					<input name="post" type="text" class="form-control form-control-solid" placeholder="Enter Post" autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>पद: <span style="color: #e9594d;">*</span></label>
					<input name="post_ne" type="text" class="form-control form-control-solid" placeholder="Enter Post in Nepali" autocomplete="off" />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('lang.address') }}:</label>
					<input name="address" type="text" class="form-control form-control-solid" placeholder="Enter Address" autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>Role: <span style="color: #e9594d;">*</span></label>
                    <?php
                    if (auth()->user()->role_id == 1) {
                        $roles = [2 => "Admin",3 => "User"];
                    } else {
                        $roles = [3 => "User"];
                    }
                    ?>
					{{Form::select('role_id',$roles,null,['class'=>'form-control form-control-solid','required'=>true])}}
				</div>
			</div>
            <div class="form-group row">
				<div class="col-lg-6">
					<label>Username: <span style="color: #e9594d;">*</span></label>
					<input name="username" type="text" class="form-control form-control-solid username" placeholder="Enter username" required autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>Password:<span style="color: #e9594d;">*</span></label>
					<input name="password" type="password" class="form-control form-control-solid password" placeholder="Enter Password" value="Password1234" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
					<span class="form-text text-muted">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Default Password is <span class="text-primary"><b>Password1234</b></span></span>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('lang.email_address') }}:<span style="color: #e9594d;">*</span></label>
					<input name="email" type="email" class="form-control form-control-solid" placeholder="Enter Email Address" required autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>{{ __('lang.phone_number') }}:</label>
					<input name="contact" type="text" class="form-control form-control-solid" placeholder="Enter Phone Number" autocomplete="off" />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Attach Document:</label>
					<input name="document" type="file" class="form-control"  autocomplete="off" />
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
		var officeId = {!! !empty($office_id)?$office_id : 0 !!};
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
	
$("#provience_id").change(function() {
    var selectedValue = $(this).val();
			$.ajax({
				type: "GET",
				url: "{{route('getDistrict')}}",
				data: { provience_id: selectedValue },
				success: function(data) {
					$("#district_id").empty()
					// console.log(data)
					for(da in data){
						var district = data[da]['alt_name']
						var district_id = data[da]['id']
						$("#district_id").append('<option value="'+district_id+'">'+district+'</option>')
					}
					// Do something with the data returned by the server
				}
		});
	
    // if (selectedValue == "option1") {
    //     $("#district_id").show();
    //     // $("#div2").hide();
    // }
});
//provinces
//municipalities
//districts

$("#district_id").change(function() {
    var selectedValue = $(this).val();
			$.ajax({
				type: "GET",
				url: "{{route('getMuncipality')}}",
				data: { district_id: selectedValue },
				success: function(data) {
					$("#muncipality_id").empty()
					console.log(data)
					for(da in data){
						console.log(da)
						var muncipality = data[da]['alt_name']
						var id = data[da]['municipality_id']
						$("#muncipality_id").append('<option value="'+id+'">'+muncipality+'</option>')
					}
					// Do something with the data returned by the server
				}
		});
	
    // if (selectedValue == "option1") {
    //     $("#district_id").show();
    //     // $("#div2").hide();
    // }
});


</script>
