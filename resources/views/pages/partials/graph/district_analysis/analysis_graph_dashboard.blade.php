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
        
    <div class="card-body">
        <h4 class="card-title">Provience data Table of Wheat</h4>
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
                    <tr>
                        <td>Provience 1</td>
                        <td>500mt</td>
                        <td>400mt</td>
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
                    <tr>
                        <td>Provience 2 </td>
                        <td>500mt</td>
                        <td>400mt</td>
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
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-warning" style="width: 50%; height:6px;"></div>
                            </div>
                        </td>
                        
                        
                    </tr>
                    <tr>
                        <td>Provience 3 </td>
                        <td>500mt</td>
                        <td>400mt</td>
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
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-success" style="width: 100%; height:6px;"></div>
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Provience 4 </td>
                        <td>500mt</td>
                        <td>400mt</td>
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
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-primary" style="width: 70%; height:6px;"></div>
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Provience 5 </td>
                        <td>500mt</td>
                        <td>400mt</td>
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
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-info" style="width: 85%; height:6px;"></div>
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Provience 6</td>
                        <td>500mt</td>
                        <td>400mt</td>
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-success" style="width: 35% ;height:6px;"></div>
                            </div>
                        </td>
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                            </div>
                        </td>
                        <td>
                            <div class="progress progress-xs margin-vertical-10 ">
                                <div class="progress-bar bg-inverse" style="width: 50%; height:6px;"></div>
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
        <!-- Donute Chart open-->

        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Donute Chart</h4>
            <div class="row">
                <div class="col-6">
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
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }
                            , {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }, {
                                label: "Consumption",
                                value: 2000
                            }
                        ],
                            resize: true,
                            colors:['#55ce63', '#2f3d4a']
                        });
                    </script>
           
            </div>
        </div>
    </div>

    <!-- Donute Chart close-->  
    








