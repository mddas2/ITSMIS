@extends('layout.default')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Hierarchy Level
                <!-- <span class="d-block text-muted pt-2 font-size-sm">List Of Grades</span> -->
            </h3>
        </div>
    </div>
    <div class="card-body">
        <table class="datatable datatable-bordered" id="kt_datatable">
            <thead>
                <tr>
                    <th>Name</th>

                    <th>नाम</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key=>$list)
                <tr>
                    <td>{{$list->name}}</td>
                    <td>{{$list->name_ne}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('#hierarchyTab').trigger("click");
</script>
<script type="text/javascript">
    var datatable = $('#kt_datatable').KTDatatable({
        sortable: false,
        data: {
            pageSize: 20,
            sortable: false
        },
        columns: [{
            field: "Hierarchy",
            width: 200,

        }]
    });
</script>
@endsection