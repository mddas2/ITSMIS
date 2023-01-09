@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Local Level -  Entrepreneurship Promotion Program
                </h3>
            </div>
        </div>
        <div class="card-body">
            <form class="form" id="kt_form" action="{{route('local_level_add')}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10">
                    <thead>
                    <tr>
                        <th >SN</th>
                        <th>Date</th>
                        <th>Produced Product</th>
                        <th>Produced Category</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Produced By</th>



                        {{-- <?php
                         for ($i=10; $i < count($columns); $i++) {
                             $column = ucfirst(str_replace('_'," ", $columns[$i]));
                             echo '<th>'.$column.'</th>';
                         }
                         ?>--}}
                    </tr>
                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0; ?>
                    @foreach($formatData as $row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <input type="hidden" name="data[{{$key}}][id]" value="">
                                <input type="text" name="data[{{$key}}][date]" class="form-control nepdatepicker"  data-single="true" autocomplete="off" id="nep{{$key}}" value="{{$row['date']}}">
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][item_id]',$items,$row['item_id'],['class' => 'form-control'])}}
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][item_category_id]',$itemCategory,$row['item_category_id'],['class' => 'form-control'])}}
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][quantity]" class="form-control" autocomplete="off" value="{{$row['quantity']}}">
                            </td>
                            <td>
                                {{Form::select('data['.$key.'][quantity_unit]',$units,$row['quantity_unit'],['class' => 'form-control'])}}
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][produced_by]" class="form-control" autocomplete="off" value="{{$row['produced_by']}}">
                            </td>
                            <?php
                            /*                            for ($i=10; $i < count($columns); $i++) {
                                                            $value = $row[$columns[$i]];
                                                            echo '<td><input type="text" name="data['.$key.']['.$columns[$i].']" class="form-control" autocomplete="off" value="'.$value.'" ></td>';
                                                        }
                                                        */?>
                        </tr>
                        @php $key++; @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
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
        $('.marketMonitoring').addClass("active");
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true ,
            paging: false
        });

        $(document).on('click', '#remRow', function() {
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
