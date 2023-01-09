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
        @include('pages.partials.dcsc_header_tiles')
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Firm Registration - Department of Commerce, Supply and Consumer Right Protection
                </h3>
            </div>
            <div class="card-toolbar">
                {{-- <a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax"
                    data-src="{{route('dcsc_firm_registration_excel')}}"><i
                             class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>--}}
            </div>
        </div>

        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker"
                               data-single="true"  id="nepdatepicker1" required value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker"
                               data-single="true"   required value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>

            {{--Rajaswo Collection--}}

                <div class="card-title">
                    <h3 class="card-label">
                        Rajaswo Collection
                    </h3>
                </div>

                <table class="table table-bordered table-hover table-checkable mt-10" id="kt2_datatable">
                    <thead>
                    <tr>

                        <th>Private Fee Collection</th>
                        <th>Sajhedari Fee Collection</th>
                        <th>Agency Fee Collection</th>
                        <th>Company Fee Collection</th>
                        <th>Transportation Fee Collection</th>
                        <th>Transfer Fee Collection</th>
                        <th>Total Fee Collection</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>Rs {{$data->RajaswoCollection->PrivateFeeCollection}}</td>
                        <td>Rs {{$data->RajaswoCollection->SajhedariFeeCollection}}</td>
                        <td>Rs {{$data->RajaswoCollection->AgencyFeeCollection}}</td>
                        <td>Rs {{$data->RajaswoCollection->CompanyFeeCollection}}</td>
                        <td>Rs {{$data->RajaswoCollection->TransportationFeeCollection}}</td>
                        <td>Rs {{$data->RajaswoCollection->TransferFeeCollection}}</td>
                        <td>Rs {{$data->RajaswoCollection->TotalFeeCollection}}</td>

                    </tr>

                    </tbody>
                </table>


        </div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="card-label">
                    Total Frim
                </h3>
            </div>

            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <thead>
                <tr>

                    <th>Total Private Firm</th>
                    <th>Total Shajhedari Firm</th>
                    <th>Total Agency Firm</th>
                    <th>Total Company Firm</th>
                    <th>Total Transportation Firm</th>
                    <th>Total Khareji Count</th>
                    <th>Total Navikaran</th>
                </tr>
                </thead>
                <tbody>

                <tr>

                    <td>{{$data->totalPrivateFirm}}</td>
                    <td>{{$data->totalShajhedariFirm}}</td>
                    <td>{{$data->totalAgencyFirm}}</td>
                    <td>{{$data->totalCompanyFirm}}</td>
                    <td>{{$data->totalTransportationFirm}}</td>
                    <td>{{$data->totalKharejiCount}}</td>
                    <td>{{$data->totalNavikaran}}</td>

                </tr>

                </tbody>
            </table>

        </div>


        {{-- Total Record --}}
        <div class="card-body">
            <div class="card-title">
                <h3 class="card-label">
                    Total Record
                </h3>
            </div>
            {{-- <form class="form" id="kt_form" action="{{route('dcsc_firm_registration')}}" method="post">
                 {{csrf_field()}}--}}
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <thead>
                <tr>
                    <th>Firm Type Count</th>
                    <th>Darta</th>
                    <th>Khareji</th>
                    <th>NonNavikaran</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data->TotalRecords as $totalRecord)
                    <tr>
                        <td>{{$totalRecord->FirmType}}</td>
                        <td>{{$totalRecord->Darta}}</td>
                        <td>{{$totalRecord->Khareji}}</td>
                        <td>{{$totalRecord->NonNavikaran}}</td>
                    </tr>
                @empty

                @endforelse

                </tbody>
            </table>
            {{--</form>--}}
        </div>

        {{--Todays Data--}}
        <div class="card-body">
            <div class="card-title">
                <h3 class="card-label">
                    Todays Data
                </h3>
            </div>
            {{-- <form class="form" id="kt_form" action="{{route('dcsc_firm_registration')}}" method="post">
                 {{csrf_field()}}--}}
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <thead>
                <tr>
                    <th>Today Private Firm Count</th>
                    <th>Today Shajhedari Firm Count</th>
                    <th>Today Agency Firm Count</th>
                    <th>Today Company Firm Count</th>
                    <th>Today Transportation Firm Count</th>
                    <th>Today Samsodhan Count</th>
                    <th>Today Khareji Count Count</th>
                    <th>Today Navikaran Count</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>{{$data->TodayPrivateFirmCount}}</td>
                    <td>{{$data->TodaySajhedariFirmCount}}</td>
                    <td>{{$data->TodayAgencyFirmCount}}</td>
                    <td>{{$data->TodayCompanyFirmCount}}</td>
                    <td>{{$data->TodayTransportationFirmCount}}</td>
                    <td>{{$data->TodaySamsodhanCount}}</td>
                    <td>{{$data->TodayKharejiCount}}</td>
                    <td>{{$data->TodayNavikaranCount}}</td>
                </tr>
                </tbody>
            </table>
            {{--</form>--}}
        </div>
        {{-- Todays Record --}}
        <div class="card-body">
            <div class="card-title">
                <h3 class="card-label">
                    Todays Record
                </h3>
            </div>
            {{-- <form class="form" id="kt_form" action="{{route('dcsc_firm_registration')}}" method="post">
                 {{csrf_field()}}--}}
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <thead>
                <tr>

                    <th>Firm Type Count</th>
                    <th>New Darta</th>
                    <th>Samsodhan</th>
                    <th>Navikaran</th>
                    <th>Khareji</th>

                </tr>
                </thead>
                <tbody>
                @forelse($data->TodayRecords as $todayRecords)
                    <tr>
                        <td>{{$todayRecords->FirmType}}</td>
                        <td>{{$todayRecords->NewDarta}}</td>
                        <td>{{$todayRecords->Samsodhan}}</td>
                        <td>{{$todayRecords->Navikaran}}</td>
                        <td>{{$todayRecords->Khareji}}</td>
                    </tr>
                @empty

                @endforelse

                </tbody>
            </table>
            {{--</form>--}}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        $('.firmRegistration').addClass("active");
        /*var table = $('#kt_datatable');
         table.DataTable({
         responsive: true,
         paging: false
         });*/

        $('.nepdatepicker').nepaliDatePicker(/*{
         language: "english",
         ndpYear: true,
         ndpMonth: true,
         ndpYearCount: 10
         }*/);
    </script>
@endsection
