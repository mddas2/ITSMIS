@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-1 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">List Of Items
                </h3>
            </div>
            <div class="card-toolbar">
                <a data-fancybox data-type="ajax" data-src="{{route('item_categories.create')}}"
                   class="btn btn-primary btn-sm" href="javascript:;">
                    <i class="fa fa-plus icon-sm"></i>New Item</a>&nbsp;
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                <thead>
                <!-- <tr>
                    <th colspan="2">Order Information</th>
                    <th colspan="3">Shipping Information</th>
                    <th colspan="3">Agent Information</th>
                    <th colspan="3">Stats</th>
                </tr> -->
                <tr>
                    <th>SN</th>

                    <th>Category Name</th>
                    <th>Category Name (In Nepali)</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$item->name}}</td>
                        <td>{{$item->name_np}}</td>


                        <td>

                            <a href="#" class="btn btn-icon btn-success btn-xs mr-2 edit" data-fancybox data-type="ajax"
                               data-src="{{route('item_categories.edit',$item->id)}}" data-toggle="tooltip"
                               title="Edit"><i class="fa fa-pen"></i></a>
                            <form action="{{ route('item_categories.destroy', $item->id) }}" style="display: inline-block;"
                                  method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <a href="" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip"
                                   title="Delete"><i class="fa fa-trash"></i></a>
                            </form>
                            <?php
                            if ($item->status_id == 1) {
                                $class = "btn-secondary";
                                $toolTip = "Disable";
                                $iClass = "flaticon2-cancel-music";
                                $status = 0;
                            } else {
                                $class = "btn-primary";
                                $toolTip = "Enable";
                                $iClass = "flaticon2-check-mark";
                                $status = 1;
                            }
                            ?>
                            <a href="" class="btn btn-icon {{$class}} btn-xs mr-2 updateStatus" data-toggle="tooltip"
                               title="{{$toolTip}}"><i class="{{$iClass}}"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true
        });
    </script>
    <!-- <script src="{{asset('js/pages/crud/datatables/basic/headers.js')}}"></script> -->
@endsection