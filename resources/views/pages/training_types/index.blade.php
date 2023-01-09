@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">{{ __('Training Types')}}
            </h3>
        </div>
        <div class="card-toolbar">
			<a data-fancybox data-type="ajax" data-src="{{route('training_types.create')}}" class="btn btn-primary btn-sm" href="javascript:;"><i class="fa fa-plus icon-sm"></i>New Training Type</a>&nbsp;
		</div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Training Name</th>
                    <th>Training Name (In Nepali)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tb_id">
                @foreach($data as $key=>$training)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$training->name}}</td>
                    <td>{{$training->name_np}}</td>


                    <td>
                        <a href="#" class="btn btn-icon btn-success btn-xs mr-2 edit" data-fancybox data-type="ajax"
                           data-src="{{route('training_types.edit',$training->id)}}" data-toggle="tooltip"
                           title="Edit"><i class="fa fa-pen"></i></a>
                        <form action="{{ route('training_types.destroy', $training->id) }}" style="display: inline-block;"
                              method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <a href="" class="btn btn-icon btn-danger btn-xs mr-2 deleteBtn" data-toggle="tooltip"
                               title="Delete"><i class="fa fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script type="text/javascript">
	$('.kt_select2_11').select2({
        placeholder: "Add Sub Trainings",
        tags: true
    });
    var table = $('#kt_datatable');
    table.DataTable({
            responsive: true 
        });
</script>
@endsection