@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-body">
            @include('pages.partials.report_input_header_tiles_new')
        </div>
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{ __('lang.department_of_industry') }}</h3>
            </div>
        </div>




        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker" data-single="true"
                               required
                               value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker" data-single="true"
                               required
                               value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            <h3 class="card-label">Registration Of Industry</h3>
            <table class="table table-bordered table-hover table-checkable mt-10   table-striped" id="kt_datatable">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Total Number Of Industry</th>
                    <th>Category</th>
                    <th>Production Capacity</th>
                    <th>Total Employment No</th>


                </tr>

                </thead>
                <tbody id="tb_id">
                <?php $key = 0; ?>

                @foreach($doi as $row)

                    <tr>
                        <td>{{$key+1}}</td>
                        <td> {{count($doi)}}  </td>
                        <td> {{$row->category}}  </td>
                        <td>{{$row->production_capacity}}</td>
                        <td>{{$row->male + $row->female }} </td>



                    </tr>
                    @php $key++; @endphp
                @endforeach

                </tbody>

            </table>

            <h3 class="card-label">FDI Approval</h3>
            <table class="table table-bordered table-hover table-checkable mt-10   table-striped" id="kt_datatable-fdi">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Total FDI Approval No</th>
                    <th>Nationality of Investors</th>
                    <th>Category</th>
                    <th>Production Capacity</th>
                    <th>Total Employment No</th>


                </tr>

                </thead>
                <tbody id="tb_id">
                <?php $key = 0; ?>

                @foreach($fdi as $row)

                    <tr>
                        <td>{{$key+1}}</td>
                        <td> {{count($fdi)}}  </td>
                        <td> {{$row->nationality_of_investor}}  </td>
                        <td> {{$row->category}}  </td>
                        <td>{{$row->production_capacity}}</td>
                        <td>{{$row->male + $row->female + $row->foreigner + $row->local}} </td>



                    </tr>
                    @php $key++; @endphp
                @endforeach

                </tbody>

            </table>


            <h3 class="card-label">Repatriation Approval</h3>
            <table class="table table-bordered table-hover table-checkable mt-10   table-striped" id="kt_datatable-rep">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Name Of Industry</th>
                    <th>Total Amount </th>
                    <th>Currency</th>
                </tr>

                </thead>
                <tbody id="tb_id">
                <?php $key = 0; ?>

                @foreach($repatriation as $row)

                    <tr>
                        <td>{{$key+1}}</td>
                        <td> {{$row->name_of_industry}}  </td>
                        <td> {{$row->amount}}  </td>
                        <td>{{$row->currency}}</td>
                    </tr>
                    @php $key++; @endphp
                @endforeach

                </tbody>

            </table>

            <div class="row">
                <div class="col-lg-6">
                    <h3 class="card-label">Technology Transfer Agreement Approval</h3>
                    <table class="table table-bordered table-hover table-checkable mt-10   table-striped"  >
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>No of Technology Transfer Agreement Approval</th>

                        </tr>

                        </thead>
                        <tbody id="tb_id">
                        <?php $key = 0; ?>

                        @foreach($technology as $row)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td> {{$row->name_of_industry}}  </td>

                            </tr>
                            @php $key++; @endphp
                        @endforeach

                        </tbody>

                    </table>
                </div>
                <div class="col-lg-6">
                    <h3 class="card-label">Intellectual Property Registration</h3>
                    <table class="table table-bordered table-hover table-checkable mt-10   table-striped" >
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>No of Technology Transfer Approval</th>

                        </tr>

                        </thead>
                        <tbody id="tb_id">


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
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        var table = $('#kt_datatable, #kt_datatable-fdi, #kt_datatable-rep');
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


        $('.departmentOfIndus').addClass("active");

    </script>
@endsection
