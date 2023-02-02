@extends('layout.default')
@section('content')
@if (!empty($hierarchyTitle))
@include('pages.partials.hierarchy_detail')
@endif
@php $lang = Config::get('app.locale') ;   @endphp
<div class="row">
	<div class="col-xl-12">
		<div class="card card-custom">
		 	<div class="card-header">
			  	<div class="card-title">
			   		<h3 class="card-label">{{  _('lang.user') }} {{  _('lang.list') }}</h3>
			  	</div>
			  	<div class="card-toolbar">
			  		<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.create',['hierarchy_id'=>$hierarchy_id])}}" ><i class="fa fa-plus icon-sm"></i>Add New User</a>
			  	</div>
		 	</div>
		 	<div class="card-body">
	 			<div class="row" id="user_list">
				    <div class="col-xl-12">
				        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
				            <thead>
				                <tr>
				                    <th>SN</th>
				                    <th>{{  __('lang.name') }}</th>
				                    <th>Username</th>
				                    <th>Role</th>
	                    			<th>{{  __('lang.post') }}</th>
                			 		<th>Action</th>
				                </tr>
				            </thead>
				            <tbody id="tb_id">
				                <?php $key = 0;?>
				                @foreach($users as $row)
				                <tr>
				                    <td>{{$key+1}}</td>
				                    <td>@if($lang == 'np') {{$row->name_ne}} @else {{$row->name}} @endif</td>
				                    <td>{{$row->username}}</td>
				                    <td>{{$row->role}}</td>
				                    <td>@if($lang == 'np') {{$row->post_ne}} @else {{$row->post}} @endif</td>
				                    <td>
                        				<a href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.edit',$row->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-icon btn-success btn-xs mr-2"><i class="fa fa-pen"></i></a>
				                        <form action="{{ route('users.destroy', $row->id) }}" style="display: inline-block;" method="post">
				                            {{ method_field('DELETE') }}
				                            {{ csrf_field() }}
				                            <button type="submit" value="Delete" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn"><i class="fa fa-trash"></i></button>
				                        </form>
				                        <a href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('edit-credential',['id'=>$row->id,'is_user'=>true])}}" data-toggle="tooltip" title="Edit User Credentials" class="btn btn-icon btn-info btn-xs mr-2"><i class="fas fa-key"></i></a>
				                    </td>
				                </tr>
				                @php $key++; @endphp
				                @endforeach
				            </tbody>
				        </table>
				    </div>
				</div>
		 	</div>
		</div>
		<br>
		<div class="card card-custom">
		 	<div class="card-header">
			  	<div class="card-title">
			   		<h4 class="card-label">Manage Office & Their Users</h4>
			  	</div>
			  	<div class="card-toolbar">
			  		<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('offices.create',['hierarchy_id'=>$hierarchy_id])}}" ><i class="fa fa-plus icon-sm"></i>Add New Office</a>
			  	</div>
		 	</div>
		 	<div class="card-body">
		        @foreach ($offices as $office)
		            <div class="card card-custom gutter-b">
		                <div class="card-body">
		                    <div class="d-flex">
		                        <div class="flex-shrink-0 mr-7">
		                            <div class="symbol symbol-lg-80 symbol-light-primary">
		                                <span class="font-size symbol-label font-weight-boldest">{{$office->code}}</span>
		                            </div>
		                        </div>
		                        <div class="flex-grow-1">
		                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
		                                <div class="mr-3">
		                                    <span class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
		                                    {{$office->name}}</span>
		                                </div>
		                                <div class="my-lg-0 my-1">
		                                    <a href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('offices.edit',$office->id)}}" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Edit Office Detail</a>
		                                    <a class="btn btn-sm btn-light-info font-weight-bolder text-uppercase mr-2" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.create',['hierarchy_id' => $hierarchy_id,'office_id'=>$office->id])}}" >Add New Users</a>
		                                </div>
		                            </div>
		                            <div class="d-flex align-items-center flex-wrap justify-content-between">
		                                <div class="d-flex flex-wrap align-items-center py-2">
		                                    <div class="d-flex align-items-center mr-10">
		                                        <div class="mr-10">
		                                            <div class="font-size-h6 mb-2">Address</div>
		                                            <span class="text-uppercase font-weight-bold font-size-h6">
		                                                 {{$office->address}}
		                                            </span>
		                                        </div>
		                                        <div class="mr-10">
		                                            <div class="font-size-h6 mb-2">Phone Number</div>
		                                            <span class="text-uppercase font-weight-bold font-size-h6">
		                                                 {{$office->phone_number}}
		                                            </span>
		                                        </div>
		                                        <div class="mr-10">
		                                            <div class="font-size-h6 mb-2">Users</div>
		                                            <span class="text-uppercase font-weight-bold font-size-h6">
		                                                {{count($office->users)}}
		                                            </span>
		                                        </div>
		                                    </div>

		                                </div>
		                            </div>
		                        </div>
		                    </div>

		                    @if (!empty($office->users))
		                    <div class="separator separator-solid my-2"></div>
		                    <div class="d-flex align-items-center flex-wrap">
		                        <caption>Users</caption>
		                        <table class="table table-hover table-checkable mt-4">
		                            <thead>
		                                <tr>
		                                    <th>Name</th>
		                                    <th>Username</th>
		                                    <th>Role</th>
		                                    <th>Post</th>
		                                    <th>Action</th>
		                                </tr>
		                            </thead>
		                            <tbody id="tb_id">
		                                <?php $key = 0;?>
		                                @foreach($office->users as $user)
		                                <tr>
		                                    <td>{{$user->name}}</td>
		                                    <td>{{$user->username}}</td>
		                                    <td>{{$user->role->name}}</td>
		                                    <td>{{$user->post}}</td>
		                                    <td>
		                                        <a href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.edit',$user->id)}}" data-toggle="tooltip" title="Edit User Details" class="btn btn-icon btn-success btn-xs mr-2"><i class="fa fa-pen"></i></a>
		                                        <form action="{{ route('users.destroy', $user->id) }}" style="display: inline-block;" method="post">
		                                            {{ method_field('DELETE') }}
		                                            {{ csrf_field() }}
		                                            <button type="button" value="Delete" class="btn btn-icon btn-danger btn-xs mr-2 disableRole" data-toggle="tooltip" title="Disable The User"><i class="fas fa-user-minus"></i></button>
		                                        </form>
		                                    </td>
		                                </tr>
		                                @php $key++; @endphp
		                                @endforeach
		                            </tbody>
		                        </table>
		                    </div>
		                    @endif
		                </div>
		            </div>
		        @endforeach
		    </div>
	    </div>
    </div>
</div>
<script type="text/javascript">
	var table = $('#kt_datatable');
    table.DataTable({
            responsive: true
        });
</script>

	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	var table = $('#kt_datatable');
    table.DataTable({
            responsive: true
        });
</script>
@endsection