@extends('layout.frontpage')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')


        <div class="card card-custom gutter-b">
            <div class="card-body">
                @include('pages.partials.report_front_tiles')
            </div>
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">{{ __('lang.department_of_commerce_supply_and_consumer_right_protection') }}
                        - Market Monitoring</h3>
                </div>
            </div>
            <div class="card-body">
                <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row"
                    role="tablist">
                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center marketMonitoring"
                           href="{{route('front_report_DOCSRPMarketMoniter')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fab fa-connectdevelop icon-2x"></i>
					</span>
				</span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Market Monitoring</span>
                        </a>
                    </li>

                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center firmRegistration"
                           href="{{route('front_report_DOCSRPFirmRegister')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-poll-h icon-2x"></i>
					</span>
				</span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Firm Registration</span>
                        </a>
                    </li>
                    {{--<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center importExportPage" href="{{route('dcsc_import_export_registration')}}">
                    <span class="nav-icon py-3 w-auto">
                        <span class="svg-icon svg-icon-3x">
                            <i class="fas fa-poll-h icon-2x"></i>
                        </span>
                    </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Permission for import and export</span>
                        </a>
                    </li>--}}
                </ul>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label>From Date:</label>
                                    <input name="from_date" class="form-control form-control-solid nepdatepicker"
                                           data-single="true"
                                           required
                                           value="{{$from_date}}">
                                </div>
                                <div class="col-lg-3">
                                    <label>To Date:</label>
                                    <input name="to_date" class="form-control form-control-solid nepdatepicker"
                                           data-single="true"
                                           required
                                           value="{{$to_date}}">
                                </div>
                                <div class="col-lg-2" style="margin-top: 24px;">
                                    <button type="submit" class="btn btn-secondary">Filter</button>


                                </div>

                            </div>
                        </form>
                    </div>

                </div>

                <div id="editor"></div>
                <table class="table table-bordered table-hover table-checkable mt-10   table-striped" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Total No</th>
                        <th>Type of Firm</th>
                        <th>Penalty Category</th>
                        <th>Firm Penalty Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @foreach($frimTypeCount as $k => $num )
                                    @if($k == $row->firmType)
                                        {{$num}}
                                    @endif
                                @endforeach
                            </td>

                            <td>{{$row->firmType}}</td>
                            <td>{{$row->penaltyCategory}}</td>
                            <td>{{$row->firmPenaltyAmount}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
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


        $('.departmentOfcrsp').addClass("active");
        $('.marketMonitoring').addClass("active");

    </script>
@endsection
