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
        {{--@include('pages.partials.corporation_office_header_tiles')--}}


        <div class="card-body">
            <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row"
                role="tablist">
                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                    <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center purchasePage "
                       href="{{route('national_trading_add','purchase')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fab fa-bitbucket icon-2x"></i>
					</span>
				</span>
                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Purchase</span>
                    </a>
                </li>
                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                    <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center SalesStockPage"
                       href="{{route('national_trading_add','SalesStock')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-braille icon-2x"></i>
					</span>
				</span>
                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Sales and Stock</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-header flex-wrap border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Salt Trading Corporation - {{$type}}
                </h3>
            </div>
            <div class="card-toolbar">
                <a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax"
                   data-src="{{route('national-trading-excel-insert',$type)}}"><i
                            class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker"  data-single="true" required
                               value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker"  data-single="true" required
                               value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>Items:</label>
                        <?php
                        $itemList = ["" => "Select Items"];
                        $itemList = $itemList + $items;
                        ?>
                        {{Form::select('item_id',$itemList,null,['class' => 'form-control'])}}
                    </div>
                    <div class="col-lg-2" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            <form class="form" id="kt_form" action="{{route('national_trading_add',$type)}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                    <thead>
                    <tr>
                        <th rowspan="2">SN</th>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">Item</th>
                        <th rowspan="2">Quantity</th>
                        <th rowspan="2">Quantity Unit</th>
                        <th colspan="2">Price</th>
                        @if($type == 'SalesStock')
                            <th rowspan="2">Profit per unit</th>
                            <th rowspan="2">Stock Amount</th>
                        @endif
                        <th rowspan="2">Actions</th>

                    </tr>
                    <tr>
                        <td>Per Unit</td>
                        <td>Total</td>
                    </tr>
                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0; ?>
                    @foreach($data as $row)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
                                <input type="text" name="data[{{$key}}][date]"  data-single="true" class="form-control nepdatepicker"
                                       autocomplete="off" id="nep{{$key}}" value="{{$row->date}}">
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][item_id]',$items,$row->item_id,['class' => 'form-control'])}}
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][quantity]" class="form-control nepdatepicker"
                                       autocomplete="off" value="{{$row->quantity}}">
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][quantity_unit]',$units,$row->quantity_unit,['class' => 'form-control'])}}
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][per_unit_price]" class="form-control"
                                       autocomplete="off" value="{{$row->per_unit_price}}">
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][total_price]" class="form-control"
                                       autocomplete="off" value="{{$row->total_price}}">
                            </td>
                            @if($type == 'SalesStock')
                                <td>
                                    <input type="text" name="data[{{$key}}][profit_per_unit]" class="form-control"
                                           autocomplete="off" value="{{$row->profit_per_unit}}">
                                </td>

                                <td>
                                    <input type="text" name="data[{{$key}}][stock_amount]" class="form-control"
                                           autocomplete="off" value="{{$row->stock_amount}}">
                                </td>
                            @endif
                            <td>

                            </td>
                        </tr>
                        @php $key++; @endphp
                    @endforeach
                    <tr id="firstRow">
                        <td class="sn">{{$key+1}}</td>
                        <td>
                            <input type="hidden" name="data[{{$key}}][id]" value="">
                            <input type="text" name="data[{{$key}}][date]"  data-single="true" class="form-control nepdatepicker"
                                   autocomplete="off" id="nepstart1">
                        </td>
                        <td>
                            {{Form::select('data['.$key.'][item_id]',$items,null,['class' => 'form-control'])}}
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][quantity]" class="form-control ">
                        </td>
                        <td>
                            {{Form::select('data['.$key.'][quantity_unit]',$units,null,['class' => 'form-control'])}}
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][per_unit_price]" class="form-control"
                                   autocomplete="off">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][total_price]" class="form-control"
                                   autocomplete="off">
                        </td>
                        @if($type == 'SalesStock')
                            <td>
                                <input type="text" name="data[{{$key}}][profit_per_unit]" class="form-control"
                                       autocomplete="off">
                            </td>

                            <td>
                                <input type="text" name="data[{{$key}}][stock_amount]" class="form-control"
                                       autocomplete="off">
                            </td>
                        @endif
                        <td id='remRow'>

                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-primary btn-sm add" type="button">
                                <i class="fa fa-plus icon-sm"></i>Add New Row
                            </button>
                        </td>
                        @if($type == 'SalesStock') <td colspan="7"></td> @else <td colspan="5"></td> @endif
                        <td colspan="1">
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

        var type = "{!! $type !!}";
        if (type == "purchase") {
            $('.purchasePage').addClass("active");
        } else {
            $('.SalesStockPage').addClass("active");
        }


        $('.food').addClass("active");

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
            $("[name='data[" + key + "][item_id]']", rowClone).val("");
            $("[name='data[" + key + "][quantity]']", rowClone).val("");
            $("[name='data[" + key + "][quantity_unit]']", rowClone).val("");
            $("[name='data[" + key + "][per_unit_price]']", rowClone).val("");
            $("[name='data[" + key + "][total_price]']", rowClone).val("");
            if ( type == 'SalesStock' ) {
                $("[name='data[" + key + "][profit_per_unit]']", rowClone).val("");
                $("[name='data[" + key + "][stock_amount]']", rowClone).val("");
            }


            $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
            $("[name='data[" + key + "][date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
            $("[name='data[" + key + "][item_id]']", rowClone).attr('name', 'data[' + tableCnt + '][item_id]');
            $("[name='data[" + key + "][quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity]');
            $("[name='data[" + key + "][quantity_unit]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity_unit]');
            $("[name='data[" + key + "][per_unit_price]']", rowClone).attr('name', 'data[' + tableCnt + '][per_unit_price]');
            $("[name='data[" + key + "][total_price]']", rowClone).attr('name', 'data[' + tableCnt + '][total_price]');


            if ( type == 'SalesStock' ) {
                $("[name='data[" + key + "][profit_per_unit]']", rowClone).attr('name', 'data[' + tableCnt + '][profit_per_unit]');
                $("[name='data[" + key + "][stock_amount]']", rowClone).attr('name', 'data[' + tableCnt + '][stock_amount]');
            }


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

        $('.nepdatepicker').nepaliDatePicker(/*{
         language: "english",
         ndpYear: true,
         ndpMonth: true,
         ndpYearCount: 10
         }*/);
    </script>
@endsection
