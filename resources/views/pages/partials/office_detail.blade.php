@php $lang = Config::get('app.locale') ;   @endphp
@if(isset($user->office->name))
	<div class="card card-custom">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-label">
					@if($lang == 'np') {{$user->office->name_ne}} @else {{$user->office->name}} @endif
					 - {{$user->office->code}}</h3>
			</div>
			<div class="card-toolbar">
				@if (auth()->user()->role_id == 2)
					<a class="btn btn-success btn-sm" href="javascript:;" data-fancybox data-type="ajax" data-src="{{route('offices.edit',$user->office->id)}}" ><i class="fa fa-pen icon-sm"></i>Edit Data</a>
				@endif
			</div>
		</div>
		<div class="card-body">
			<div class="form-group row">
				<label class="col-lg-2">Level:</label>
				<div class="col-lg-10">
					<span>@if($lang == 'np') {{$user->office->hierarchy->name_ne}} @else {{$user->office->hierarchy->name}} @endif </span>
				</div>
			</div>
			@if ($user->office->province_id != null)
				<div class="form-group row">
					<label class="col-lg-2">{{ __('lang.province') }}:</label>
					<div class="col-lg-10">
						<span>@if($lang == 'np') {{$user->office->province->name_ne}} @else {{$user->office->province->name}} @endif</span>
					</div>
				</div>
			@endif
			@if ($user->office->district_id != null)
				<div class="form-group row">
					<label class="col-lg-2">{{ __('lang.district') }}:</label>
					<div class="col-lg-10">
						<span>@if($lang == 'np') {{$user->office->district->nepali_name}} @else {{$user->office->district->name}} @endif</span>
					</div>
				</div>
			@endif
			<div class="form-group row">
				<label class="col-lg-2">{{ __('lang.address') }}:</label>
				<div class="col-lg-10">
					<span>{{$user->office->address}}</span>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-2">{{ __('lang.phone_number') }}:</label>
				<div class="col-lg-10">
					<span>{{$user->office->phone_number}}</span>
				</div>
			</div>
		</div>
	</div>
@endif

