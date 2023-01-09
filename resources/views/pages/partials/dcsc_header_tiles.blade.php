<div class="card-body">
    <ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
        <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
            <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center marketMonitoring" href="{{route('dcsc_market_monitoring')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fab fa-connectdevelop icon-2x"></i>
					</span>
				</span>
                <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Market Monitoring</span>
            </a>
        </li>

        <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
            <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center firmRegistration" href="{{route('dcsc_firm_registration')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-poll-h icon-2x"></i>
					</span>
				</span>
                <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Firm Registration</span>
            </a>
        </li>
        <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
            <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center importExportPage" href="{{route('dcsc_import_export_registration')}}">
				<span class="nav-icon py-3 w-auto">
					<span class="svg-icon svg-icon-3x">
						<i class="fas fa-poll-h icon-2x"></i>
					</span>
				</span>
                <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Permission for import and export</span>
            </a>
        </li>
    </ul>
</div>