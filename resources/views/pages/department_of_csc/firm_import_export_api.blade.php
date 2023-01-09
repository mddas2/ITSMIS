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
                    Permission For Import And Export - Department of Commerce, Supply and Consumer Right Protection
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
                               id="nepdatepicker1" required value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker"
                               required value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>


            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <thead>
                <tr>


                    <th>Currency Type</th>
                    <th>Payment Mode</th>
                    <th>NOC Request Count</th>
                    <th>Imports Value Amount</th>
                    <th>Revenue Amount</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $row)
                    <tr>

                        <td>  {{$row->currencyType}}</td>
                        <td>  {{$row->paymentMode}}</td>
                        <td>  {{$row->nocRequestCount}}</td>
                        <td>  {{$row->importsValueAmount}}</td>
                        <td>  {{$row->revenueAmount}}</td>
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>


        </div>


    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        $('.importExportPage').addClass("active");
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
