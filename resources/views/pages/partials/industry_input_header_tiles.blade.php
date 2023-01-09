<?php $fiscal_year = session('fiscal_year');?>
<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
	<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
		<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center monthlyTraining" href="{{route('monthly_training_report',['fiscal_year_id' =>$fiscal_year->id])}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="far fa-clone icon-2x"></i>
				</span>
			</span>
			<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Monthly Training Report</span>
		</a>
	</li>
	<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
		<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center areawiseTraining" href="{{route('areawise_training_report',['fiscal_year_id' =>$fiscal_year->id])}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-chart-area icon-2x"></i>
				</span>
			</span>
			<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Area Wise Training Report</span>
		</a>
	</li>
	<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
		<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center demographic" href="{{route('demographic_wise_training_report',['fiscal_year_id' =>$fiscal_year->id])}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-map-marked-alt icon-2x"></i>
				</span>
			</span>
			<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Demographic Wise Training Report</span>
		</a>
	</li>
	<li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
		<a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center trainingAttendees" href="{{route('training_attendees_report',['fiscal_year_id' =>$fiscal_year->id])}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-user-check icon-2x"></i>
				</span>
			</span>
			<span class="nav-text font-size-lg py-2 font-weight-bold text-center">Training Attendees Report</span>
		</a>
	</li>
</ul>