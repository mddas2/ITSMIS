@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    Department Of Industry - IP Registration
                </h3>
            </div>
        </div>
        <div class="card-body">
            <form class="form" id="kt_form" action="{{route('ip_registration')}}" method="post">
                {{csrf_field()}}
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Date of Registration</th>
                        <th>Name Of Industry/Person</th>
                        <th>Type of IP</th>

                    </tr>
                    </thead>
                    <tbody id="tb_id">
                    <?php $key = 0;?>
                    @foreach($formatData as $row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <input type="hidden" name="data[{{$key}}][id]" value=" ">
                                <input type="text" name="data[{{$key}}][date_of_registration]"   data-single="true" class="form-control nepdatepicker" autocomplete="off" id="nep{{$key}}" value="{{$row['date_of_registration']}}" >
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][name_of_industry_person]" class="form-control" autocomplete="off" value="{{$row['name_of_industry_person']}}" >
                            </td>
                            <td>
                                <input type="text" name="data[{{$key}}][type_of_ip]" class="form-control" autocomplete="off" value="{{$row['type_of_ip']}}" >
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
