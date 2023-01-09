@php $lang = Config::get('app.locale') ;   @endphp
<div class="col-xl-7" id="user_list">
    <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable2">
        <thead>
            <tr>
                <th>{{  __('lang.name') }}</th>
                <th>Username</th>
                <th>Role</th>
                <th>{{  __('lang.post') }}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tb_id">
            <?php $key = 0;?>
            @foreach($data as $user)
            <tr>
                <td>@if( $lang == 'np') {{$user->name_ne}} @else {{$user->name}} @endif</td>
                <td>{{$user->username}}</td>
                <td>{{$user->role}}</td>
                <td>@if( $lang == 'np') {{$user->post_ne}} @else {{$user->post}} @endif</td>
                <td>
                    <a href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.edit',$user->id)}}" data-toggle="tooltip" title="Edit User Details" class="btn btn-icon btn-success btn-xs mr-2"><i class="fa fa-pen"></i></a>
                    @if (!empty($user->upload_path))
                    <a href="{{asset('storage/'.$user->upload_path)}}" data-fancybox data-caption="Identity Document" data-toggle="tooltip" title="View User Document" class="btn btn-icon btn-info btn-xs mr-2"><i class="far fa-image"></i></a>
                    @endif
                    <form action="{{ route('users.destroy', $user->id) }}" style="display: inline-block;" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" value="Delete" class="btn btn-icon btn-danger btn-xs mr-2 disableRole" data-toggle="tooltip" title="Disable The User"><i class="fas fa-user-minus"></i></button>
                    </form>
                </td>
            </tr>
            @php $key++; @endphp
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
	var table = $('#kt_datatable2');
    table.DataTable({
            responsive: true
        });
</script>
