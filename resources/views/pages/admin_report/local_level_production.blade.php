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
                <h3 class="card-label">Local Level Production</h3>
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
                    <div class="col-lg-3">
                        <label>Items:</label>
                        <?php
                        $itemList = ["" => "Select Items"];
                        $itemList = $itemList + $items;
                        ?>
                        {{Form::select('item_id',$itemList,$item_id,['class' => 'form-control'])}}
                    </div>
                    <div class="col-lg-3" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-hover table-checkable mt-10  table-striped" id="kt_datatable">
                <thead>
                <tr>
                    <th >SN</th>
                    <th >Date</th>
                    <th >Item(Product Description)</th>
                    <th >Import Quantity</th>
                    <th >Unit</th>
                    <th >Sales Quantity</th>

                </tr>

                </thead>
                <tbody id="tb_id">
                <?php $key = 0; ?>
                @foreach($data as $row)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            {{$row->date}}
                        </td>

                        <td>
                            @foreach($items as $a => $item)
                                @if($row->item_id == $a)
                                    {{$item}}
                                @endif
                            @endforeach

                        </td>
                        <td>
                            {{$row->quantity}}
                        </td>
                        <td>
                            @foreach($measurementUnit as $b => $unit)
                                @if($row->unit_id == $b)
                                    {{$unit}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                             {{$row->sales_quantity}}
                        </td>




                    </tr>
                    @php $key++; @endphp
                @endforeach

                </tbody>

            </table>
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

        $('.noc').addClass("active");
    </script>
@endsection
