@extends('layout.default')
@section('content')
@if (!empty($hierarchyTitle))
@include('pages.partials.hierarchy_detail')
@endif

@php $lang = Config::get('app.locale') ;   @endphp
<div class="row">
	<div class="col-xl-12">
		@include('pages.partials.office_detail')
		<br>
		<div class="card card-custom">
		 	<div class="card-header">
			  	<div class="card-title">
			   		<h3 class="card-label">Users List</h3>
			  	</div>
			  	<div class="card-toolbar">
			  		<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.create',['hierarchy_id'=>$user->office->hierarchy->id,'office_id'=>$user->office_id])}}" ><i class="fa fa-plus icon-sm"></i>Add New User</a>
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
				                @foreach($data as $row)
				                <tr>
				                    <td>{{$key+1}}</td>
				                    <td>@if($lang == 'np') {{$row->name_ne}} @else {{$row->name}} @endif</td>
				                    <td>{{$row->username}}</td>
				                    <td>{{$row->role}}</td>
				                    <td> @if($lang == 'np') {{$row->post_ne}} @else {{$row->post}} @endif</td>
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