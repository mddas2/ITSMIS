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
                    Market Monitoring - Department of Commerce, Supply and Consumer Right Protection
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
                        <input name="from_date" class="form-control form-control-solid nepdatepicker" data-single="true" required value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker"
                               data-single="true" required value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
           {{-- <form class="form" id="kt_form" action="{{route('dcsc_firm_registration')}}" method="post">
                {{csrf_field()}}--}}
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Firm Name</th>
                        <th>Firm Address</th>
                        <th>Firm Proprietor</th>
                        <th>Firm Contact</th>
                        <th>Disposed Quantity</th>
                        <th>Disposed Amount</th>
                        <th>Firm Penalty Amount</th>
                        <th>Firm Type</th>
                        <th>Penalty Category</th>
                        <th>Investigation Officer</th>
                        <th>Firm Remarks</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->firmName}}</td>
                            <td>{{$row->firmAddress}}</td>
                            <td>{{$row->firmProprietor}}</td>
                            <td>{{$row->firmContact}}</td>
                            <td>{{$row->disposedQuantity}}</td>
                            <td>{{$row->disposedAmount}}</td>
                            <td>{{$row->firmPenaltyAmount}}</td>
                            <td>{{$row->firmType}}</td>
                            <td>{{$row->penaltyCategory}}</td>
                            <td>{{$row->investigationOfficer}}</td>
                            <td>{{$row->firmRemarks}}</td>
                        </tr>
                    @endforeach
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
        $('.marketMonitoring').addClass("active");
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            paging: false
        });

        $('.nepdatepicker').nepaliDatePicker();
    </script>
@endsection
