@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @if (!empty($hierarchyTitle))
        @include('pages.partials.hierarchy_detail')
    @endif
    @if (!empty($user))
        @include('pages.partials.office_detail')
        <br>
    @endif
    <div class="card card-custom gutter-b">
      
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Market Monitoring - Office of Company Registrar
                </h3>
            </div>
            <div class="card-toolbar">
                {{--      <a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax"
                         data-src="{{route('dcsc_firm_registration_excel')}}"><i
                                  class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>--}}
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input name="from_date" type="date" class="form-control form-control-solid  " required value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" type="date" class="form-control form-control-solid  "
                               required value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            {{-- <form class="form" id="kt_form" action="{{route('dcsc_firm_registration')}}" method="post">
                 {{csrf_field()}}--}}

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-checkable mt-10" id="kt2_datatable">
                        <thead>
                        <tr>

                            <th>Private To Public</th>
                            <th>Liaison Company</th>
                            <th>Public To Private</th>
                            <th>Private Company</th>
                            <th>Total Revenue</th>
                            <th>Capital Increment</th>
                            <th>Forign Investor Company</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>@if(empty($data->privateToPublic)) 0 @else {{$data->privateToPublic}} @endif</td>
                            <td>@if(empty($data->liaisonCompany)) 0 @else {{$data->liaisonCompany}} @endif </td>
                            <td>@if(empty($data->publicToPrivate)) 0 @else {{$data->publicToPrivate}} @endif  </td>
                            <td>@if(empty($data->privateCompany)) 0 @else {{$data->privateCompany}} @endif </td>
                            <td>@if(empty($data->totalRevenue)) 0 @else {{$data->totalRevenue}} @endif </td>
                            <td>@if(empty($data->capitalIncrement)) 0 @else {{$data->capitalIncrement}} @endif </td>
                            <td>@if(empty($data->forignInvestorCompany)) 0 @else {{$data->forignInvestorCompany}} @endif </td>

                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover table-checkable mt-10" id="kt2_datatable">
                        <thead>
                        <tr>
                            <th>Name Changed</th>
                            <th>National Company</th>
                            <th>Public Company</th>
                            <th>Address Changed</th>
                            <th>Non Profite Company</th>
                            <th>Branch Company</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>@if(empty($data->nameChanged)) 0 @else {{$data->nameChanged}} @endif </td>
                            <td>@if(empty($data->nationalCompany)) 0 @else {{$data->nationalCompany}} @endif </td>
                            <td>@if(empty($data->publicCompany)) 0 @else {{$data->publicCompany}} @endif </td>
                            <td>@if(empty($data->addressChanged)) 0 @else {{$data->addressChanged}} @endif </td>
                            <td>@if(empty($data->nonProfiteCompany)) 0 @else {{$data->nonProfiteCompany}} @endif </td>
                            <td>@if(empty($data->branchCompany)) 0 @else {{$data->branchCompany}} @endif </td>

                        </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            {{--</form>--}}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">



    </script>
@endsection
