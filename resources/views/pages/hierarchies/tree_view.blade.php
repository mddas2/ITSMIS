@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
	<div class="col-xl-12">	
		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<h4 class="card-label">
						Manage User Hierarchy & Their Users
					</h4>
				</div>
				<div class="card-toolbar">
					<a class="btn btn-success btn-xs mr-2 hierarchyBtn" href="javascript:;" data-fancybox data-type="ajax" data-src=""><i class="fa fa-pen"></i>Edit Hierarchy</a>&nbsp;
					<a class="btn btn-primary btn-xs mr-2 " href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('hierarchies.create')}}" ><i class="fa fa-plus"></i>Add New Hierarchy</a>
					<a class="btn btn-primary btn-xs mr-2 addNewUserBtn" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.create')}}" ><i class="fa fa-plus"></i>Add New User</a>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-xl-5">	
						<div id="kt_tree_4" class="tree-demo" style="overflow: scroll;"></div>
					</div>
					<div class="col-xl-7" id="user_list">	
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="col-xl-8">	
		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<h4 class="card-label">
						Manage Office
					</h4>
				</div>
				<div class="card-toolbar">
					<a class="btn btn-info btn-sm officeCreateBtn" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('offices.create')}}"><i class="fa fa-plus icon-sm"></i>{{ __ ('lang.add_new_data')}}</a>&nbsp;
				</div>
			</div>
			<div class="card-body">
				<div id="office_list">
					
				</div>
			</div>
		</div>
	</div> -->
</div>
<br>
<div class="row">
	<div class="col-xl-12">	
		<div class="card card-custom" id="user_list">
		 	<div class="card-header">
			  	<div class="card-title">
			   		<h4 class="card-label">Manage Office & Their Users </h4>
			  	</div>
			  	<div class="card-toolbar">
			  		<a class="btn btn-success btn-sm officeCreateBtn" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('offices.create')}}" ><i class="fa fa-plus icon-sm"></i>Add New Office</a>
				   	
			  	</div>
		 	</div>
		 	<div class="card-body">
	 			<div id="office_list">
					
				</div>
		 	</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	var card = new KTCard('kt_card_1');
	var card2 = new KTCard('kt_card_2');
	var table = $('#kt_datatable');
    table.DataTable({
            responsive: true 
        });

	$('#hierarchyTab').trigger("click");
</script>
<script src="{{asset('plugins/custom/jstree/jstree.bundle.js')}}"></script>
<script type="text/javascript">
	var data = {!! json_encode($tree); !!};
	$("#kt_tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': data
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-primary"
                },
                "file" : {
                    "icon" : "fa fa-file  text-primary"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "state", "types" ]
        });
	$('#kt_tree_4').on('changed.jstree', function (e, data) {
		if (data != undefined) {
			if (data.node != undefined) {
				var route = "{{route('hierarchies.edit',':id')}}"
				route = route.replace(':id', data.node.id);
				$('.hierarchyBtn').data('src',route);

				var officeRoute = "{{ route('offices.create')}}";
				a = officeRoute + '?hierarchy_id=' + data.node.id;
				$('.officeCreateBtn').data('src',a);

				var userRoute = "{{ route('users.create')}}";
				a = userRoute + '?hierarchy_id=' + data.node.id;
				$('.addNewUserBtn').data('src',a);

				//$('#user_list').replaceWith("");

				var office = "<?php echo URL::to("offices"); ?>";
				$.ajax({
		            url: office + '?hierarchy_id=' + data.node.id,
		            type: 'GET',
		            success: function (data) {
		            	$('#office_list').replaceWith(data);
		            }
		        });

		        var users = "<?php echo URL::to("users"); ?>";
				$.ajax({
		            url: users + '?hierarchy_id=' + data.node.id +'&is_office=false',
		            type: 'GET',
		            success: function (data) {
		            	$('#user_list').replaceWith(data);
		            }
		        });
			}
		} else {
			var route = "{{route('hierarchies.create')}}"
			$.ajax({
	            url: route,
	            type: 'GET',
	            success: function (data) {
	            	$('#manage_hierarchy').replaceWith(data);
	            }
	        });
		}
        
    });
  	$("#kt_tree_4").jstree().deselect_all(true);
    // $('#kt_tree_4').trigger("changed.jstree");
    // $("#kt_tree_4").jstree().deselect_all(true);

    $('.addNew').click(function(e){
    	e.preventDefault();
    	var route = "{{route('hierarchies.create')}}"
		$.ajax({
            url: route,
            type: 'GET',
            success: function (data) {
            	$('#manage_hierarchy').replaceWith(data);
            }
        });
    });

    $(document).on('click','.getUserList', function() {
		var route = $(this).attr('data-src');
		$.ajax({
			type: "GET",
			url: route,
			success: function (data) {
            	$('#user_list').replaceWith(data);
            }
        });
	});

	$(document).on('change', '.name', function() {
		var name = $(this).val();
		var username = name.substr(0,name.indexOf(' ')).toLowerCase();
		$('.username').val(username);
		$('.username').trigger('change');
	});
</script>


<script src="{{asset('js/pages/features/miscellaneous/treeview.js')}}"></script>
@endsection