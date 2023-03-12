@extends('layout.forecast')

@section('styles')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-custom gutter-b block_print">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label block_print">Reports</h3>
            </div>
        </div>
        <div class="card-body block_print">
            @include('pages.partials.graph.report_front_tiles')
        </div>
    </div>
    @if($page_type == "forecast_all")
        @include('pages.partials.graph.analysis_graph_dashboard')
    @elseif($page_type == "central_analysis")
        @include('pages.partials.graph.central_analysis.analysis_graph_dashboard')
    @elseif($page_type == "province_analysis")
        @include('pages.partials.graph.province_analysis.analysis_graph_dashboard')
    @elseif($page_type == "district_analysis")
        @include('pages.partials.graph.district_analysis.analysis_graph_dashboard')
    @elseif($page_type == "production_analysis")
        @include('pages.partials.graph.production_analysis.analysis_graph_dashboard')
    @elseif($page_type == "consumption_analysis")
        @include('pages.partials.graph.consumption_analysis.analysis_graph_dashboard')
    @elseif($page_type == "export_analysis")
        @include('pages.partials.graph.export_analysis.analysis_graph_dashboard')
    @elseif($page_type == "import_analysis")
        @include('pages.partials.graph.import_analysis.analysis_graph_dashboard')
    @elseif($page_type == "future_analysis")
        @include('pages.partials.graph.future_analysis.analysis_graph_dashboard')
    @endif


@endsection
@section('scripts')
    <script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            paging: true,

            "processing": true,

            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                }
            ]
        });


    </script>
@endsection
