@props(['moduleLevel' => $moduleLevel,'hierarchyTitle' => $hierarchyTitle])
@php $fiscal_year = session('fiscal_year'); @endphp
<div  class="header flex-column header-fixed">
    <div class="header-top" style="background-color: #1e5fba !important;">
        <div class="container">
            <div class="d-none d-lg-flex align-items-center mr-3">
                <a href="#" class="mr-6">
                    <img alt="Logo" src="{{asset('media/logos/itsmis-logo.png')}}" class="max-h-60px"/>
                </a>
                <div class="title">
                    <span style="color: #e5eaee;font-size: 14px;">{{ __('lang.government_of_nepal') }}</span><br>
                    <span style="color: #f6f3f3;font-size: 16px;">{{ __('lang.ministry_of_industry_commerce_and_supplies') }}</span>
                </div>

            </div>
            <div class="topbar topbar-top">
            <!--  <div class="title" style="margin-top: 10px;margin-right: 6px;">
                    <span style="color: #e5eaee;font-size: 12px;">{{$hierarchyTitle[0]}}</span><br>
                    <span style="color: #f6f3f3;font-size: 14px;">{{$hierarchyTitle[1]}}</span>
                </div> -->
                <div class="dropdown mr-3">
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,10px" data-container="body">
                        <div class="btn btn-icon btn-secondary btn-dropdown">
                            <span class="svg-icon svg-icon-lg">
                                <?php
                                $locale = app()->getLocale();
                                if ($locale == "np") {
                                    echo 'NP';
                                } else {
                                    echo 'EN';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                        <div class="row row-paddingless">
                            <div class="col-6">
                                <a href="{{route('change-lang','np')}}"
                                   class="d-block py-2 px-2 text-center bg-hover-light border-right border-bottom">
                                    <span class="svg-icon svg-icon-3x svg-icon-success">
                                        <img src="{{asset('media/svg/flags/nepal.svg')}}" style="width:12%;">
                                    </span>
                                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">{{ __('lang.nepali') }}</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('change-lang','en')}}"
                                   class="d-block py-2 px-2 text-center bg-hover-light border-bottom">
                                    <span class="svg-icon svg-icon-3x svg-icon-success">
                                        <img src="{{asset('media/svg/flags/flag.svg')}}" style="width:12%;">
                                    </span>
                                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">{{ __('lang.english') }}</span>
                                </a>
                            </div>

                        </div>
                        <!--end:Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--begin::Notifications-->
                {{--<div class="topbar-item mr-3">
                    <div class="btn btn-icon btn-secondary pulse pulse-white" id="kt_quick_notifications_toggle">
                        <span class="svg-icon svg-icon-lg">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                          fill="#000000" opacity="0.3"/>
                                    <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                          fill="#000000"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="pulse-ring"></span>
                    </div>
                </div>--}}
                <!--end::Notifications-->
                <!--begin::User-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-secondary" id="kt_quick_user_toggle">
                        <span class="svg-icon svg-icon-lg">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                          fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                          fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
                <!--end::User-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Top-->
    <!--begin::Bottom-->
    <div class="header-bottom" id="kt_header_bottom">
        <!--begin::Container-->

        <div class="container-fluid ">

            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

                <!--begin::Header Menu-->
                <div id="kt_header_menu"
                     class="header-menu header-menu-left header-menu-mobile  header-menu-layout-default ">

                    <!--begin::Header Nav-->
                    <ul class="menu-nav ">
                        <li class="menu-item  menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here"
                            data-menu-toggle="hover" aria-haspopup="true">
                            <a href="" class="menu-link menu-toggle">
                                <span class="menu-text">{{ __('lang.home') }}</span>
                                <span class="menu-desc">Dashboard & Reports</span><i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                        aria-haspopup="true">
                                        <a href="{{/*route('get_commodities_supply_report')*/ route('admin_report')}}" class="menu-link">
                                            <span class="far fa-map menu-icon"></span>
                                            <span class="menu-text">Reports</span>
                                        </a>
                                    </li>
                                    {{--<li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                        aria-haspopup="true">
                                        <a href="{{route('dashboardChart')}}" class="menu-link">
                                            <span class="fas fa-chart-line menu-icon"></span>
                                            <span class="menu-text">Commodities Supply & Demand Charts</span>

                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                        aria-haspopup="true">
                                        <a href="{{route('dashboardCalendar')}}" class="menu-link">
                                            <span class="fa fa-calendar-check menu-icon"></span>
                                            <span class="menu-text">TODO - Calendar</span>

                                        </a>
                                    </li>--}}
                                </ul>
                            </div>
                        </li>
                        @if (auth()->user()->role_id == 1)
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover"
                                aria-haspopup="true">
                                <a href="" class="menu-link menu-toggle">
                                    <span class="menu-text">User Hierarchy</span>
                                    <span class="menu-desc">User Management & Privilege</span><i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('hierarchies.tree_view')}}" class="menu-link">
                                                <span class="fas fa-boxes menu-icon"></span>
                                                <span class="menu-text">Hierarchy Levels</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('hierarchies.access_level')}}" class="menu-link">
                                                <span class="fas fa-boxes menu-icon"></span>
                                                <span class="menu-text">Access Levels</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth()->user()->role_id == 2)
                            @if (!empty(auth()->user()->office_id))
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover"
                                    aria-haspopup="true">
                                    <a href="{{route('user-list-office')}}" class="menu-link ">
                                        <span class="menu-text">User Management</span>
                                        <span class="menu-desc">User Management & Privilege</span><i
                                                class="menu-arrow"></i>
                                    </a>
                                </li>
                            @else
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover"
                                    aria-haspopup="true">
                                    <a href="{{route('user-list-hierarchy')}}" class="menu-link ">
                                        <span class="menu-text">User Management</span>
                                        <span class="menu-desc">User Management & Privilege</span><i
                                                class="menu-arrow"></i>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if (in_array(auth()->user()->role_id,[3]))
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover"
                                aria-haspopup="true">
                                <a href="" class="menu-link menu-toggle">
                                    <span class="menu-text">Entry Master</span>
                                    <span class="menu-desc">Data Entry Management</span><i class="menu-arrow"></i>
                                </a>
                                <?php

                                if (auth()->user()->role_id == 1) {
                                    $showAll = true;
                                } else {
                                    $showAll = false;
                                }
                                ?>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                    <!--  <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('commodities_supply.index',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Commodity Supply Data</span>
                                        </a>
                                    </li>
                                    <?php }?>
                                    <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('monthly-progress-report-industries',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Inputs By DOI</span>
                                        </a>
                                    </li>
                                    <?php }?> -->
                                        <?php if ($showAll || in_array(1, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('department-of-custom','export')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.department_of_custom') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(2, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('dcsc_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.department_of_commerce_supply_and_consumer_right_protection') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(3, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('department_of_industries')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.department_of_industry') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(4, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('noc_add')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.nepal_oil_corporation') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(5, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('food_trading_add','purchase')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.food_management_and_trading_company') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(6, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('salt_trading_add','purchase')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.salt_trading_limited') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(7, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('local_level_add')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.local_level') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(8, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('dao_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.district_administration_office') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(9, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('hasio_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.province_level_home_and_small_industrial_office') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(10, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('icacp_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.province_level_directorate_of_industry_commerce_and_consumer_protection') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(11, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('hipc_addTraining')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.home_industry_promotion_center') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(12, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('industrial_private_sector_add')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.industry_and_private_sector') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>
                                        <?php if ($showAll || in_array(13, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('office_registration_company')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.office_of_company_registrar') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>

                                    <!-- <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('monthly_progress_report_ocr',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Inputs By OCR</span>
                                        </a>
                                    </li>
                                     <?php }?>
                                    <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('monthly_training_report',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Inputs By Micro cottage and small industry promotion center</span>
                                        </a>
                                    </li>
                                    <?php }?> -->
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (in_array(auth()->user()->role_id,[2]))
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover"
                                aria-haspopup="true">
                                <a href="" class="menu-link menu-toggle">
                                    <span class="menu-text">Reports</span>
                                    <span class="menu-desc">View Reports & Analysis</span><i class="menu-arrow"></i>
                                </a>
                                <?php
                                if (auth()->user()->role_id == 1) {
                                    $showAll = true;
                                } else {
                                    $showAll = false;
                                }
                                ?>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                    <!--  <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('commodities_supply.index',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Commodity Supply Data</span>
                                        </a>
                                    </li>
                                    <?php }?>
                                    <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('monthly-progress-report-industries',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Inputs By DOI</span>
                                        </a>
                                    </li>
                                    <?php }?> -->
                                        <?php if ($showAll || in_array(1, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('department-of-custom','export')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.department_of_custom') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(2, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('dcsc_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.department_of_commerce_supply_and_consumer_right_protection') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(3, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('department_of_industries')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.department_of_industry') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(4, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('noc_add')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.nepal_oil_corporation') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(5, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('food_trading_add','purchase')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.food_management_and_trading_company') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(6, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('salt_trading_add','purchase')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.salt_trading_limited') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(7, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('local_level_add')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.local_level') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(8, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('dao_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.district_administration_office') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(9, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('hasio_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.province_level_home_and_small_industrial_office') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(10, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('icacp_market_monitoring')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.province_level_directorate_of_industry_commerce_and_consumer_protection') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(11, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('hipc_addTraining')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.home_industry_promotion_center') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(12, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('industrial_private_sector_add')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.industry_and_private_sector') }}</span>
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php if ($showAll || in_array(13, $moduleLevel)) {?>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('office_registration_company')}}" class="menu-link">
                                                <span class="fas fa-file-contract menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.office_of_company_registrar') }}</span>
                                            </a>
                                        </li>
                                    <?php }?>

                                    <!-- <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('monthly_progress_report_ocr',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Inputs By OCR</span>
                                        </a>
                                    </li>
                                     <?php }?>
                                    <?php if ($showAll) {?>
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                                                <a href="{{route('monthly_training_report',['fiscal_year_id' =>$fiscal_year->id ])}}" class="menu-link">
                                            <span class="fas fa-file-contract menu-icon"></span>
                                            <span class="menu-text">Inputs By Micro cottage and small industry promotion center</span>
                                        </a>
                                    </li>
                                    <?php }?> -->
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if(in_array(auth()->user()->role_id,[1]))
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover"
                                aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">General Settings</span>
                                    <span class="menu-desc">General Data Entry</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('fiscal_years.index')}}" class="menu-link">
                                                <span class="fas fa-calendar-alt menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.fiscal_year') }}</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('item_categories.index')}}" class="menu-link">
                                                <span class="fa fa-cog menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.item_category') }}</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('items.index')}}" class="menu-link">
                                                <span class="fa fa-cog menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.items') }}</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('training_types.index')}}" class="menu-link">
                                                <span class="fas fa-podcast menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.training_types') }}</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="{{route('social_functions.index')}}" class="menu-link">
                                                <span class="fas fa-user-cog menu-icon"></span>
                                                <span class="menu-text">{{ __('lang.social_function_types') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>

                    <!--end::Header Nav-->
                </div>

                <!--end::Header Menu-->
            </div>

            <!--end::Header Menu Wrapper-->
        </div>
    </div>
</div>