<div class="card card-custom" style="min-width: 70% !important;">
    <div class="card-header">
        <h3 class="card-label">Excel Import Of  Salt Trading Corporation - {{$type}}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>{{ __('1. Download Sample Excel File')}}:</label><br>

                        <a href="{{route('national-trading-excel-sample',$type)}}" class="btn btn-info btn-sm"><i class="fa-fa-excel"></i>Download</a>
                    </div>
                </div>
                <form class="form" id="kt_form" action="{{route('national-trading-excel-insert',$type)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{ __('2. Import Data')}}:</label>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Select File</label>
                                    <input type="file" name="sample_excel" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
