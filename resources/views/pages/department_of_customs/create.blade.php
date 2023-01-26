@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @if (!empty($hierarchyTitle))
        @include('pages.partials.hierarchy_detail')
    @endif

    @if (!empty($user->office))
        @include('pages.partials.office_detail')
        <br>
    @endif
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row"
                role="tablist">
                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                    <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center exportPage"
                       href="{{route('department-of-custom','export')}}">
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
                       href="{{route('department-of-custom','import')}}">
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
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Department Of Customs - {{$type}} site</h3>
            </div>
            <div class="card-toolbar">
                <a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax"
                   data-src="{{route('dce-excel-insert',['type'=>$type])}}"><i
                            class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input  name="from_date" class="form-control form-control-solid  "    required type="date"    value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid  "  type="date"    required
                               value="{{$to_date}}">
                    </div>

                    <div class="col-lg-2" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            <form class="form" id="kt_form" action="{{route('department-of-custom',$type)}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Date</th>
                        <th>hscode</th>
                        <th>Category</th>
                        <th>Item</th>
                        
                        <!-- <th>Description</th> -->
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Customs</th>
                        <th>CIF Value</th>
                        <!-- <th>hs4</th>
                        <th>ch</th> -->

                        <?php
                        for ($i = 11; $i < count($columns); $i++) {
                            $column = ucfirst(str_replace('_', " ", $columns[$i]));
                            echo '<th>' . $column . '</th>';
                        }
                        ?>
                        <th>Actions</th>

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
                                <input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
                                <input type="date" name="data[{{$key}}][asmt_date]"   data-single="true" class="form-control  "
                                       autocomplete="off" id="nep{{$key}}" value="{{$row->asmt_date}}" {{$disabled}}>
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][hscode]" class="form-control"
                                       autocomplete="off" value="{{$row->hscode}}" {{$disabled}}>
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][category]" value="{{$row->getCategory->name_np ?? ''}}" class="form-control" disabled autocomplete="off">
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][category]" value="{{$row->getItem->name_np ?? ''}}" class="form-control" autocomplete="off">
                            </td>
                         
                            <!-- <td>
                                <input type="text" name="data[{{$key}}][item]" class="form-control"
                                       autocomplete="off" value="{{$row->item}}" {{$disabled}}>
                            </td> -->
                            <!-- <td>
                                <input type="text" name="data[{{$key}}][description]" class="form-control"
                                       autocomplete="off" value="{{$row->description}}" {{$disabled}}>
                            </td> -->
                            <td>
                                {{Form::select('data['.$key.'][unit_id]',$measurementUnit,null,['class' => 'form-control select_item item_md'])}}                           
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][quantity]" class="form-control"
                                       autocomplete="off" value="{{$row->quantity}}" {{$disabled}}>
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][customs]" class="form-control"
                                       autocomplete="off" value="{{$row->customs}}" {{$disabled}}>
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][cif_value]" class="form-control" autocomplete="off"
                                       value="{{$row->cif_value}}" {{$disabled}}>
                            </td>
                            <!-- <td>
                                <input type="text" name="data[{{$key}}][hs4]" class="form-control" autocomplete="off"
                                       value="{{$row->hs4}}" {{$disabled}}>
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][ch]" class="form-control" autocomplete="off"
                                       value="{{$row->ch}}" {{$disabled}}>
                            </td> -->
                            <?php
                            for ($i = 11; $i < count($columns); $i++) {
                                $value = $row[$columns[$i]];
                                echo '<td><input type="text" name="data[' . $key . '][' . $columns[$i] . ']" class="form-control" autocomplete="off" value="' . $value . '" ' . $disabled . '></td>';
                            }
                            ?>
                            <td>
                                <?php if ($disabled == "disabled") {?>
                                <a href="javascript:;" class="btn btn-danger btn-xs mr-2"></i>Locked</a>
                                <?php }?>
                            </td>

                        </tr>
                        @php $key++; @endphp
                    @endforeach
                    <tr id="firstRow">
                        <td class="sn">{{$key+1}}</td>
                        <td>
                            <input type="hidden" name="data[{{$key}}][id]" value="">
                            <input type="date" name="data[{{$key}}][asmt_date]"   class="form-control  "
                                   autocomplete="off" id="nepstart1">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][hscode]" class="form-control" autocomplete="off">
                        </td>
                        <td>
                            {{Form::select('data['.$key.'][category]',$category,null,['class' => 'form-control select_category'])}}
                        </td>
                        <td>
                            {{Form::select('data['.$key.'][item]',$items,null,['class' => 'form-control select_item item_md'])}}                           
                        </td>
                        <!-- <td>
                            <input type="text" name="data[{{$key}}][item]" class="form-control" autocomplete="off">
                        </td> -->
                        <!-- <td>
                            <input type="text" name="data[{{$key}}][description]" class="form-control" autocomplete="off">
                        </td> -->
                        <td>
                            {{Form::select('data['.$key.'][unit_id]',$measurementUnit,null,['class' => 'form-control select_item item_md'])}}                           
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][quantity]" class="form-control" autocomplete="off">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][customs]" class="form-control" autocomplete="off">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][cif_value]" class="form-control" autocomplete="off">
                        </td>
                        <!-- <td>
                            <input type="text" name="data[{{$key}}][hs4]" class="form-control" autocomplete="off">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][ch]" class="form-control" autocomplete="off">
                        </td> -->
                        <?php
                        for ($i = 11; $i < count($columns); $i++) {
                            echo '<td><input type="text" name="data[' . $key . '][' . $columns[$i] . ']" class="form-control" autocomplete="off"></td>';
                        }
                        ?>
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
                        <td colspan="6"></td>
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
    <style>
        .item_md{
            width:110px;
        }
    </style>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        var type = "{!! $type !!}";
        if (type == "export") {
            $('.exportPage').addClass("active");
        } else {
            $('.importPage').addClass("active");
        }

        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            paging: true
        });

        var key = {!! $key !!};
        var tableCnt = $('#tb_id tr').length;
        var tb_id = $('#tb_id');
        $('.add').click(function (e) {
            var rowClone = $("#firstRow").clone();
            $("[name='data[" + key + "][asmt_date]']", rowClone).val("");
            $("[name='data[" + key + "][hscode]']", rowClone).val("");
            $("[name='data[" + key + "][item]']", rowClone).val("");
            $("[name='data[" + key + "][description]']", rowClone).val("");
            $("[name='data[" + key + "][unit_id]']", rowClone).val("");
            $("[name='data[" + key + "][quantity]']", rowClone).val("");
            $("[name='data[" + key + "][customs]']", rowClone).val("");
            $("[name='data[" + key + "][cif_value]']", rowClone).val("");
            $("[name='data[" + key + "][hs4]']", rowClone).val("");
            $("[name='data[" + key + "][ch]']", rowClone).val("");

            $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
            $("[name='data[" + key + "][asmt_date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
            $("[name='data[" + key + "][hscode]']", rowClone).attr('name', 'data[' + tableCnt + '][hscode]');
            $("[name='data[" + key + "][item]']", rowClone).attr('name', 'data[' + tableCnt + '][item_id]');
            $("[name='data[" + key + "][description]']", rowClone).attr('name', 'data[' + tableCnt + '][item]');
            $("[name='data[" + key + "][unit_id]']", rowClone).attr('name', 'data[' + tableCnt + '][unit]');
            $("[name='data[" + key + "][quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity]');
            $("[name='data[" + key + "][customs]']", rowClone).attr('name', 'data[' + tableCnt + '][cost]');
            $("[name='data[" + key + "][cif_value]']", rowClone).attr('name', 'data[' + tableCnt + '][revenue]');
            $("[name='data[" + key + "][hs4]']", rowClone).attr('name', 'data[' + tableCnt + '][revenue]');
            $("[name='data[" + key + "][ch]']", rowClone).attr('name', 'data[' + tableCnt + '][revenue]');
            $("td#remRow", rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
            $('.sn', rowClone).html(tableCnt + 1);
            tb_id.append(rowClone);
            tableCnt++;



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


    </script>
@endsection
