
<script>
    //Monthly report

    ajax_production_url = "{{route('AjaxgetMonthlyData')}}"
 
    //Yearly comparision data
  

</script>
<div class="card-body">
            <form>
                <div class="form-group row">
                    <!-- <div class="col-lg-3">
                        <label class="text_good_header">From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker text_good" data-single="true"
                               required
                               value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label class="text_good_header">To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker text_good" data-single="true"
                               required
                               value="{{$to_date}}">
                    </div> -->
                    <div class="col-lg-3">
                        <label class="text_good_header" >Category:</label>
                        <?php
                        $itemList = ["" => "Select Items"];
                        $itemList = $itemList + $items;
                        ?>
                        {{Form::select('item_category_id',$category,null,['class' => 'form-control select_category text_good'])}}
                    </div>
                    <!-- <div class="col-lg-3">
                        <label class="text_good_header" >Items:</label>
                        ?php
                        $itemList = ["" => "Select Items"];
                        $itemList = $itemList + $items;
                        ?
                        {{Form::select('item_id',$itemList,$item_id,['class' => 'form-control select_item text_good'])}}
                    </div> -->
                    <!-- <div class="col-lg-2" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary text_good_header ">Filter</button>
                    </div> -->
                </div>
            </form>
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
            </style>
            @if($data->count()>0)
                <table class="table table-bordered table-hover table-checkable mt-10 table-striped" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Date</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Quantity Unit</th>
                        <th>Stock Quantity</th>
                        <th>Sales Quantity</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php  $key = 0; ?>
                    @foreach($data as $row)

                        @if($row->date == $row->salesDate)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td> {{$row->date}} </td>
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
                                @foreach($units as $b => $unit)
                                    @if($row->quantity_unit == $b)
                                        {{$unit}}
                                    @endif
                                @endforeach
                            </td>


                                <td>
                                    {{$row->stock_quantity}}
                                </td>

                                <td>
                                    {{$row->sales_quantity}}
                                </td>
                        </tr>
                        @php $key++; @endphp
                        @endif

                    @endforeach
                    </tbody>
                </table>
            @endif


        </div>




<link href="/chart/dist/css/style.min.css" rel="stylesheet">


<div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabular Data</h4>
                <h6 class="card-subtitle">{{$monthly_year}}<code>All Items</code></h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th class="md5md">#</th> -->
                                <th class="md5md">Item</th>
                                <th class="md5md">Production</th>
                                <th class="md5md">Import</th>
                                <th class="md5md">Total</th>
                                <th class="md5md">Consumption</th>
                                <th class="md5md">Export</th>
                                <th class="md5md">Total</th>
                                <th class="md5md">Stock</th>
                                <th class="md5md">View</th>
                                <!-- <th class="md5md">Demand Fulfilment</th> -->
                                <!-- <th class="md5md">Remarks<th> -->
                            </tr>
                        </thead>
                        <tbody style="font-size: 15px; font-weight: bolder;" id="view_available_item">                            
                           
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
            data: {catId: catId,year: '{{$monthly_year}}'},
            success: function (response) {
                // console.log(response);
                for (var dat in response) {
                    console.log(response[dat]['id'])
                    $("#view_available_item").append(`<tr>
                                <!----<td>1</td> --->
                                <td>`+response[dat]['obj']['name_np']+`</td>
                                <td>`+response[dat]['production']+`</td>
                                <td>`+response[dat]['import']+`</td>
                                <td>`+(response[dat]['production']+response[dat]['import'])+`</td>
                                <td>`+response[dat]['consumption']+`</td>
                                <td>`+response[dat]['export']+`</td>
                                <td>`+(response[dat]['consumption']+response[dat]['export'])+`</td>
                                <td>`+((response[dat]['production']+response[dat]['import'])-(response[dat]['consumption']+response[dat]['export']))+`</td>
                                <td> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date=2079-01-33&to_date=2079-12-33&item_id=`+response[dat]['obj']['id']+`" style=" text-decoration: none;  color: inherit;">View</a></button></td>
                    </tr>`)
                }
                
            }
        });
    });
    $.ajax({
            type: "GET",
            url: "{{route('putAll_ItemProductionConsumptionCategory')}}",
            data: {catId: '1',year: '{{$monthly_year}}'},
            success: function (response) {
                // console.log(response);
                for (var dat in response) {
                    console.log(response[dat])
                    $("#view_available_item").append(`<tr>
                                <!----<td>1</td> --->
                                <td>`+response[dat]['obj']['name_np']+`</td>
                                <td>`+response[dat]['production']+`</td>
                                <td>`+response[dat]['import']+`</td>
                                <td>`+(response[dat]['production']+response[dat]['import'])+`</td>
                                <td>`+response[dat]['consumption']+`</td>
                                <td>`+response[dat]['export']+`</td>
                                <td>`+(response[dat]['consumption']+response[dat]['export'])+`</td>
                                <td>`+((response[dat]['production']+response[dat]['import'])-(response[dat]['consumption']+response[dat]['export']))+`</td>
                                <td> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date=2079-01-33&to_date=2079-12-33&item_id=`+response[dat]['obj']['id']+`" style=" text-decoration: none;  color: inherit;">View</a></button></td>
                    </tr>`)
                }
            }
        });
</script>

<!-- <td> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date=2079-01-33&to_date=2079-12-33&item_id=$data['obj']->id" style=" text-decoration: none;  color: inherit;">View</a></button></td>                                               -->