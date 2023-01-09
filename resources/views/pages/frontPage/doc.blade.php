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
                <h3 class="card-label">{{ __('lang.department_of_custom') }} {{$type}} site</h3>
            </div>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row"
                    role="tablist">
                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center exportPage"
                           href="{{route('front_report_doc','export')}}">
					<span class="nav-icon py-3 w-auto">
						<span class="svg-icon svg-icon-3x">
							<i class="far fa-chart-bar icon-2x"></i>
						</span>
					</span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Export Site Information</span>
                        </a>
                    </li>
                    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center importPage"
                           href="{{route('front_report_doc','import')}}">
					<span class="nav-icon py-3 w-auto">
						<span class="svg-icon svg-icon-3x">
							<i class="fas fa-poll-h icon-2x"></i>
						</span>
					</span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Import Site Information</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                         <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center importExportPage"
                            href="{{route('permission_import_export')}}">
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
                <form>
                    <div class="form-group row">
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label>From Date:</label>
                            <input name="from_date" class="form-control form-control-solid nepdatepicker" data-single="true"   required
                                   value="{{$from_date}}">
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label>To Date:</label>
                            <input name="to_date" class="form-control form-control-solid nepdatepicker" data-single="true"   required
                                   value="{{$to_date}}">
                        </div>
                        <div class="col-lg-3">
                            <label>Items:</label>
                            <select class="form-control" name="item">
                                <option value="">Select Item</option>
                                @forelse($items as $row)
                                    <option value="{{$row->item}}" @if($row->item == $item) selected @endif>{{$row->item}}</option>
                                @empty
                                @endforelse
                            </select>


                        </div>
                        <div class="col-lg-3">
                            <label>Customs:</label>
                            <select class="form-control" name="customs">
                                <option value="">Select Customs {{$custom_port}}</option>
                                @forelse($customs_ports as $row)
                                    <option value="{{$row->customs}}" @if($row->customs == $custom_port) selected @endif>{{$row->customs}}</option>
                                @empty
                                @endforelse
                            </select>


                        </div>
                        <div class="col-lg-2" style="margin-top: 24px;">
                            <button type="submit" class="btn btn-secondary">Filter</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-hover table-checkable mt-10 table-striped" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Date</th>

                        <th>Item</th>

                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Customs</th>
                        <th>CIF Value</th>


                    </tr>
                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0; $lock = 1;?>
                    @foreach($data as $row)

                        <?php
                        if ($row->locked == 1) {
                            $disabled = "disabled";
                        } else {
                            $disabled = "false";
                        }

                        ?>

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>

                                @php
                                    $nepFromDate = explode('-',$row->asmt_date);
                                       $fromDate = toNepali($nepFromDate[0], $nepFromDate[1], $nepFromDate[2],'en');
                                       $engFromDate=  $fromDate['year'].'-'.$fromDate['month'].'-'.$fromDate['date'] ;
                                       $engFromDate = date('Y-m-d',strtotime($engFromDate));


                                @endphp
                                {{$engFromDate }}
                            </td>

                            <td>
                                {{$row->item}}
                            </td>

                            <td>
                                {{$row->unit_id}}
                            </td>
                            <td>
                                {{$row->quantity}}
                            </td>
                            <td>
                                {{$row->customs}}
                            </td>
                            <td>
                                {{$row->cif_value}}
                            </td>


                        </tr>
                    @php $key++; @endphp
                    @endforeach

                </table>


            </div>
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


        $('.departmentOfCustom').addClass("active");
        var type = "{!! $type !!}";
        if (type == "export") {
            $('.exportPage').addClass("active");
        } else {
            $('.importPage').addClass("active");
        }

    </script>
@endsection
