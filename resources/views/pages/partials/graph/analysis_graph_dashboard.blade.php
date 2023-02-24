<script>
    //Monthly report

    ajax_production_url = "{{route('AjaxgetMonthlyData')}}"
 
    //Yearly comparision data
  

</script>
<div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
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
                    </div>
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
                        <button type="submit" class="btn btn-secondary text_good_header ">Filter</button>
                    </div>
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


    
    <div class="card-body">
    <h4 class="card-title">all items in {{$monthly_year}}</h4>
    <!-- <h6 class="card-subtitle">Add<code>.table-striped</code>for borders on all sides of the table and cells.</h6> -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Production</th>
                    <th>Consumption</th>
                    <th>Surplus/Deficit Progress</th>
                    <th>View</th>
                    <!-- <th>Consumption</th> -->
                    
                </tr>
            </thead>
            <tbody>
                @foreach($all_data_p_c as $key=>$data)
                    <!-- dd($data['obj']->id); -->
                    <tr>
                        <td>{{$data['obj']->name_np}}</td>
                        
                        <td>{{$data['production']}} mt</td>
               
                        <td>{{$data['consumption']}} mt</td>
                   
                        @php
                            
                            $surplus_deficit = $data['production']-$data['consumption'];
                            
                            if($surplus_deficit>0){
                                $success_danger = "success";
                                $title = "Surplus ";
                                $perc = $surplus_deficit/$data['production'] * 100;
                            }
                            else{
                                $success_danger = "danger";
                                $title = "Deficit ";
                                $perc = ($surplus_deficit*-1)/$data['consumption'] * 100;
                            }
                                         
                            $title = $title.strval($surplus_deficit);                            
                            
                        @endphp
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-{{$success_danger}}" data-toggle="tooltip" data-placement="top" title="{{$title}}" style="width: {{$perc ?? 1}}% ;height:6px;"></div>
                            </div>
                        </td>  
                        <td> <button class="btn btn-primary"><a href="{{route('central_analysis')}}?from_date=2079-01-33&to_date=2079-12-33&item_id={{$data['obj']->id}}" style=" text-decoration: none;  color: inherit;">View</a></button></td>                                              
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(".select_item").on("change", function (e) {
        var itemID = $(this).val();
        // alert(itemID)
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
        // alert(catId)
        
        $.ajax({
            type: "GET",
            url: "{{route('getItemByCategory')}}",
            data: {catId: catId},
            success: function (response) {
                $(".select_item").find('option').remove().end().append(response.html);
            }
        });
    });
   
</script>
