
<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$ForecastIndex ?? ''}}" href="{{route('ForecastIndex')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">All</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$central_analysis ?? ''}}" href="{{route('central_analysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Central Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$ProvinceAnalysis ?? ''}}" href="{{route('ProvinceAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">province Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$DistrictAnalysis ?? ''}}" href="{{route('DistrictAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">District Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$ProductionAnalysis ?? ''}}" href="{{route('ProductionAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="far fa-chart-bar icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Production Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$ConsumptionAnalysis ?? ''}}"  href="{{route('ConsumptionAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="far fa-chart-bar icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Consumption Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$ImportAnalysis ?? ''}}" href="{{route('ImportAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Import Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$ExportAnalysis ?? ''}}" href="{{route('ExportAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Export Analysis</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center {{$FutureAnalysis ?? ''}}" href="{{route('FutureAnalysis')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Future Prediction</span>
        </a>
    </li>
</ul>