@extends('layout.default')
@section('styles')
<link href="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
	<div class="col-xl-12">	
		<div class="card card-custom card-stretch gutter-b">
			<div class="card-header h-auto border-0">
				<div class="card-title py-5">
					<h3 class="card-label">
						<span class="d-block text-dark font-weight-bolder">TODO</span>
						<span class="d-block text-muted mt-2 font-size-sm">More than 20+ tasks</span>
					</h3>
				</div>
			</div>
			<div class="card-body">
				<div id="kt_calendar"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('js/pages/features/calendar/background-events.js')}}"></script>
@endsection