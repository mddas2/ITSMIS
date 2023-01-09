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
                    <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center TariningProgram"
                       href=" ">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-braille icon-2x"></i>
					</span>
				</span>
                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Entrepreneurship Promotion Program</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-header flex-wrap border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Home Industry Promotion Center - Training
                </h3>
            </div>
            <div class="card-toolbar">
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
                        $trainingList = ["" => "Select Training Type"];
                        $trainingList = $trainingList + $training_types;
                        ?>
                        {{Form::select('item_id',$trainingList,null,['class' => 'form-control'])}}
                    </div>
                    <div class="col-lg-2" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
            <form class="form" id="kt_form" action="{{route('hipc_addTraining')}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                    <thead>
                    <tr>
                        <th rowspan="1">SN</th>
                        <th rowspan="1">Date</th>
                        <th rowspan="1">Program</th>
                        <th rowspan="1">Program (In Nepali)</th>
                        <th rowspan="1">Training Type</th>
                        <th rowspan="1">Male</th>
                        <th rowspan="1">Female</th>
                        <th colspan="1">Age</th>
                        <th colspan="1">Budget Spend(per unit)</th>
                        <th rowspan="1">Actions</th>

                    </tr>

                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0; ?>
                    @foreach($data as $row)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <input type="hidden" value="{{$row->id}}">
                                <input type="text" class="form-control nepdatepicker"  data-single="true"
                                       autocomplete="off" id="nep{{$key}}" value="{{$row->date}}" disabled="">
                            </td>
                            <td>
                                <input type="text" name="program" class="form-control"
                                       autocomplete="off" value="{{$row->program}}" disabled="">
                            </td>
                            <td>
                                <input type="text" name="program_ne" class="form-control"
                                       autocomplete="off" value="{{$row->program_ne}}" disabled="">
                            </td>
                            <td>
                                {{Form::select('training_type_id',$trainingList,$row->training_type_id,['class' => 'form-control  ','disabled'=> 'disabled'])}}
                            </td>
                            <td>
                                <input type="text" name="male" class="form-control"  value="{{$row->male}}" disabled="">
                            </td>
                            <td>
                                <input type="text" name="female" class="form-control"  value="{{$row->female}}" disabled="">
                            </td>
                            <td>
                                <input type="text" name="age" class="form-control"  value="{{$row->age}}" disabled="">
                            </td>
                            <td>
                                <input type="text" name="budget_spend_per_unit" class="form-control"  value="{{$row->budget_spend_per_unit}}" disabled="">
                            </td>
                            <td>

                            </td>
                        </tr>


                        @php $key++; @endphp
                    @endforeach
                    <tr id="firstRow">
                        <td class="sn">{{$key+1}}</td>
                        <td>
                            <input type="hidden" name="data[{{$key}}][id]">
                            <input type="text" name="data[{{$key}}][date]"   data-single="true" class="form-control nepdatepicker"
                                   autocomplete="off" id="nepstart1">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][program]" class="form-control"
                                   autocomplete="off" value="">
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][program_ne]" class="form-control"
                                   autocomplete="off" value="">
                        </td>
                        <td>
                            {{Form::select('data['.$key.'][training_type_id]',$trainingList,null,['class' => 'form-control  '])}}
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][male]" class="form-control"  value="" >
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][female]" class="form-control"  value="" >
                        </td>
                        <td>
                            <input type="text" name="data[{{$key}}][age]" class="form-control"  value="" >
                        </td>

                        <td>
                            <input type="text" name="data[{{$key}}][budget_spend_per_unit]" class="form-control"  value="" >
                        </td>


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
                        <td colspan="7"></td>
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


        $('.TariningProgram').addClass("active");


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
            var updatedTblCount = tableCnt + 1;

            $("[name='data[" + key + "][date]']", rowClone).val("");
            $("[name='data[" + key + "][date]']", rowClone).attr('id', "nepstart" + updatedTblCount);
            $("[name='data[" + key + "][program]']", rowClone).val("");
            $("[name='data[" + key + "][program_ne]']", rowClone).val("");
            $("[name='data[" + key + "][training_type_id]']", rowClone).val("");
            $("[name='data[" + key + "][male]']", rowClone).val("");
            $("[name='data[" + key + "][female]']", rowClone).val("");
            $("[name='data[" + key + "][age]']", rowClone).val("");
            $("[name='data[" + key + "][budget_spend_per_unit]']", rowClone).val("");

            $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
            $("[name='data[" + key + "][date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
            $("[name='data[" + key + "][program]']", rowClone).attr('name', 'data[' + tableCnt + '][program]');
            $("[name='data[" + key + "][program_ne]']", rowClone).attr('name', 'data[' + tableCnt + '][program_ne]');
            $("[name='data[" + key + "][training_type_id]']", rowClone).attr('name', 'data[' + tableCnt + '][training_type_id]');
            $("[name='data[" + key + "][male]']", rowClone).attr('name', 'data[' + tableCnt + '][male]');
            $("[name='data[" + key + "][female]']", rowClone).attr('name', 'data[' + tableCnt + '][female]');
            $("[name='data[" + key + "][age]']", rowClone).attr('name', 'data[' + tableCnt + '][age]');
            $("[name='data[" + key + "][budget_spend_per_unit]']", rowClone).attr('name', 'data[' + tableCnt + '][budget_spend_per_unit]');

            $("td#remRow", rowClone).html('<a href="#" id="remRow" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>');
            $('.sn', rowClone).html(tableCnt + 1);
            tb_id.append(rowClone);
            tableCnt++;
            $('#nepstart' + updatedTblCount).nepaliDatePicker(/*{
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
