@extends('layout.default')

@section('content')
<div class="row">
    <div class="col-xl-4">
        <!--begin::Stats Widget 1-->
        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-4.svg)">
            <!--begin::Body-->
            <div class="card-body">
                <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Meeting Schedule</a>
                <div class="font-weight-bold text-success mt-9 mb-5">3:30PM - 4:20PM</div>
                <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">Craft a headline that is informative
                    <br />and will capture readers
                </p>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 1-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 2-->
        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-2.svg)">
            <!--begin::Body-->
            <div class="card-body">
                <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Announcement</a>
                <div class="font-weight-bold text-success mt-9 mb-5">03 May 2020</div>
                <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">Great blog posts don’t just happen
                    <br />Even the best bloggers need it
                </p>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 2-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 3-->
        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-1.svg)">
            <!--begin::body-->
            <div class="card-body">
                <a href="#" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">New Release</a>
                <div class="font-weight-bold text-success mt-9 mb-5">ReactJS</div>
                <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">AirWays - A Front-end solution for
                    <br />airlines build with ReactJS
                </p>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 3-->
    </div>
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-4">
        <!--begin::Mixed Widget 10-->
        <div class="card card-custom card-border gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <div class="flex-grow-1 pb-5">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center pr-2 mb-6">
                        <span class="text-muted font-weight-bold font-size-lg flex-grow-1">7 Hours Ago</span>
                        <div class="symbol symbol-50">
                            <span class="symbol-label bg-light-light">
                                <img src="assets/media/svg/misc/006-plurk.svg" class="h-50 align-self-center" alt="" />
                            </span>
                        </div>
                    </div>
                    <!--end::Info-->
                    <!--begin::Link-->
                    <a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h4">PitStop - Multiple Email
                        <br />Generator</a>
                    <!--end::Link-->
                    <!--begin::Desc-->
                    <p class="text-dark-50 font-weight-normal font-size-lg mt-6">Pitstop creates quick email campaigns.
                        <br />We help to strengthen your brand
                        <br />for your every purpose.
                    </p>
                    <!--end::Desc-->
                </div>
                <!--begin::Team-->
                <div class="d-flex align-items-center">
                    <!--begin::Pic-->
                    <a href="#" class="symbol symbol-45 symbol-light mr-3">
                        <div class="symbol-label">
                            <img src="assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" alt="" />
                        </div>
                    </a>
                    <!--end::Pic-->
                    <!--begin::Pic-->
                    <a href="#" class="symbol symbol-45 symbol-light mr-3">
                        <div class="symbol-label">
                            <img src="assets/media/svg/avatars/028-girl-16.svg" class="h-75 align-self-end" alt="" />
                        </div>
                    </a>
                    <!--end::Pic-->
                    <!--begin::Pic-->
                    <a href="#" class="symbol symbol-45 symbol-light">
                        <div class="symbol-label">
                            <img src="assets/media/svg/avatars/024-boy-9.svg" class="h-75 align-self-end" alt="" />
                        </div>
                    </a>
                    <!--end::Pic-->
                </div>
                <!--end::Team-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 10-->
    </div>
    <div class="col-xl-4">
        <!--begin::Mixed Widget 8-->
        <div class="card card-custom card-border gutter-b card-stretch">
            <!--begin::Card body-->
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center py-1">
                    <!--begin::Pic-->
                    <div class="symbol symbol-80 symbol-light-success mr-5">
                        <span class="symbol-label">
                            <img src="assets/media/svg/misc/014-kickstarter.svg" class="h-50 align-self-center" alt="" />
                        </span>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                        <a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h5">Monthly Subscription
                            <br />Based SaaS</a>
                        <span class="text-muted font-weight-bold font-size-lg">Due: 27 Apr 2020</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-column w-100 mt-12">
                        <span class="text-dark mr-2 font-size-lg font-weight-bolder pb-3">Progress</span>
                        <div class="progress progress-xs w-100">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end::Stats-->
                    <!--begin::Team-->
                    <div class="d-flex flex-column mt-10">
                        <span class="text-dark mr-2 font-size-lg font-weight-bolder pb-4">Team</span>
                        <div class="d-flex">
                            <!--begin::Pic-->
                            <a href="#" class="symbol symbol-50 symbol-light-success mr-3">
                                <div class="symbol-label">
                                    <img src="assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" alt="" />
                                </div>
                            </a>
                            <!--end::Pic-->
                            <!--begin::Pic-->
                            <a href="#" class="symbol symbol-50 symbol-light-success mr-3">
                                <div class="symbol-label">
                                    <img src="assets/media/svg/avatars/028-girl-16.svg" class="h-75 align-self-end" alt="" />
                                </div>
                            </a>
                            <!--end::Pic-->
                            <!--begin::Pic-->
                            <a href="#" class="symbol symbol-50 symbol-light-success mr-3">
                                <div class="symbol-label">
                                    <img src="assets/media/svg/avatars/024-boy-9.svg" class="h-75 align-self-end" alt="" />
                                </div>
                            </a>
                            <!--end::Pic-->
                        </div>
                    </div>
                    <!--end::Team-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 8-->
    </div>
    <div class="col-xl-4">
        <!--begin::List Widget 4-->
        <div class="card card-custom card-border gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Todo</h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-light btn-sm font-size-sm font-weight-bolder dropdown-toggle text-dark-75" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create</a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header pb-1">
                                    <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-shopping-cart-1"></i>
                                        </span>
                                        <span class="navi-text">Order</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-calendar-8"></i>
                                        </span>
                                        <span class="navi-text">Event</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-graph-1"></i>
                                        </span>
                                        <span class="navi-text">Report</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Post</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-writing"></i>
                                        </span>
                                        <span class="navi-text">File</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Item-->
                <div class="d-flex align-items-center">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-success align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" name="select" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Create FireStone Logo</a>
                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end:Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-primary align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-primary checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Stakeholder Meeting</a>
                        <span class="text-muted font-weight-bold">Due in 3 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-warning align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-warning checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-size-sm font-weight-bold font-size-lg mb-1">Scoping &amp; Estimations</a>
                        <span class="text-muted font-weight-bold">Due in 5 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin: Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-info align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-info checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Sprint Showcase</a>
                        <span class="text-muted font-weight-bold">Due in 1 Day</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-drop"></i>
                                        </span>
                                        <span class="navi-text">New Group</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-list-3"></i>
                                        </span>
                                        <span class="navi-text">Contacts</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Groups</span>
                                        <span class="navi-link-badge">
                                            <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-bell-2"></i>
                                        </span>
                                        <span class="navi-text">Calls</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-gear"></i>
                                        </span>
                                        <span class="navi-text">Settings</span>
                                    </a>
                                </li>
                                <li class="navi-separator my-3"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-magnifier-tool"></i>
                                        </span>
                                        <span class="navi-text">Help</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-bell-2"></i>
                                        </span>
                                        <span class="navi-text">Privacy</span>
                                        <span class="navi-link-badge">
                                            <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
            </div>
            <!--end::Body-->
        </div>
        <!--end:List Widget 4-->
    </div>
</div>
<!--end::Row-->
<!--begin::Advance Table Widget 5-->
<div class="card card-custom card-border gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Agents Stats</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
        </h3>
        <div class="card-toolbar">
            <a href="#" class="btn btn-info font-weight-bolder font-size-sm">New Report</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th class="pl-0" style="width: 40px">
                            <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </th>
                        <th class="pl-0" style="min-width: 100px">order id</th>
                        <th style="min-width: 120px">country</th>
                        <th style="min-width: 150px">
                            <span class="text-primary">Data &amp; status</span>
                            <span class="svg-icon svg-icon-sm svg-icon-primary">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Down-2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3" x="11" y="4" width="2" height="10" rx="1" />
                                        <path d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </th>
                        <th style="min-width: 150px">company</th>
                        <th style="min-width: 130px">status</th>
                        <th class="pr-0 text-right" style="min-width: 160px">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl-0 py-6">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">56037-XDER</a>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Brasil</span>
                            <span class="text-muted font-weight-bold">Code: BR</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">05/28/2020</span>
                            <span class="text-muted font-weight-bold">Paid</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Intertico</span>
                            <span class="text-muted font-weight-bold">Web, UI/UX Design</span>
                        </td>
                        <td>
                            <span class="label label-lg label-light-primary label-inline">Approved</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl-0 py-6">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">05822-FXSP</a>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Belarus</span>
                            <span class="text-muted font-weight-bold">Code: BY</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">02/04/2020</span>
                            <span class="text-muted font-weight-bold">Rejected</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Agoda</span>
                            <span class="text-muted font-weight-bold">Houses &amp; Hotels</span>
                        </td>
                        <td>
                            <span class="label label-lg label-light-warning label-inline">In Progress</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl-0 py-6">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary ont-size-lg">00347-BCLQ</a>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Phillipines</span>
                            <span class="text-muted font-weight-bold">Code: PH</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">23/12/2020</span>
                            <span class="text-muted font-weight-bold">Paid</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">RoadGee</span>
                            <span class="text-muted font-weight-bold">Transportation</span>
                        </td>
                        <td>
                            <span class="label label-lg label-light-success label-inline">Success</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pl-0 py-6">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-lg">4472-QREX</a>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Argentina</span>
                            <span class="text-muted font-weight-bold">Code: AR</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">17/09/2021</span>
                            <span class="text-muted font-weight-bold">Pending</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">The Hill</span>
                            <span class="text-muted font-weight-bold">Insurance</span>
                        </td>
                        <td>
                            <span class="label label-lg label-light-danger label-inline">Rejected</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
<!--end::Advance Table Widget 5-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-6">
        <!--begin::List Widget 4-->
        <div class="card card-custom card-border card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Todo</h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-light btn-sm font-size-sm font-weight-bolder dropdown-toggle text-dark-75" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create</a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header pb-1">
                                    <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-shopping-cart-1"></i>
                                        </span>
                                        <span class="navi-text">Order</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-calendar-8"></i>
                                        </span>
                                        <span class="navi-text">Event</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-graph-1"></i>
                                        </span>
                                        <span class="navi-text">Report</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Post</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-writing"></i>
                                        </span>
                                        <span class="navi-text">File</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Item-->
                <div class="d-flex align-items-center">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-success align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-success checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" name="select" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Create FireStone Logo</a>
                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end:Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-primary align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-primary checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Stakeholder Meeting</a>
                        <span class="text-muted font-weight-bold">Due in 3 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-warning align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-warning checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-size-sm font-weight-bold font-size-lg mb-1">Scoping &amp; Estimations</a>
                        <span class="text-muted font-weight-bold">Due in 5 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin: Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-info align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-info checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Sprint Showcase</a>
                        <span class="text-muted font-weight-bold">Due in 1 Day</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-drop"></i>
                                        </span>
                                        <span class="navi-text">New Group</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-list-3"></i>
                                        </span>
                                        <span class="navi-text">Contacts</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Groups</span>
                                        <span class="navi-link-badge">
                                            <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-bell-2"></i>
                                        </span>
                                        <span class="navi-text">Calls</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-gear"></i>
                                        </span>
                                        <span class="navi-text">Settings</span>
                                    </a>
                                </li>
                                <li class="navi-separator my-3"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-magnifier-tool"></i>
                                        </span>
                                        <span class="navi-text">Help</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-bell-2"></i>
                                        </span>
                                        <span class="navi-text">Privacy</span>
                                        <span class="navi-link-badge">
                                            <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center mt-10">
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-danger align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-danger checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                    <!--end::Checkbox:-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">Project Retro</a>
                        <span class="text-muted font-weight-bold">Due in 12 Days</span>
                    </div>
                    <!--end::Text-->
                    <!--begin: Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
            </div>
            <!--end::Body-->
        </div>
        <!--end:List Widget 4-->
    </div>
    <div class="col-xl-6">
        <!--begin::List Widget 12-->
        <div class="card card-custom card-border card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Latest Media</h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-ver"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header pb-1">
                                    <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-shopping-cart-1"></i>
                                        </span>
                                        <span class="navi-text">Order</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-calendar-8"></i>
                                        </span>
                                        <span class="navi-text">Event</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-graph-1"></i>
                                        </span>
                                        <span class="navi-text">Report</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Post</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-writing"></i>
                                        </span>
                                        <span class="navi-text">File</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Item-->
                <div class="d-flex flex-wrap align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60 symbol-2by3 flex-shrink-0">
                        <div class="symbol-label" style="background-image: url('assets/media/stock-600x400/img-20.jpg')"></div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                        <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Cup &amp; Green</a>
                        <span class="text-muted font-weight-bold">Size: 87KB</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::btn-->
                    <span class="label label-lg label-light-primary label-inline mt-lg-0 mb-lg-0 my-2 font-weight-bold py-4">Approved</span>
                    <!--end::Btn-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex flex-wrap align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60 symbol-2by3 flex-shrink-0">
                        <div class="symbol-label" style="background-image: url('assets/media/stock-600x400/img-19.jpg')"></div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                        <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Yellow Background</a>
                        <span class="text-muted font-weight-bold">Size: 1.2MB</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::btn-->
                    <span class="label label-lg label-light-warning label-inline mt-lg-0 mb-lg-0 my-2 font-weight-bold py-4">In Progress</span>
                    <!--end::Btn-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex flex-wrap align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60 symbol-2by3 flex-shrink-0">
                        <div class="symbol-label" style="background-image: url('assets/media/stock-600x400/img-25.jpg')"></div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                        <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Nike &amp; Blue</a>
                        <span class="text-muted font-weight-bold">Size: 87KB</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::btn-->
                    <span class="label label-lg label-light-success label-inline mt-lg-0 mb-lg-0 my-2 font-weight-bold py-4">Success</span>
                    <!--end::btn-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex flex-wrap align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60 symbol-2by3 flex-shrink-0">
                        <div class="symbol-label" style="background-image: url('assets/media/stock-600x400/img-24.jpg')"></div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column ml-4 flex-grow-1 mr-2">
                        <a href="#" class="text-dark-75 font-weight-bold font-size-lg text-hover-primary mb-1">Red Boots</a>
                        <span class="text-muted font-weight-bold">Size: 345KB</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::btn-->
                    <span class="label label-lg label-light-danger label-inline mt-lg-0 mb-lg-0 my-2 font-weight-bold py-4">Rejected</span>
                    <!--end::btn-->
                </div>
                <!--end::Item-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 12-->
    </div>
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
    <div class="col-lg-6">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-border card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Notifications</h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-ver"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <!--begin::Naviigation-->
                            <ul class="navi">
                                <li class="navi-header font-weight-bold py-5">
                                    <span class="font-size-lg">Add New:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-shopping-cart-1"></i>
                                        </span>
                                        <span class="navi-text">Order</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="navi-icon flaticon2-calendar-8"></i>
                                        </span>
                                        <span class="navi-text">Members</span>
                                        <span class="navi-label">
                                            <span class="label label-light-danger label-rounded font-weight-bold">3</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="navi-icon flaticon2-telegram-logo"></i>
                                        </span>
                                        <span class="navi-text">Project</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="navi-icon flaticon2-new-email"></i>
                                        </span>
                                        <span class="navi-text">Record</span>
                                        <span class="navi-label">
                                            <span class="label label-light-success label-rounded font-weight-bold">5</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer pt-5 pb-4">
                                    <a class="btn btn-light-primary font-weight-bolder btn-sm" href="#">More options</a>
                                    <a class="btn btn-clean font-weight-bold btn-sm d-none" href="#" data-toggle="tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                </li>
                            </ul>
                            <!--end::Naviigation-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <!--begin::Item-->
                <div class="mb-6">
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Checkbox-->
                        <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                        <!--end::Checkbox-->
                        <!--begin::Section-->
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <!--begin::Info-->
                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                <!--begin::Title-->
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Daily Standup Meeting</a>
                                <!--end::Title-->
                                <!--begin::Data-->
                                <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                <!--end::Data-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Label-->
                            <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Approved</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Checkbox-->
                        <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                        <!--end::Checkbox-->
                        <!--begin::Section-->
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <!--begin::Info-->
                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                <!--begin::Title-->
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Group Town Hall Meet-up with showcase</a>
                                <!--end::Title-->
                                <!--begin::Data-->
                                <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                <!--end::Data-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Label-->
                            <span class="label label-lg label-light-warning label-inline font-weight-bold py-4">In Progress</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Checkbox-->
                        <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                        <!--end::Checkbox-->
                        <!--begin::Section-->
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <!--begin::Info-->
                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                <!--begin::Title-->
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Next sprint planning and estimations</a>
                                <!--end::Title-->
                                <!--begin::Data-->
                                <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                <!--end::Data-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Label-->
                            <span class="label label-lg label-light-success label-inline font-weight-bold py-4">Success</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-6">
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Checkbox-->
                        <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                        <!--end::Checkbox-->
                        <!--begin::Section-->
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <!--begin::Info-->
                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                <!--begin::Title-->
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Sprint delivery and project deployment</a>
                                <!--end::Title-->
                                <!--begin::Data-->
                                <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                <!--end::Data-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Label-->
                            <span class="label label-lg label-light-danger label-inline font-weight-bold py-4">Rejected</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end: Item-->
                <!--begin: Item-->
                <div class="">
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Checkbox-->
                        <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                        <!--end::Checkbox-->
                        <!--begin::Section-->
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <!--begin::Info-->
                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                <!--begin::Title-->
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Data analytics research showcase</a>
                                <!--end::Title-->
                                <!--begin::Data-->
                                <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                <!--end::Data-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Label-->
                            <span class="label label-lg label-light-warning label-inline font-weight-bold py-4">In Progress</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end: Item-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 10-->
    </div>
    <div class="col-lg-6">
        <!--begin::Base Table Widget 3-->
        <div class="card card-custom card-border card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Files</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                </h3>
                <div class="card-toolbar">
                    <a href="#" class="btn btn-light-primary btn-md py-2 font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create</a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover">
                            <li class="navi-header pb-1">
                                <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-shopping-cart-1"></i>
                                    </span>
                                    <span class="navi-text">Order</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-calendar-8"></i>
                                    </span>
                                    <span class="navi-text">Event</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-graph-1"></i>
                                    </span>
                                    <span class="navi-text">Report</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-rocket-1"></i>
                                    </span>
                                    <span class="navi-text">Post</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-writing"></i>
                                    </span>
                                    <span class="navi-text">File</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 pb-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-borderless table-vertical-center">
                        <thead>
                            <tr>
                                <th class="p-0" style="width: 50px"></th>
                                <th class="p-0" style="min-width: 150px"></th>
                                <th class="p-0" style="min-width: 140px"></th>
                                <th class="p-0" style="min-width: 100px"></th>
                                <th class="p-0" style="min-width: 40px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pl-0 py-5">
                                    <div class="symbol symbol-45 symbol-light-success mr-2">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-2x svg-icon-success">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Top Authors</a>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">ReactJs, HTML</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">4600 Users</span>
                                </td>
                                <td class="text-right pr-0">
                                    <span class="text-dark-75 font-weight-bolder font-size-lg">5.4MB</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-5">
                                    <div class="symbol symbol-45 symbol-light-danger mr-2">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Popular Authors</a>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">Python, MySQL</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">7200 Users</span>
                                </td>
                                <td class="text-right pr-0">
                                    <span class="text-dark-75 font-weight-bolder font-size-lg">2.8MB</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-5">
                                    <div class="symbol symbol-45 symbol-light-info mr-2">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-2x svg-icon-info">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">New Users</a>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">Laravel, Metronic</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">890 Users</span>
                                </td>
                                <td class="text-right pr-0">
                                    <span class="text-dark-75 font-weight-bolder font-size-lg">1.5MB</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-5">
                                    <div class="symbol symbol-45 symbol-light-warning mr-2">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-2x svg-icon-warning">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Active Customers</a>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">AngularJS, C#</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">6370 Users</span>
                                </td>
                                <td class="text-right pr-0">
                                    <span class="text-dark-75 font-weight-bolder font-size-lg">890KB</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-5">
                                    <div class="symbol symbol-45 symbol-light-primary mr-2">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                                        <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Bestseller Theme</a>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">ReactJS, Ruby</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-muted font-weight-bold">354 Users</span>
                                </td>
                                <td class="text-right pr-0">
                                    <span class="text-dark-75 font-weight-bolder font-size-lg">500KB</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end::table-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Base Table Widget 3-->
    </div>
</div>
@endsection