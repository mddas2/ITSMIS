@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Department Of Industry - IEE Related
                </h3>
            </div>
        </div>
        <div class="card-body">
            <form class="form" id="kt_form" action="{{route('iee_related')}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Date of Approval</th>
                        <th>Name Of Industry</th>
                        <th>No of IEE Related Approved</th>

                    </tr>
                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0;?>
                    @foreach($formatData as $row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <input type="hidden" name="data[{{$key}}][id]" value=" ">
                                <input type="text" name="data[{{$key}}][date_of_approval]"   data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row['date_of_approval']}}" >
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][name_of_industry]" class="form-control" autocomplete="off" value="{{$row['name_of_industry']}}" >
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][no_of_iee_aproval]" class="form-control" autocomplete="off" value="{{$row['no_of_iee_aproval']}}" >
                            </td>


                        </tr>
                        @php $key++; @endphp
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-primary btn-sm add" type="submit">
                                <i class="icon-sm"></i>Save Changes
                            </button>
                        </td>
                        <td colspan="6"></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        $('.nepdatepicker').nepaliDatePicker();
    </script>
@endsection
