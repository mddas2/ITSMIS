@extends('layout.default')
@section('content')
<div class="card card-custom gutter-b">
 	<div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Bulk Import Of Monthly Progress Report Industry Data</h3>
        </div>
        <div class="card-toolbar">

		</div>
    </div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">{{ __('1. Download Sample Excel File')}}:</label>
					<div class="col-lg-3">
						<a href="{{route('monthly_progress_report_industry_export')}}" class="btn btn-primary btn-lg"><i class="fa-fa-excel"></i>Download</a>
					</div>
				</div>
				<form class="form" id="kt_form" action="{{route('monthly_progress_report_industry_import')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">{{ __('2. Import Data')}}:</label>
						<div class="col-lg-12">
							<div class="form-group row">
								<div class="col-lg-3">
									<label>Fiscal Year</label>
									{{Form::select('fiscal_year_id',$fiscalYear,null,['class' => 'form-control'])}}
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-3">
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
@endsection
