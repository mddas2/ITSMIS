<script>
    //Monthly report
    ajax_production_item_fetch_id = "{{$item_name->id}}"
    ajax_production_url = "{{route('AjaxgetMonthlyData')}}"
    ajax_production_year = "{{$monthly_year}}"
    pmc_v = "{{round($total_consumption/12)}}" //per_month_consumption
    pmc = []
    pmc.length = 12
    pmc.fill(pmc_v)

    //Yearly comparision data
    yearly_url = "{{route('AjaxGetYearlyData')}}"
    line_chart = "{{route('AjaxGetYearlyLineChartData')}}" 


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
                        <label class="text_good_header" >Items:</label>
                        <?php
                        $itemList = ["" => "Select Items"];
                        $itemList = $itemList + $items;
                        ?>
                        {{Form::select('item_id',$itemList,$item_id,['class' => 'form-control text_good'])}}
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
    <h4 class="card-title">{{$monthly_year}} Monthly data of {{$item_name->name_np}}</h4>
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
               
                @foreach($monthly_data as $key=>$data)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$data}} mt</td>
                        <td>{{round($total_consumption/12)}} mt</td>
                        @php
                            $surplus_deficit = $data-round($total_consumption/12);
                            if($surplus_deficit>0){
                                $success_danger = "success";
                                $title = "Surplus ";
                            }
                            else{
                                $success_danger = "danger";
                                $title = "Deficit ";
                            }
                            if($data > 0 && $surplus_deficit > 0){
                                $perc = $surplus_deficit/$data * 100; 
                                
                            }
                            else{
                                $perc = 100; 
                            }
                            $title = $title.$surplus_deficit;                            
                            
                        @endphp
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-{{$success_danger}}" data-toggle="tooltip" data-placement="top" title="{{$title}}" style="width: {{$perc ?? 1}}% ;height:6px;"></div>
                            </div>
                        </td>  
                        <td><button class="button btn-sm">View</button></td>                                              
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

