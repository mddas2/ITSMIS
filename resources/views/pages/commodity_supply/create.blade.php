<div class="card card-custom" style="min-width: 70% !important;">
	<div class="card-header">
		<h3 class="card-title">{{ __('lang.add_new_data')}}</h3>
	</div>
	<form class="form" id="kt_form" action="{{route('commodities_supply.store')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<div class="card-body">
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('lang.date')}}:</label>
					<input type="text" name="entry_date" required class="form-control form-control-solid datepicker" style="width: 100%;">
				</div>
				<div class="col-lg-6">
					<label>{{__('lang.fiscal_year')}}:</label>
					{{Form::select('fiscal_year_id',$fiscalYear,$fiscalYearId,['class' => 'form-control form-control-solid','required'=>true])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('Product')}}:</label>
					{{Form::select('item_id',$items,"",['class' => 'form-control form-control-solid','required'=>true])}}
				</div>
				<div class="col-lg-6">
					<label>{{__('Unit')}}:</label>
					{{Form::select('unit_id',$units,"",['class' => 'form-control form-control-solid','required'=>true])}}
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('Opening')}}:</label>
					<input type="text" name="opening" class="form-control form-control-solid">
				</div>
				<div class="col-lg-6">
					<label>{{ __('Productive')}}:</label>
					<input type="text" name="productive" class="form-control form-control-solid">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('Import')}}:</label>
					<input type="text" name="import" class="form-control form-control-solid">
				</div>
				<div class="col-lg-6">
					<label>{{ __('Export')}}:</label>
					<input type="text" name="export" class="form-control form-control-solid">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-6">
					<label>{{ __('Consumption')}}:</label>
					<input type="text" name="consumption" class="form-control form-control-solid">
				</div>
				<div class="col-lg-6">
					<label>{{ __('Remarks')}}:</label>
					<textarea name="remarks" class="form-control form-control-solid"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
		            <button type="submit" class="btn btn-primary mr-2">Save</button>
	             	<button type="reset" class="btn btn-secondary mr-2">Reset</button>
		        </div>
	        </div>
	    </div>
 	</form>
</div>
<script type="text/javascript">
	 $('.datepicker').nepaliDatePicker(/*{
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 10
        }*/);
</script>
