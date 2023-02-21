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
        @if(auth()->user()->role_id == 2)
    
                <div class="form-group card-body row">
                    <div class="col-lg-3">
                        <label>Select Date<span style="color: #e9594d;">*</span></label>
                        <input type="text" name="date" class="form-control nepdatepicker" id="nepdatepickerparent"  data-single="true" autocomplete="off" >
                    </div>
                    <div class="col-lg-3">
                        <label>Category:</label>
                            {{Form::select('data[item_category_id]',$category,null,['class' => 'form-control select_category'])}}						
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Items:</label>
                            {{Form::select('data[item_id]',$items,null,['class' => 'form-control select_item'])}}	
                        </select>
                    </div>
                    <div class="col-lg-2" style="margin-top: 24px;">
                        <button type="submit" onclick="setDate()" class="btn btn-secondary">SET</button>
                    </div>
            
                </div>
        @endif
        <div class="card-body">
            <form class="form" id="kt_form" action="{{route('local_level_add')}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10">
                    <thead>
                    <tr>
                        <th >SN</th>
                        <th>Date</th>
                        <th>District</th>
                        <th>Product Category</th>
                        <th>Product Item</th>                       
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
                                <input type="text"  name="data[{{$key}}][date]" class="form-control nepdatepicker"  data-single="true" autocomplete="off" id="nep{{$key}}" required>
                                <!-- <input type="text" name="data[{{$key}}][date]" class="form-control nepdatepicker"  data-single="true" autocomplete="off" id="nep{{$key}}" value="{{$row['date']}}"> -->
                            </td>
        
                            <td>
                                <input type="text" name="data[{{$key}}][district]" class="form-control" autocomplete="off" value="{{$row['district']}}">                               
                            </td>
                            <td>
                                <input  class="form-control category_md" type="text" value="Agriculture" disabled >
                                <input type="text" class="category_input_md"  value="0" disabled >
                            </td>
                            <td>
                                <input  class="form-control item_md" type="text" value="Apple" disabled> 
                                <input type="text" class="item_input_md"  value="0" disabled >                        
                            </td>                           
                            <td>
                                <input type="text" name="data[{{$key}}][quantity]" class="form-control" autocomplete="off" value="{{$row['quantity']}}">
                            </td>
                            <td>
                                <input  class="form-control" type="text" value="Kg" disabled>  
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

        $('.nepdatepicker').nepaliDatePicker(
       
            /*{
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 10
        }*/);

  



         $(".select_item").on("change", function (e) {

            var itemID = $(this).val();

            var name = $( ".select_item option:selected" ).text();

            $(".item_md").val(name)
            $(".item_input_md").val(itemID)

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
            var name = $( ".select_category option:selected" ).text();
            $(".category_md").val(name)
            $(".category_input_md").val(catId)

            ActionOnQuantityUnit(catId);
            $.ajax({
                type: "GET",
                url: "{{route('getItemByCategory')}}",
                data: {catId: catId},
                success: function (response) {
                    $(".select_item").find('option').remove().end().append(response.html);

                    var name = $( ".select_item option:selected" ).text();
                    item_id = $( ".select_item option:selected" ).val();

                    $(".item_md").val(name)
                    $(".item_input_md").val(item_id)
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

        function setDate(){
           var set_to_date = $("#nepdatepickerparent").val()
           if(set_to_date==''){
             alert("Please select Date")
           }
           else{
            $(".nepdatepicker").val(set_to_date)
           }
           
        }
     
    
        
        var name = $( ".select_item option:selected" ).text();
        item_id = $( ".select_item option:selected" ).val();

        $(".item_md").val(name)
        $(".item_input_md").val(item_id)


        var cat_name = $( ".select_category option:selected" ).text();
        var cat_id = $( ".select_category option:selected" ).val();
        $(".category_md").val(cat_name)
        $(".category_input_md").val(cat_id)

    </script>
@endsection
