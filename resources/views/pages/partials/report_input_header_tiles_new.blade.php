<?php $fiscal_year = session('fiscal_year');?>
<ul class="dashboard-tabs nav nav-pills nav-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center departmentOfCustom" href="{{route('report_doc','export')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.department_of_custom') }}</span>
        </a>
    </li>
    <!-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center departmentOfcrsp" href="{{route('report_DOCSRPMarketMoniter')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.department_of_commerce_supply_and_consumer_right_protection') }}</span>
        </a>
    </li> -->
    <!-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center ocr" href="{{route('report_ocr')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.office_of_company_registrar') }}</span>
        </a>
    </li> -->
    <!-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center departmentOfIndus" href="{{route('report_doi')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="far fa-chart-bar icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.department_of_industry') }}</span>
        </a>
    </li> -->
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center noc"  href="{{route('report_noc')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="far fa-chart-bar icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.nepal_oil_corporation') }}</span>
        </a>
    </li>
    <!-- <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center foodManagement" href="{{route('report_foodManagement')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.food_management_and_trading_company') }}</span>
        </a>
    </li> -->
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center saltTrading" href="{{route('report_saltTrading')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">{{ __('lang.salt_trading_limited') }}</span>
        </a>
    </li>
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center local_level_production" href="{{route('local_level_production_admin_report')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Local Production</span>
        </a>
    </li>
   
    <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
        <a class="nav-link border py-2 d-flex flex-grow-1 rounded flex-column align-items-center forecast" href="{{route('ForecastIndex')}}">
			<span class="nav-icon py-3 w-auto">
				<span class="svg-icon svg-icon-3x">
					<i class="fas fa-poll-h icon-2x"></i>
				</span>
			</span>
            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">Data Analysis</span>
        </a>
    </li>





</ul>