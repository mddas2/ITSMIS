@extends('layout.frontpage')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-body">
            @include('pages.partials.report_front_tiles')
        </div>
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{ __('lang.office_of_company_registrar') }}</h3>
            </div>
        </div>
        <div class="card-body">

            <form>
                <div class="row mb-6">


                    <div class="col-lg-2 mb-lg-0 mb-6">
                        <label>From Date:</label>
                        <input name="from_date" class="form-control form-control-solid  nepdatepicker" data-single="true"   required
                               value="{{$from_date}}">
                    </div>
                    <div class="col-lg-2 mb-lg-0 mb-6">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid  nepdatepicker" data-single="true"  required
                               value="{{$to_date}}">
                    </div>
                    <div class="col-lg-2 mb-lg-0 mb-6">
                        <button class="btn btn-primary btn-primary--icon" id="kt_search" style="margin-top: 25px;">
                        <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                        </span>
                        </button>&#160;&#160;
                    </div>
                </div>
            </form>


            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <th>Private To Public</th>
                            <th>@if(empty($data->publicToPrivate)) 0 @else {{$data->publicToPrivate}} @endif  </th>
                        </tr>
                        <tr>
                            <th>Liaison Company</th>
                            <th>@if(empty($data->liaisonCompany)) 0 @else {{$data->liaisonCompany}} @endif </th>
                        </tr>
                        <tr>
                            <th>Public To Private</th>
                            <th>@if(empty($data->publicToPrivate)) 0 @else {{$data->publicToPrivate}} @endif  </th>
                        </tr>
                        <tr>
                            <th>Private Company</th>
                            <th>@if(empty($data->privateCompany)) 0 @else {{$data->privateCompany}} @endif </th>
                        </tr>
                        <tr>
                            <th>Total Revenue</th>
                            <th>@if(empty($data->totalRevenue)) 0 @else {{$data->totalRevenue}} @endif </th>
                        </tr>
                       {{-- <tr>
                            <th>Capital Increment</th>
                            <th>@if(empty($data->capitalIncrement)) 0 @else {{$data->capitalIncrement}} @endif </th>
                        </tr>--}}


                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-md-12">
                    <table class="table table-striped">

                        <tbody>
                       {{-- <tr>
                            <th>Name Changed</th>
                            <th>@if(empty($data->nameChanged)) 0 @else {{$data->nameChanged}} @endif  </th>
                        </tr>--}}
                       <tr>
                           <th>Forign Investor Company</th>
                           <th>@if(empty($data->forignInvestorCompany)) 0 @else {{$data->forignInvestorCompany}} @endif </th>

                       </tr>
                        <tr>
                            <th>National Company</th>
                            <th>@if(empty($data->nationalCompany)) 0 @else {{$data->nationalCompany}} @endif </th>
                        </tr>
                        <tr>
                            <th>Public Company</th>
                            <th>@if(empty($data->publicCompany)) 0 @else {{$data->publicCompany}} @endif  </th>
                        </tr>
                        {{--<tr>
                            <th>Address Changed</th>
                            <th>@if(empty($data->addressChanged)) 0 @else {{$data->addressChanged}} @endif </th>
                        </tr>--}}
                        <tr>
                            <th>Non Profite Company</th>
                            <th>@if(empty($data->nonProfiteCompany)) 0 @else {{$data->nonProfiteCompany}} @endif </th>
                        </tr>
                        {{--<tr>
                            <th>Branch Company</th>
                            <th>@if(empty($data->branchCompany)) 0 @else {{$data->branchCompany}} @endif </th>
                        </tr>--}}


                        </tbody>
                    </table>
                </div>
            </div>





        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            paging: true,

            "processing": true,

            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                }
            ]
        });
        $('.ocr').addClass("active");

    </script>
@endsection
