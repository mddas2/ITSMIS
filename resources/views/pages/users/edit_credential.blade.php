<div class="card card-custom" style="min-width: 50% !important;">
	<div class="card-header">
		<h3 class="card-title">Change Password</h3>
	</div>
	<!--begin::Form-->
	<form class="form" id="kt_form" action="{{route('edit-credential',['id' => $request['id']])}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
        <input type="hidden" name="is_user" value="{{$request['is_user']}}">
		<div class="card-body">
			<div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">Username:</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <input class="form-control username form-control-solid" type="text" name="username" placeholder="Username" value="{{$data->username}}">
                    <span class="form-text text-muted unameMsg" style="display:none;color : red !important;">
                        This username already exists. Choose another one.
                   	</span>
                </div>
            </div>
            @if ($request['is_user'] != 1)
		 	<div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">Old Password:*</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <input class="form-control opass form-control-solid" type="password" name="old_password" placeholder="Old Password" required>
                    <span class="form-text text-muted opassMsg" style="display:none;color : red !important;">
                        Your old password is incorrect.
                    </span>
                </div>
            </div>
            @endif
            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">New Password:*</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <input class="form-control pass form-control-solid" type="password" name="new_password" placeholder="New Password" required> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">Confirm New Password:*</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <input type="password" class="form-control cpass form-control-solid" name="new_c_password" placeholder="Confirm New Password" required>
                    <span class="form-text text-muted passMsg" style="display:none;color : red !important;">
                        Your password and confirm password does not match.
                    </span>
                </div>
            </div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-lg-6">
					<button type="submit" class="btn btn-primary mr-2 updatePass">Save</button>
					<button type="reset" class="btn btn-secondary">Reset</button>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function(){
	$('.username').change(function(e){
    	var username = $('.username').val();
        var userId = {!! $data->id !!};
        $.ajax({
            type : "POST",
            data : {
                'username' : username,
                'id' : userId,
                '_token' : "{{csrf_token()}}"
            },
            url : '{{route("check_username")}}',
            success : function(response) {
                if (response) {
                    $('.updatePass').prop("disabled",false);
                    $('.unameMsg').css("display","none");
                } else {
                    $('.updatePass').prop("disabled",true);
                    $('.unameMsg').css("display","block");
                }
            }
        });
    });

    $('.opass').change(function(){
        var opass = $(this).val();
        var route = "{{route('check-old-pass',':id')}}";
        var userId = {!! $data->id !!};
        route = route.replace(':id', userId);
        $.ajax({
            type : "POST",
            url : route,
            data : {
                "old_password" : opass,
                "_token" : "{{csrf_token()}}"
            },
            success : function(response) {
                if (response) {
                    $('.updatePass').prop("disabled",false);
                    $('.opassMsg').css("display","none");
                } else {
                    $('.updatePass').prop("disabled",true);
                    $('.opassMsg').css("display","block");
                }
                
            }
        })
    });
    $('.pass,.cpass').change(function(e){
        var pass = $('.pass').val();
        var cpass = $('.cpass').val();
        if (pass && cpass) {
            if (pass != cpass) {
                $('.updatePass').prop("disabled",true);
                $('.passMsg').css("display","block");
            } else {
                $('.updatePass').prop("disabled",false);
                $('.passMsg').css("display","none");
            }
        }
       
    });
});
</script>