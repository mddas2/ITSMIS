@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-1">
            <div class="card-title">
                <h3 class="card-label">Nepal Oil Corporation - Excel Import</h3>
            </div>
        </div>
        <div class="card-body">
            <form class="form" id="kt_form" action="{{route('noc_add')}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10">
                    <thead>
                    <tr>
                        <th rowspan="2">SN</th>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">Item(Product Description)</th>
                        <th rowspan="2">Import Quantity</th>
                        <th rowspan="2">Unit</th>
                        <th rowspan="2">Import Cost (Per Unit)</th>
                        <th colspan="2">Stock</th>
                        <th rowspan="2">Sales Quantity</th>
                    </tr>
                    <tr>
                        <td>Stock Date</td>
                        <td>Stock Quantity</td>
                    </tr>
                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0;?>
                    @foreach($formatData as $row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <input type="hidden" name="data[{{$key}}][id]" value=" ">
                                <input type="text" name="data[{{$key}}][date]"  data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row['date']}}" >
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][item_id]',$items,$row['item_id'],['class' => 'form-control'])}}
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][quantity]" class="form-control"
                                       autocomplete="off" value="{{$row['quantity']}}"  >
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][unit_id]',$units,$row['unit'],['class' => 'form-control'])}}
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][import_cost]" class="form-control"
                                       autocomplete="off" value="{{$row['import_cost']}}">
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][stock_date]"   data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep0{{$key}}" value="{{$row['stock_date']}}" >
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][stock_quantity]" class="form-control" autocomplete="off"
                                       value="{{$row['stock_quantity']}}">
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][sales_quantity]" class="form-control" autocomplete="off"
                                       value="{{$row['sales_quantity']}}">
                            </td>
                        </tr>
                        @php $key++; @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="7">
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fa fa-plu icon-sm"></i>Save Changes
                            </button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        $('.exportPage').addClass("active");
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            paging: false
        });

        var key = {!! $key !!};
        var tableCnt = $('#tb_id tr').length;
        var tb_id = $('#tb_id');
        $('.add').click(function (e) {
            var rowClone = $("#firstRow").clone();
            $("[name='data[" + key + "][date]']", rowClone).val("");
            $("[name='data[" + key + "][date]']", rowClone).attr('id', "nepstart" + tableCnt + 1);
            $("[name='data[" + key + "][firm_name]']", rowClone).val("");
            $("[name='data[" + key + "][item_id]']", rowClone).val("");
            $("[name='data[" + key + "][quantity]']", rowClone).val("");
            $("[name='data[" + key + "][cost]']", rowClone).val("");
            $("[name='data[" + key + "][port]']", rowClone).val("");

            $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
            $("[name='data[" + key + "][date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
            $("[name='data[" + key + "][firm_name]']", rowClone).attr('name', 'data[' + tableCnt + '][firm_name]');
            $("[name='data[" + key + "][item_id]']", rowClone).attr('name', 'data[' + tableCnt + '][item_id]');
            $("[name='data[" + key + "][quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity]');
            $("[name='data[" + key + "][cost]']", rowClone).attr('name', 'data[' + tableCnt + '][cost]');
            $("[name='data[" + key + "][port]']", rowClone).attr('name', 'data[' + tableCnt + '][port]');
            $("td#remRow", rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
            $('.sn', rowClone).html(tableCnt + 1);
            tb_id.append(rowClone);
            tableCnt++;
            $('.nepdatepicker').nepaliDatePicker(/*{
                language: "english",
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10
            }*/);

        });

        $(document).on('click', '#remRow', function () {
            if (tableCnt > 1) {
                $(this).closest('tr').remove();
                tableCnt--;
            }
            return false;
        });

        $('.edit').click(function (e) {
            e.preventDefault();
            $(this).parents('tr').find('input').attr('disabled', false);
            $(this).parents('tr').find('select').attr('disabled', false);
        });

        $('.nepdatepicker').nepaliDatePicker(/*{
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 10
        }*/);
    </script>
@endsection
