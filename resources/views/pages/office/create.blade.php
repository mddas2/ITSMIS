<div class="card card-custom" style="min-width: 60% !important;">
	<div class="card-header">
		<h3 class="card-title">Create New Office</h3>
	</div>

	<form class="form" id="kt_form" action="{{route('offices.store')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
        	<div class="form-group row">
				<div class="col-lg-6">
					<label>Hierarchy:<span style="color: #e9594d;">*</span></label>
					{{Form::select('hierarchy_id',$list,$hierarchy_id,['class'=>'form-control form-control-solid hierarchies','required'=>true])}}
				</div>
				<div class="col-lg-6 provinceList">
					<label>Province:<span style="color: #e9594d;">*</span></label>
					{{Form::select('province_id',$province,null,['class'=>'form-control form-control-solid province'])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6 districtList">
					<label>District:<span style="color: #e9594d;">*</span></label>
					{{Form::select('district_id',[],null,['class'=>'form-control form-control-solid district'])}}
				</div>
				<div class="col-lg-6 municipalityList">
					<label>Municipality:<span style="color: #e9594d;">*</span></label>
					{{Form::select('municipality_id',[],null,['class'=>'form-control form-control-solid municipality'])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>Name:<span style="color: #e9594d;">*</span></label>
					<input name="name" type="text" class="form-control form-control-solid" placeholder="Enter name" required autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>नाम:<span style="color: #e9594d;">*</span></label>
					<input name="name_ne" type="text" class="form-control form-control-solid" placeholder="Enter name in Nepali" required autocomplete="off" />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('lang.address') }}:</label>
					<input name="address" type="text" class="form-control form-control-solid" placeholder="Enter Address" required autocomplete="off" />
				</div>
				<div class="col-lg-6">
					<label>{{ __('lang.phone_number') }}:</label>
					<input name="phone_number" type="text" class="form-control form-control-solid" placeholder="Enter Phone Number" required autocomplete="off" />
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
	$(document).ready(function(){
		//$(document).on('change', '.hierarchies', function() {
		// 	var hierarchy = $(this).val();
		// 	if (hierarchy == 4) {
		// 		$('.provinceDistrictRow').css('display','flex');
		// 		$('.provinceList').css('display','block');
		// 	} else if (hierarchy == 5) {
		// 		$('.provinceDistrictRow').css('display','flex');
		// 		$('.provinceList').css('display','block');
		// 		$('.districtList').css('display','block');
		// 	} else {
		// 		$('.provinceDistrictRow').css('display','none');
		// 	}
		// });
		// $('.hierarchies').trigger('change');

		$(document).on('change','.province', function() {
			var province = $(this).val();
			var districtId = {!! !empty($data)?$data->district_id : 0 !!};
			var route =  "<?php echo URL::to("district_list"); ?>";
			$.ajax({
				type: "GET",
				url: route + '?province_id=' + province,
				success: function(response) {
					var obj = JSON.parse(response);
					var select = "";
					Object.keys(obj).forEach(function(key) {
						if (districtId == key) {
							select += '<option value="' + key + '" selected>' + obj[key] + '</option >';
						} else {
							select += '<option value="' + key + '">' + obj[key] + '</option >';
						}
					});
					//$('.gradeFilter').trigger('click');
					$(".district").html(select);
				}
			});
		});
		$('.province').trigger('change');

		$(document).on('change','.district', function() {
			var district = $(this).val();
			var muniId = {!! !empty($data)?$data->municipality_id : 0 !!};
			var route =  "<?php echo URL::to("municipality_list"); ?>";
			$.ajax({
				type: "GET",
				url: route + '?district_id=' + district,
				success: function(response) {
					var obj = JSON.parse(response);
					var select = "";
					Object.keys(obj).forEach(function(key) {
						if (muniId == key) {
							select += '<option value="' + key + '" selected>' + obj[key] + '</option >';
						} else {
							select += '<option value="' + key + '">' + obj[key] + '</option >';
						}
					});
					//$('.gradeFilter').trigger('click');
					$(".municipality").html(select);
				}
			});
		});
	});
</script>