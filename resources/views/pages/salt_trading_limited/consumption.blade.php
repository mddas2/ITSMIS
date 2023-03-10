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
        {{-- @include('pages.partials.corporation_office_header_tiles') --}}
        <div class="card-body">
        <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row"
                role="tablist">
                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center"
                        href="{{route('salt_trading_add','purchase')}}">
                    <span class="nav-icon py-3 w-auto">
                        <span class="svg-icon svg-icon-3x">
                            <i class="fab fa-bitbucket icon-2x"></i>
                        </span>
                    </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Import</span>
                        </a>
                </li>
                <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center active"
                        href="{{route('salt_consumption')}}">
                    <span class="nav-icon py-3 w-auto">
                        <span class="svg-icon svg-icon-3x">
                            <i class="fab fa-bitbucket icon-2x"></i>
                        </span>
                    </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Consumption</span>
                        </a>
                </li>
                <!-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                    <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center SalesStockPage"
                       href="{{route('local_level_addTraining')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-braille icon-2x"></i>
					</span>
				</span>
                        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Entrepreneurship Promotion Program</span>
                    </a>
                </li> -->
            </ul>
        </div>

        <!-- <div class="card-header flex-wrap border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Salt Level - Consumption
                </h3>
            </div>
            <div class="card-toolbar">
                <a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('local_level_production_excel','production')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
            </div>
        </div> -->

    
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker"  data-single="true" required value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker"  data-single="true" required value="{{$to_date}}">
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
        
            <div class="row">
                <div class="card-title mdlr col-md-4">
                    <h3 class="card-label">
                        Salt Consumption
                    </h3>
                </div>
                <div class="card-toolbar mdlr col-md-4">
                    <a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('local_level_production_excel','production')}}" ><i class="fa fa-plus icon-sm"></i>{{ __('Import Excel')}}</a>
                </div>
                <div class="card-toolbar mdlr col-md-4">
                    <a class="btn btn-primary btn-sm" style="float:right;" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('AddSaltNewConsumption')}}" ><i class="fa fa-plus icon-sm"></i>Add new Production</a>
                </div>            
            </div>
               
            <style>
                 #kt_datatable_length{
                    display:none;
                }
                #kt_datatable_filter{
                    display:none;
                }
            </style> 
                @php
                    $flash_ids = Session::get('ids');                   
                @endphp
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <!-- <table class="table table-bordered table-hover table-checkable mt-10"> -->
                    <thead>
                    <tr>
                        <th rowspan="1">SN</th>
                        <th rowspan="1">Date</th>
                        <th rowspan="1">Consume Product</th>                     
                        <th rowspan="1">Quantity</th>
                        <th rowspan="1">Quantity Unit</th>                
                      
                        <th rowspan="1">Actions</th>
                    </tr>

                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0; ?>
                    @foreach($data as $row)
                        <tr  @if (!is_null($flash_ids) && in_array($row->id, $flash_ids)) class = "redflash" @endif>
                            <td>{{$key+1}}</td>
                            <td>
                                {{$row->date}}
                            </td>                     
                            <td>
                                {{$row->getItem->name}}
                            </td>                           
                            <td>
                                {{$row->quantity}}
                            </td>
                            <td>
                                {{$row->unit->name}}
                            </td>                         
                            
                            <td>
                                <form action="#" style="display: inline-block;"
                                        method="get">
                                        <!-- method "post" -->
                                        <!-- {{ method_field('DELETE') }} -->
                                        <!-- {{ csrf_field() }} -->
                                        <a href="#" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip"
                                        title="Delete"><i class="fa fa-trash"></i></a>
                                </form>  
                            </td>
                        </tr>
                        @php $key++; @endphp
                    @endforeach
                  
                    </tbody>
                   
                </table>
        </div>
    </div>
<style>
    .redflash{
        background-color:#c6f5d4;
    }
</style>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
                $("#provience_id option[value='{{session('provience_id')}}']").prop("selected", true);
        var selectedValue = $("#provience_id").val();
                $.ajax({
                    type: "GET",
                    url: "{{route('getDistrict')}}",
                    data: { provience_id: selectedValue },
                    success: function(data) {
                        $("#district_id").empty()
                        // console.log(data)
                        var session_district_id = "{{session('district_id')}}"
                        for(da in data){
                            var district = data[da]['alt_name']
                            var district_id = data[da]['id']
                            if(district_id == session_district_id){
                                var is_select = "selected"
                            }
                            else{
                                var is_select = ""
                            }
                            $("#district_id").append('<option value="'+district_id+'" '+ is_select + '>'+district+'</option>')
                        }
                                var district_selected = $("#district_id").val();
                                $.ajax({
                                    type: "GET",
                                    url: "{{route('getMuncipality')}}",
                                    data: { district_id: district_selected },
                                    success: function(data) {
                                        $("#muncipality_id").empty()
                                        var session_municipality_id = "{{session('municipality_id')}}"
                                        for(da in data){
                                            console.log(da)
                                            var muncipality = data[da]['alt_name']
                                            var id = data[da]['municipality_id']
                                            if(id == session_municipality_id){
                                                var is_select = "selected"
                                            }
                                            else{
                                                var is_select = ""
                                            }
                                            $("#muncipality_id").append('<option value="'+id+'"'+is_select+'>'+muncipality+'</option>')
                                        }
                                    
                                    }
                                });

                        
                    }
            });
        $("#provience_id").change(function() {
            var selectedValue = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "{{route('getDistrict')}}",
                        data: { provience_id: selectedValue },
                        success: function(data) {
                            $("#district_id").empty()
                            // console.log(data)
                            for(da in data){
                                var district = data[da]['alt_name']
                                var district_id = data[da]['id']
                                $("#district_id").append('<option value="'+district_id+'">'+district+'</option>')
                            }
                            
                        }
                });
        });

    $("#district_id").change(function() {
        var selectedValue = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('getMuncipality')}}",
                    data: { district_id: selectedValue },
                    success: function(data) {
                        $("#muncipality_id").empty()
                        console.log(data)
                        for(da in data){
                            console.log(da)
                            var muncipality = data[da]['alt_name']
                            var id = data[da]['municipality_id']
                            $("#muncipality_id").append('<option value="'+id+'">'+muncipality+'</option>')
                        }
                    
                    }
            });
    });
        $('.productEntry').addClass("active");
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
            var updatedTblCount = tableCnt + 1;

            $("[name='data[" + key + "][date]']", rowClone).val("");
            $("[name='data[" + key + "][date]']", rowClone).attr('id', "nepstart" + updatedTblCount);
            $("[name='data[" + key + "][item_id]']", rowClone).val("");
            $("[name='data[" + key + "][item_id]']", rowClone).attr("class", "form-control select_item" + updatedTblCount);
            $("[name='data[" + key + "][item_category_id]']", rowClone).attr("class", "form-control select_category" + updatedTblCount);

            $("[name='data[" + key + "][quantity]']", rowClone).val("");
            $("[name='data[" + key + "][quantity_unit]']", rowClone).val("");
            $("[name='data[" + key + "][produced_by]']", rowClone).val("");


            $("[name='data[" + key + "][id]']", rowClone).attr('name', 'data[' + tableCnt + '][id]');
            $("[name='data[" + key + "][date]']", rowClone).attr('name', 'data[' + tableCnt + '][date]');
            $("[name='data[" + key + "][item_id]']", rowClone).attr('name', 'data[' + tableCnt + '][item_id]');
            $("[name='data[" + key + "][item_category_id]']", rowClone).attr('name', 'data[' + tableCnt + '][item_category_id]');
            $("[name='data[" + key + "][quantity]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity]');
            $("[name='data[" + key + "][quantity_unit]']", rowClone).attr('name', 'data[' + tableCnt + '][quantity_unit]');
            $("[name='data[" + key + "][produced_by]']", rowClone).attr('name', 'data[' + tableCnt + '][produced_by]');

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
            $(".select_item" + updatedTblCount).on("change", function (e) {
                e.preventDefault();
                var itemID = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{route('getCategoryByItem')}}",
                    data: {itemID: itemID},
                    success: function (response) {

                        $(".select_category" + updatedTblCount).val(response.catId);
                    }
                });

            });
            $(".select_category" + updatedTblCount).on("change", function (e) {

                var catId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('getItemByCategory')}}",
                    data: {catId: catId},
                    success: function (response) {
                        $(".select_item" + updatedTblCount ).find('option').remove().end().append(response.html);
                    }
                });
            });
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
        $(".select_item").on("change", function (e) {
            var itemID = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('getCategoryByItem')}}",
                data: {itemID: itemID},
                success: function (response) {

                    $(".select_category").val(response.catId);
                }
            });
        });
        $(".select_category").on("change", function (e) {
            var catId = $(this).val();
            ActionOnQuantityUnit(catId);
            $.ajax({
                type: "GET",
                url: "{{route('getItemByCategory')}}",
                data: {catId: catId},
                success: function (response) {
                    $(".select_item").find('option').remove().end().append(response.html);
                }
            });
        });
        function ActionOnQuantityUnit(catId){
            if(catId == 1){
                $("#quantity_unit_action").val(1);
            }
            else if (catId == 2){
                $("#quantity_unit_action").val(1);
            }
            else if(catId == 3){
                $("#quantity_unit_action").val(2);
            }
            else if(catId == 7){
                $("#quantity_unit_action").val(4);
            }
            else {
                $("#quantity_unit_action").val(1);
            }
            
        }
    </script>
@endsection
