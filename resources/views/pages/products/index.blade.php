@extends('layout.default')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Products
                <!-- <span class="d-block text-muted pt-2 font-size-sm">List Of Grades</span> -->
            </h3>
        </div>
        <div class="card-toolbar">
            <a data-fancybox data-type="ajax" data-src="{{route('products.create')}}" class="btn btn-primary btn-sm" href="javascript:;">
                <i class="fa fa-plus icon-sm"></i>New Product</a>&nbsp;
        </div>
    </div>
    <div class="card-body">
        <table class="datatable datatable-bordered" id="kt_datatable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Item Category</th>
                    <th>Product</th>
                    <th>Qty Available</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key=>$list)
                <tr>
                    <td>{{$list->title}}</td>
                    <td>{{$list->itemCategory->name}}</td>
                    <td>{{$list->product->name}}</td>
                    <td>{{$list->qty_available}} {{$list->measurementUnit->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    var datatable = $('#kt_datatable').KTDatatable({
        sortable: false,
        data: {
            pageSize: 20,
            sortable: false
        },
        columns: [{
                field: "SN",
                width: 50,

            },
            {
                field: "Title",
                width: 200,

            },
            {
                field: "Item Category",
                width: 200,

            },
            {
                field: "Product",
                width: 200,

            },
            {
                field: "Qty Available",
                width: 200,

            }
        ]
    });
</script>
@endsection