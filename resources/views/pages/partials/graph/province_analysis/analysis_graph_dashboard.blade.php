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
            <h4 class="card-title">Provience chart of {{$item_name->name_np}}</h4>
            <div class="row">
                <div class="col-6">
                    <div id="morris-donut-chart"></div>
                </div>
            
                <div class="col-6">
                <div class="card-body">
                                <h4 class="card-title">Provience data Table of {{$item_name->name_np}}</h4>
                                <!-- <h6 class="card-subtitle">Add<code>.table-striped</code>for borders on all sides of the table and cells.</h6> -->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Provience Name</th>
                                                <th>produce</th>
                                                <th>consume</th>
                                                <th>Progress</th>
                                                <th>Consumption</th>
                                            
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($provience_data as $key=>$data)
                                            <tr>
                                         
                                                <td>{{$key}}</td>
                                                <td>{{$data['production']}} mt</td>
                                                <td>{{$data['consumption']}} mt</td>
                                                <td>
                                                    <div class="progress progress-xs margin-vertical-10 ">
                                                        <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="progress progress-xs margin-vertical-10 ">
                                                        <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                                                    </div>
                                                </td>
                                               
                                            </tr>
                                        @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Donute Chart close-->  
     <!-- Monthly Report Chart open-->
     <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Yearly comparision with provience of item {{$item_name->name_np}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>year</th>
                                    <th>Provience-1</th>
                                    <th>Provience-2</th>
                                    <th>Provience-3</th>
                                    <th>Provience-4</th>
                                    <th>Provience-5</th>
                                    <th>Provience-6</th>
                                    <th>Provience-7</th>
                                
                                    <!-- <th>Consumption</th> -->
                                    
                                </tr>
                            </thead>
                            <tbody>
                          
                            
                                @foreach($yearly_provience_data as $key=>$data)
                                  
                                    <tr>                                       
                                        <td>{{$key}}</td>
                                        @foreach($data as $keyp=>$datap)                                        
                                            <td>P:{{$datap['production']}},C:{{$datap['consumption']}}</td>
                                        @endforeach                                                                                                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <!-- Chart JS -->
                <script src="/chart/node_modules/echarts/echarts-all.js"></script>
                <script src="/chart/node_modules/echarts/echarts-init.js"></script>
                <script>
                    Morris.Donut({
                        element: 'morris-donut-chart',
                        data: [ {
                            label: "Provience 1",
                            value: "{{$provience_data['provience-1']['production']}}"
                        }, {
                            label: "Provience 2",
                            value: "{{$provience_data['provience-2']['production']}}"
                        },
                        {
                            label: "Provience 3",
                            value: "{{$provience_data['provience-3']['production']}}"
                        },
                        {
                            label: "Provience 4",
                            value: "{{$provience_data['provience-4']['production']}}"
                        },
                        {
                            label: "Provience 5",
                            value: "{{$provience_data['provience-5']['production']}}"
                        },
                        {
                            label: "Provience 6",
                            value: "{{$provience_data['provience-6']['production']}}"
                        },
                        {
                            label: "Provience 7",
                            value: "{{$provience_data['provience-7']['production']}}"
                        }],
                        resize: true,
                        colors:['#55ce63', '#2f3d4a','red','yellow','blue','orange','gray']
                    });
                </script>
            <!-- Monthly Report Chart close-->

      
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




