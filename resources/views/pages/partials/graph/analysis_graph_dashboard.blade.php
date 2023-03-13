
<script>
    //Monthly report

    ajax_production_url = "{{route('AjaxgetMonthlyData')}}"
 
    //Yearly comparision data

</script>
<div class="card-body block_print">        
    <div class="form-group row">
        <div class="col-lg-3">
            <label class="text_good_header" >Category:</label>
            <?php
            $itemList = ["" => "Select Items"];
            $itemList = $itemList + $items;
            ?>
            {{Form::select('item_category_id',$category,null,['class' => 'form-control select_category text_good'])}}
        </div>
        <div class="col-lg-3">
            <label class="text_good_header" >Items:</label>
                <?php
                    $itemList = ["" => "Select Items"];
                    $itemList = $itemList + $items;
                ?>
            {{Form::select('item_id',$itemList,$item_id,['class' => 'form-control select_item text_good'])}}
        </div>
        <div class="col-lg-2" style="margin-top: 24px;">
            <button type="submit" class="btn btn-secondary text_good_header" id="filterItem">Filter</button>
        </div>
    </div>
</div>
          
            <style>
                .text_good_header{
                    font-size:15px !important;
                }
                .text_good{
                    font-size:13px !important;
                    weight:100 !important;
                }
                .item_red{
                    color:red
                }               
                .supply_total{
                    background-color: #e6fbea !important;
                }
                .demand_total{
                    background-color: #f3d2ca !important;
                }

            </style>


<link href="/chart/dist/css/style.min.css" rel="stylesheet">

<div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabular Data</h4>
               
                <button onclick="printWithStyles()" style="float:right; background-color: transparent; border: none; color: transparent;" class="svg-icon svg-icon-3x">
                        <i class="fa fa-print icon-2x"></i>
                </button>
           
                <h6 class="card-subtitle">{{$from_date}} to {{$to_date}}<code>All Items . for Oil  Measurement unit is Liter and other will be in Kg</code></h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th class="md5md">#</th> -->
                                <th class="md5md">Item</th>
                                <th class="md5md">Opening</th>
                                <th class="md5md">Production</th>
                                <th class="md5md">Import</th>
                                <th class="md5md">Total Supply</th>
                                <th class="md5md">Consumption</th>
                                <th class="md5md">Export</th>
                                <th class="md5md">Total Demand</th>
                                <th class="md5md">Stock</th>
                                <th class="md5md block_print">View</th>
                                <!-- <th class="md5md">Demand Fulfilment</th> -->
                                <!-- <th class="md5md">Remarks<th> -->
                            </tr>
                        </thead>
                        <tbody style="font-size: 15px; font-weight: bolder;" id="view_available_item">                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td>A</td>
                                <td>B</td>
                                <td>A+B</td>
                                <td>C</td>
                                <td>D</td>
                                <td>C+D</td>
                                <td>(A+B)-(C+D)</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .md5md{
            font-size:16px !important;
        }
    </style>
<script>
    
     $(".select_category").on("change", function (e) {            
        var catId = $(this).val();
        $("#view_available_item").empty();
        $.ajax({
            type: "GET",
            url: "{{route('putAll_ItemProductionConsumptionCategory')}}",
            data: {catId: catId,year: '{{$from_date}}'},
            success: function (response) {
                // console.log(response);
                for (var dat in response) {
                    $("#view_available_item").append(`<tr>
                                <!----<td>1</td> --->
                                <td>`+response[dat]['obj']['name_np']+`</td>
                                <td>0</td>
                                <td supply_total>`+response[dat]['production']+`</td>
                                <td supply_total>`+response[dat]['import']+`</td>
                                <td supply_total>`+(response[dat]['production']+response[dat]['import'])+`</td>
                                <td class="demand_total">`+response[dat]['consumption']+`</td>
                                <td class="demand_total">`+response[dat]['export']+`</td>
                                <td class="demand_total">`+(response[dat]['consumption']+response[dat]['export'])+`</td>
                                <td>`+((response[dat]['production']+response[dat]['import'])-(response[dat]['consumption']+response[dat]['export']))+`</td>
                                <td class="block_print"> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date={{$from_date}}&to_date={{$to_date}}&item_id=`+response[dat]['obj']['id']+`" style=" text-decoration: none;  color: inherit;">View</a></button></td>
                    </tr>`)
                }
                
            }
        });
    });
    $.ajax({
            type: "GET",
            url: "{{route('putAll_ItemProductionConsumptionCategory')}}",
            data: {catId: '1',year: '{{$from_date}}'},
            success: function (response) {
                // console.log(response);
                for (var dat in response) {
                    $("#view_available_item").append(`<tr>
                                <!----<td>1</td> --->
                                <td>`+response[dat]['obj']['name_np']+`</td>
                                <td>`+response[dat]['opening']+`</td>
                                <td class="supply_total">`+response[dat]['production']+`</td>
                                <td class="supply_total">`+response[dat]['import']+`</td>
                                <td class="supply_total">`+(response[dat]['production']+response[dat]['import'])+`</td>
                                <td class="demand_total">`+response[dat]['consumption']+`</td>
                                <td class="demand_total">`+response[dat]['export']+`</td>
                                <td class="demand_total">`+(response[dat]['consumption']+response[dat]['export'])+`</td>
                                <td>`+((response[dat]['production']+response[dat]['import'])-(response[dat]['consumption']+response[dat]['export']))+`</td>
                                <td class="block_print"> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date={{$from_date}}&to_date={{$to_date}}&item_id=`+response[dat]['obj']['id']+`" style=" text-decoration: none;  color: inherit;">View</a></button></td>
                    </tr>`)
                }
            }
        });

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
            $.ajax({
                type: "GET",
                url: "{{route('getItemByCategory')}}",
                data: {catId: catId},
                success: function (response) {
                    $(".select_item").find('option').remove().end().append(response.html);
                }
            });
        });


        $("#filterItem").on("click",function (e){
            var catId = $(".select_category").val();
            var ItemId = $(".select_item").val();
            $("#view_available_item").empty();
            $.ajax({
                type: "GET",
                url: "{{route('FilterItem')}}",
                data: {catId: catId,item_id:ItemId,year:'{{$from_date}}'},
                success: function (response) {
                    if(response == ''){
                        alert("there is no any data belongs to this item.");
                    }
                    for (var dat in response) {
                    $("#view_available_item").append(`<tr>
                                <!----<td>1</td> --->
                                <td>`+response[dat]['obj']['name_np']+`</td>
                                <td>0</td>
                                <td class="supply_total">`+response[dat]['production']+`</td>
                                <td class="supply_total">`+response[dat]['import']+`</td>
                                <td class="supply_total">`+(response[dat]['production']+response[dat]['import'])+`</td>
                                <td> class="demand_total"`+response[dat]['consumption']+`</td>
                                <td class="demand_total">`+response[dat]['export']+`</td>
                                <td class="demand_total">`+(response[dat]['consumption']+response[dat]['export'])+`</td>
                                <td class="demand_total">`+((response[dat]['production']+response[dat]['import'])-(response[dat]['consumption']+response[dat]['export']))+`</td>
                                <td class="block_print"> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date={{$from_date}}&to_date={{$to_date}}&item_id=`+response[dat]['obj']['id']+`" style=" text-decoration: none;  color: inherit;">View</a></button></td>
                                </tr>`
                            )
                    }              
                }
            });
        });
    function printWithStyles() {
        window.print();
    }

</script>

