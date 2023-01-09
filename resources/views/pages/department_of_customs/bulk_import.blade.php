<div class="card card-custom" style="min-width: 70% !important;">
    <div class="card-header">
        <h3 class="card-label">Excel Import Of Department Of Customs - Export Site</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>{{ __('1. Download Sample Excel File')}}:</label><br>

                        <a href="{{route('dce-excel-sample',$type)}}" class="btn btn-info btn-sm"><i
                                    class="fa-fa-excel"></i>Download</a>
                    </div>
                </div>
                <form class="form" id="kt_form" action="{{route('dce-excel-insert',$type)}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{ __('2. Import Data')}}:</label>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label>Select Year</label>
                                    <select name="year">
                                        <option>2078</option>
                                        <option>2079</option>
                                        <option>2080</option>
                                        <option>2081</option>
                                        <option>2082</option>
                                        <option>2083</option>
                                        <option>2084</option>
                                        <option>2085</option>
                                        <option>2086</option>
                                        <option>2087</option>
                                        <option>2088</option>
                                        <option>2089</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Select Month</label>
                                    <select name="month">
                                        <option value="01">Baishakh</option>
                                        <option value="02">Jestha</option>
                                        <option value="03">Asar</option>
                                        <option value="04">Shrawan</option>
                                        <option value="05">Bhadau</option>
                                        <option value="06">Aswin</option>
                                        <option value="07">Kartik</option>
                                        <option value="08">Mansir</option>
                                        <option value="09">Poush</option>
                                        <option value="10">Magh</option>
                                        <option value="11">Falgun</option>
                                        <option value="12">Chaitra</option>
                                    </select>
                                </div>
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
