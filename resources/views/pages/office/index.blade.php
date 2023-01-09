<div class="row" id="office_list">
    <div class="col-xl-12">
        @php $lang = Config::get('app.locale') ;   @endphp
        @foreach ($data as $office)
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-lg-80 symbol-light-primary">
                                <span class="font-size symbol-label font-weight-boldest">{{$office->code}}  </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                <div class="mr-3">
                                    <span class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                    @if($lang == 'np')
                                        {{$office->name_ne}}
                                    @else
                                            {{$office->name}}
                                        @endif
                                    </span>
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
                                            <div class="font-size-h6 mb-2">{{ __('lang.address') }}</div>
                                            <span class="text-uppercase font-weight-bold font-size-h6">
                                                 {{$office->address}}
                                            </span>
                                        </div>
                                        <div class="mr-10">
                                            <div class="font-size-h6 mb-2">{{ __('lang.phone_number') }}</div>
                                            <span class="text-uppercase font-weight-bold font-size-h6">
                                                 {{$office->phone_number}}
                                            </span>
                                        </div>
                                        <div class="mr-10">
                                            <div class="font-size-h6 mb-2">{{ __('lang.user') }}</div>
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
                                    <td> @if($lang == 'np' && !empty($user->name_ne))
                                            {{$user->name_ne}}
                                        @else
                                            {{$user->name}}
                                        @endif
                                        </td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->role->name}}</td>
                                    <td> @if($lang == 'np' && !empty($user->post_ne))
                                            {{$user->post_ne}}
                                        @else
                                            {{$user->post}}
                                        @endif </td>
                                    <td>
                                        <a href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('users.edit',$user->id)}}" data-toggle="tooltip" title="Edit User Details" class="btn btn-icon btn-success btn-xs mr-2"><i class="fa fa-pen"></i></a>
                                         @if (!empty($user->upload_id))
                                            <a href="{{asset('storage/'.$user->uploads->path)}}" data-fancybox data-caption="Identity Document" data-toggle="tooltip" title="View User Document" class="btn btn-icon btn-info btn-xs mr-2"><i class="far fa-image"></i></a>
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
                    @endif
                </div>
            </div>
        @endforeach

    </div>
</div>
<script type="text/javascript">
	var table = $('#kt_datatable');
    table.DataTable({
            responsive: true
        });
</script>
