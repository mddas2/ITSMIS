<script>
    //Monthly report
    ajax_production_item_fetch_id = "{{$item_name->id}}"
    ajax_production_url = "{{route('AjaxgetMonthlyData')}}"
    ajax_production_year = "{{$year}}"
    pmc_v = "{{round($total_consumption/12)}}" //per_month_consumption
    pmc = []
    pmc.length = 12
    pmc.fill(pmc_v)

    //Yearly comparision data
    yearly_url = "{{route('AjaxGetYearlyData')}}"
    line_chart = "{{route('AjaxGetYearlyLineChartData')}}" 
</script>
<div class="card-body block_print">
            <form>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label class="text_good_header">From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker text_good" data-single="true"
                               required
                               value="{{$from_date}}">
                    </div>
                    <div class="col-lg-2">
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
</div>


<link href="/chart/dist/css/style.min.css" rel="stylesheet">

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

        <link href="/chart/node_modules/morrisjs/morris.css" rel="stylesheet">

        <script src="/chart/node_modules/raphael/raphael-min.js"></script>
        <script src="/chart/node_modules/morrisjs/morris.js"></script>
        <script src="/chart/dist/js/pages/morris-data.js"></script>
        
    <!-- Donute Chart open-->

    <div id="print_md1" class="card">
        <div class="card-body">
            <h4 class="card-title"><span class="item_red">Item name {{$item_name->name_np}}<span> (???????????? {{$from_date}}/{{$to_date}}) 
                <button onclick="printWithStyles()" style="float:right; background-color: transparent; border: none; color: transparent;" class="svg-icon svg-icon-3x">
                        <i class="fa fa-print icon-2x"></i>
                </button>
            </h4>
            
            <div class="row">
                <div class="col-4">
                    <div id="morris-donut-chart"></div>
                </div>  
                <script>
                     Morris.Donut({
                        element: 'morris-donut-chart',
                        data: [ {
                            label: "Production",
                            value: {{$total_production}}
                        }, {
                            label: "Consumption",
                            value: {{$total_consumption}}
                        }],
                        resize: true,
                        colors:['#55ce63', '#fb9678']
                    });
                </script>          
                <div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Item name {{$item_name->name_np}} (???????????? {{$from_date}} to {{$to_date}})</h4></div>
                            <div class="card-body">
                                
                                @php
                                    $deficit_surplus = $total_production-$total_consumption;
                                    if($total_consumption == 0){
                                        $per_month_consumption = 0.1;
                                    }
                                    else{
                                        $per_month_consumption = round($total_consumption/12);
                                    }
                                    
                                    if($deficit_surplus > 0){                                        
                                        $upto_month = round($total_production/$per_month_consumption);
                                        $extra_month = round($deficit_surplus/$per_month_consumption);
                                        $notices = '<li class="text-success">Upto '.$upto_month.' months</li>'.'<li class="text-success">Surplus(extra months) '.$extra_month.' months</li>';                                       
                                    }
                                    else{         
                                        if($total_production == 0 ){
                                            $total_production = 0.1;
                                        }                           
                                        $upto_month = round($total_production/$per_month_consumption);
                                        $required_month_to_fulfill_production = round($deficit_surplus/$per_month_consumption);
                                        $notices = '<li class="text-danger">Production goes upto only'.$upto_month.' months</li>'.'<li class="text-danger"> Deficit '.$required_month_to_fulfill_production.' months</li>'.'<li class="text-danger">'.$deficit_surplus.' {{$unit_is}} need to Import to fulfill this year</li>';
                                    }
                                    
                                    echo $notices;
                                @endphp
                                
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Production</th>
                                                <th>Consumption</th>  
                                                <th>Surplus/Deficit</th>                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$total_production}} {{$unit_is}}</td>
                                                <td>{{$total_consumption}} {{$unit_is}}</td>
                                                <td>{{$total_production-$total_consumption}} {{$unit_is}}</td>                                                                                            
                                            </tr>                                     
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <a href="javascript:void(0)" class="btn btn-dark">Go somewhere</a> -->
                            </div>
                        </div>
                        <ul class="list-inline m-t-30 text-center mb-1 d-flex">
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #55ce63;"></i>Production</h5>
                                    <h4 class="m-b-0">{{$total_production}} {{$unit_is}}</h4>
                                </li>
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #fb9678;"></i>Consumption</h5>
                                    <h4 class="m-b-0">{{$total_consumption}} {{$unit_is}}</h4>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="text-muted"> <i class="fa fa-circle" style="color: #4F5467;"></i>Deficit/surplus</h5>
                                    <h4 class="m-b-0">{{$total_production-$total_consumption}} {{$unit_is}}</h4>
                                </li>
                        </ul>
                </div>
                <div class="col-md-4">
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h4 class="m-b-0 text-white">Item name {{$item_name->name_np}} (?????????????????? ???????????? {{$previous_data['previous_year']}})</h4>
                        </div>
                        <div class="card-body">
    
                            @php
                                    $deficit_surplus = $previous_data['prouction']-$previous_data['consumption'];
                                    
                                    if($previous_data['consumption']>12){
                                      
                                        $per_month_consumption = round($previous_data['consumption']/12);                                        
                                    }  
                                    else{
                                        $per_month_consumption = 1;
                                    }                    
                                    if($previous_data['prouction'] == 0){
                                        $previous_data['prouction'] = 0.1;
                                    }
                                    
                                   
                                    if($deficit_surplus > 0){                                        
                                        $upto_month = round($previous_data['prouction']/$per_month_consumption);
                                        $extra_month = round($deficit_surplus/$per_month_consumption);
                                        $notices = '<li class="text-success">Upto '.$upto_month.' months</li>'.'<li class="text-success">Surplus(extra month) '.$extra_month.' months</li>';                                       
                                    }
                                    else{    
                                        if($deficit_surplus == 0){
                                            $deficit_surplus = 1;
                                        }   
                                                                       
                                        $upto_month = round($previous_data['prouction']/$per_month_consumption);
                                         
                                        $required_month_to_fulfill_production = round($deficit_surplus/$per_month_consumption);
                                      
                                        $notices = '<li class="text-danger">Production goes upto only '.$upto_month.' months</li>'.'<li class="text-danger"> Deficit '.$required_month_to_fulfill_production.' months</li>'.'<li class="text-danger">'.$deficit_surplus." ".$unit_is.' need to Import to fulfill this year</li>';
                                    }
                                    echo $notices;
                            @endphp

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Production</th>
                                        <th>Consumption</th>  
                                        <th>Surplus/Deficit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$previous_data['prouction']}} {{$unit_is}}</td>
                                        <td>{{$previous_data['consumption']}} {{$unit_is}}</td>
                                        <td>{{$previous_data['prouction'] - $previous_data['consumption']}} {{$unit_is}}</td>                                                                                            
                                    </tr>                                     
                                    
                                </tbody>
                            </table>
                        </div>
                            <!-- <a href="javascript:void(0)" class="btn btn-dark">Go somewhere</a> -->
                    </div>
                    <ul class="list-inline m-t-30 text-center mb-1 d-flex">
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #55ce63;"></i>Production</h5>
                                    <h4 class="m-b-0">{{$previous_data['prouction']}} {{$unit_is}}</h4>
                                </li>
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #fb9678;"></i>Consumption</h5>
                                    <h4 class="m-b-0">{{$previous_data['consumption']}} {{$unit_is}}</h4>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="text-muted"> <i class="fa fa-circle" style="color: #4F5467;"></i>Deficit/surplus</h5>
                                    <h4 class="m-b-0">{{$previous_data['prouction'] - $previous_data['consumption']}} {{$unit_is}}</h4>
                                </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabular Data</h4>
                <h6 class="card-subtitle">yearly Data of <code> {{$item_name->name_np}}</code></h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="md5md">Year</th>
                                <th class="md5md">Unit</th>
                                <th class="md5md">Opening</th>
                                <th class="md5md">Production</th>
                                <th class="md5md">Import</th>
                                <th class="md5md">Total Supply</th>
                                <th class="md5md">Consumption</th>
                                <th class="md5md">Export</th>
                                <th class="md5md">Total Demand</th>
                                <th class="md5md">Closing Stock</th>
                                <!-- <th class="md5md">Demand Fulfilment</th> -->
                                <!-- <th class="md5md">Remarks<th> -->
                            </tr>
                        </thead>
                        <tbody style="font-size: 15px; font-weight: bolder;" id="tabular_data">                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
    <h4 class="card-title">{{$from_date}}/{{$to_date}} Monthly data of {{$item_name->name_np}}</h4>
    <!-- <h6 class="card-subtitle">Add<code>.table-striped</code>for borders on all sides of the table and cells.</h6> -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Months</th>
                    <th>Production</th>
                    <th>Consumption</th>
                    <th>Surplus/Deficit Progress</th>
                    <!-- <th>Consumption</th> -->
                    
                </tr>
            </thead>
            <tbody>
               
                @foreach($monthly_data as $key=>$data)                 
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$data}} {{$unit_is}}</td>
                        <td>{{round($total_consumption/12)}} {{$unit_is}}</td>
                        @if($total_consumption > 0)
                            @php
                                
                                $surplus_deficit = $data-round($total_consumption/12);
                                
                                if($surplus_deficit>0){
                                    $success_danger = "success";
                                    $title = "Surplus ";
                                    $perc = $surplus_deficit/$data * 100;
                                }
                                else{
                                    $success_danger = "danger";
                                    $title = "Deficit ";
                                    $perc = ($surplus_deficit*-1)/round($total_consumption/12) * 100;
                                }
                                            
                                $title = $title.strval($surplus_deficit);                            
                                
                            @endphp
                            <td>
                                <div class="progress progress-xs margin-vertical-10 ">
                                    <div class="progress-bar bg-{{$success_danger}}" data-toggle="tooltip" data-placement="top" title="{{$title}}" style="width: {{$perc ?? 1}}% ;height:6px;"></div>
                                </div>
                            </td> 
                        @else
                            <td>
                                0
                            </td>
                        @endif                                                                
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <!-- Donute Chart close-->  
     <!-- Monthly Report Chart open-->
     <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Monthly Report</h4>
                    <div id="bar-chart" style="width:100%; height:400px;"></div>
                </div>
            </div>

                <!-- Chart JS -->
                <script src="/chart/node_modules/echarts/echarts-all.js"></script>
                <script src="/chart/node_modules/echarts/echarts-init.js"></script>
            <!-- Monthly Report Chart close-->

    <!-- Bar Chart open-->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Yearly comparision Chart</h4>
                <div id="morris-bar-chart"></div>
            </div>
        </div>

     <!-- Bar Chart close-->


    <!-- Line Bar chart -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Yearly comparision Production Consumption Export/Import line Chart</h4>
                <ul class="list-inline text-end">
                    <li>
                        <h5><i class="fa fa-circle m-r-5 text-danger"></i>Import</h5>
                    </li>
                    <li>
                        <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Export</h5>
                    </li>
                    <li>
                        <h5><i class="fa fa-circle m-r-5 text-info"></i>Consumption</h5>
                    </li>
                    <li>
                        <h5><i class="fa fa-circle m-r-5 text-success"></i>Production</h5>
                    </li>
                </ul>
                <div id="morris-area-chart"></div>
            </div>
        </div>

<script>
    $.ajax({
        url: line_chart ,
        type: "GET",
        data: {'item_id':ajax_production_item_fetch_id,'year':ajax_production_year},
        success: function(data) {
            for (var dat in data) {
                $("#tabular_data").append(`<tr>
                                <td>`+data[dat]['period']+`</td>
                                <td>{{$unit_is}}</td>
                                <td class="supply_total">`+data[dat]['opening']+`</td>
                                <td class="supply_total">`+data[dat]['Production']+`</td>
                                <td class="supply_total">`+data[dat]['import']+`</td>
                                <td class="supply_total">`+(data[dat]['opening']+data[dat]['Production']+data[dat]['import'])+`</td>
                                <td class="demand_total">`+data[dat]['Consumption']+`</td>
                                <td class="demand_total">`+data[dat]['export']+`</td>
                                <td class="demand_total">`+(data[dat]['Consumption']+data[dat]['export'])+`</td>
                                <td>`+((data[dat]['opening']+data[dat]['Production']+data[dat]['import'])-(data[dat]['Consumption']+data[dat]['export']))+`</td>
                         
                            </tr>`)
            }
        }
    });
    $(".select_item").on("change", function (e) {
            var itemID = $(this).val();
            alert(itemId);
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
        function printWithStyles() {
            window.print();
        }

</script>





