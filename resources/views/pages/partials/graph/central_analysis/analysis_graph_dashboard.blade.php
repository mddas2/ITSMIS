<div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>From Date:</label>
                        <input name="from_date" class="form-control form-control-solid nepdatepicker" data-single="true"
                               required
                               value="{{$from_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>To Date:</label>
                        <input name="to_date" class="form-control form-control-solid nepdatepicker" data-single="true"
                               required
                               value="{{$to_date}}">
                    </div>
                    <div class="col-lg-3">
                        <label>Items:</label>
                        <?php
                        $itemList = ["" => "Select Items"];
                        $itemList = $itemList + $items;
                        ?>
                        {{Form::select('item_id',$itemList,$item_id,['class' => 'form-control'])}}
                    </div>
                    <div class="col-lg-2" style="margin-top: 24px;">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
            </form>
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

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

        <link href="/chart/node_modules/morrisjs/morris.css" rel="stylesheet">

        <script src="/chart/node_modules/raphael/raphael-min.js"></script>
        <script src="/chart/node_modules/morrisjs/morris.js"></script>
        <script src="/chart/dist/js/pages/morris-data.js"></script>
        
    <!-- Donute Chart open-->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Donute Chart</h4>
            <div class="row">
                <div class="col-4">
                    <div id="morris-donut-chart"></div>
                </div>  
                <script>
                     Morris.Donut({
                        element: 'morris-donut-chart',
                        data: [ {
                            label: "Production",
                            value: 3000
                        }, {
                            label: "Consumption",
                            value: 2000
                        }],
                        resize: true,
                        colors:['#55ce63', '#2f3d4a']
                    });
                </script>          
                <div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Current year 2079</h4></div>
                            <div class="card-body">
                                <li class="text-danger">Stock level upto next 5 months</li>
                                <li class="text-success">10mt is required to fulfill this year</li>
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
                                                <td>230 mt</td>
                                                <td>500 mt</td>
                                                <td>400 mt</td>                                                                                            
                                            </tr>                                     
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <a href="javascript:void(0)" class="btn btn-dark">Go somewhere</a> -->
                            </div>
                        </div>
                        <ul class="list-inline m-t-30 text-center mb-1 d-flex">
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #fb9678;"></i>Production</h5>
                                    <h4 class="m-b-0">8500</h4>
                                </li>
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #01c0c8;"></i>Consumption</h5>
                                    <h4 class="m-b-0">3630</h4>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="text-muted"> <i class="fa fa-circle" style="color: #4F5467;"></i>Deficit/surplus</h5>
                                    <h4 class="m-b-0">4870</h4>
                                </li>
                        </ul>
                </div>
                <div class="col-md-4">
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h4 class="m-b-0 text-white">Previous year 2078</h4>
                        </div>
                        <div class="card-body">
                        <li class="text-danger">Stock level upto next 5 months</li>
                        <li class="text-success">10mt imported to fulfill this year</li>
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
                                        <td>230 mt</td>
                                        <td>500 mt</td>
                                        <td>400 mt</td>                                                                                            
                                    </tr>                                     
                                    
                                </tbody>
                            </table>
                        </div>
                            <!-- <a href="javascript:void(0)" class="btn btn-dark">Go somewhere</a> -->
                    </div>
                    <ul class="list-inline m-t-30 text-center mb-1 d-flex">
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #fb9678;"></i>Production</h5>
                                    <h4 class="m-b-0">8500</h4>
                                </li>
                                <li class="list-inline-item p-r-20">
                                    <h5 class="text-muted"><i class="fa fa-circle" style="color: #01c0c8;"></i>Consumption</h5>
                                    <h4 class="m-b-0">3630</h4>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="text-muted"> <i class="fa fa-circle" style="color: #4F5467;"></i>Deficit/surplus</h5>
                                    <h4 class="m-b-0">4870</h4>
                                </li>
                        </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="card-body">
    <h4 class="card-title">Provience data Table of Wheat</h4>
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
                <tr>
                    <td>Jun</td>
                    <td>500mt</td>
                    <td>400mt</td>                                                                                            
                </tr>
                <tr>
                    <td>Feb </td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>                                                
                </tr>
                <tr>
                    <td>Mar </td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Apr</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>                                                
                </tr>
                <tr>
                    <td>May</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Jun</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>July</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Aug</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Sept</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Oct</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Nov</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Dec</td>
                    <td>500mt</td>
                    <td>400mt</td>
                    <td>
                        <div class="progress progress-xs margin-vertical-10 ">
                            <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                        </div>
                    </td>
                </tr>
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

             <!-- Moving Line Chart open-->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Real Time Consumption</h4>
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-line-chart-moving" style="padding: 0px; position: relative;"><canvas class="flot-base" width="500" height="800" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 250px; height: 400px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 362px; left: 31px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 298px; left: 24px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 234px; left: 23px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 171px; left: 23px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 107px; left: 23px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 43px; left: 20px; text-align: right;">100</div></div></div><canvas class="flot-overlay" width="500" height="800" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 250px; height: 400px;"></canvas></div>
                </div>
            </div>
        </div>

            <!-- Flot Charts JavaScript -->
            <script src="/chart/node_modules/flot/excanvas.js"></script>
            <script src="/chart/node_modules/flot/jquery.flot.js"></script>
            <script src="/chart/node_modules/flot/jquery.flot.pie.js"></script>
            <script src="/chart/node_modules/flot/jquery.flot.time.js"></script>
            <script src="/chart/node_modules/flot/jquery.flot.stack.js"></script>
            <script src="/chart/node_modules/flot/jquery.flot.crosshair.js"></script>
            <script src="/chart/node_modules/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
            <script src="/chart/dist/js/pages/flot-data.js"></script>
            <link href="/chart/dist/css/pages/float-chart.css" rel="stylesheet">
    <!-- Moving Line Chart close-->

    <!-- Bar Chart open-->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bar Chart</h4>
                <div id="morris-bar-chart"></div>
            </div>
        </div>

     <!-- Bar Chart close-->


    <!-- Line Bar chart -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product line Chart</h4>
                <ul class="list-inline text-end">
                    <li>
                        <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Import/Export</h5>
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

    <!-- Line Bar chart close-->




