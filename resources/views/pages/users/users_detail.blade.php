@extends('layout.default')
@section('content')
    @php $lang = Config::get('app.locale') ;   @endphp
    @if (!empty($hierarchyTitle))
        @include('pages.partials.hierarchy_detail')
    @endif
    <div class="row">
        <div class="col-xl-12">
            @include('pages.partials.office_detail')
            <br>
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            @if($lang == 'np') {{$user->name_ne}} @else {{$user->name}} @endif
                            </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-lg-2">Role:</label>
                        <div class="col-lg-10">
                            <span>{{$user->role->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">{{ __('lang.post') }}:</label>
                        <div class="col-lg-10">
                            <span> @if($lang == 'np') {{$user->post_ne}} @else {{$user->post}} @endif </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2">{{ __('lang.email_address') }}:</label>
                        <div class="col-lg-10">
                            <span>{{$user->email}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2">Contact:</label>
                        <div class="col-lg-10">
                            <span>{{$user->contact}}</span>
                        </div>
                    </div>
                    @if (!empty($user->upload_path))
                        <div class="form-group row">
                            <label class="col-lg-2">Identity Document:</label>
                            <div class="col-lg-10">
                                <img src="{{asset('storage/'.$user->upload_path)}}" class="img-responsive">
                            </div>
                        </div>
                    @endif
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