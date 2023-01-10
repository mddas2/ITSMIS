<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>ITSMIS | @yield('title', $page_title ?? '')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    {{ Metronic::getGoogleFontsInclude() }}
    @foreach(config('layout.resources.css') as $style)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/nepali-datepicker/nepali-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #ndp-nepali-box {
            z-index: 9999999 !important;
        }
        div#kt_datatable_length {
            float: left;
            margin-right: 15px;
        }
        .dt-buttons.btn-group.flex-wrap {
            float: left;
        }`
    </style>
    @yield('styles')
    @foreach(config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>

@php $lang = Config::get('app.locale') ;    @endphp
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
<div class="d-flex flex-column flex-root" id="kt_blockui_card">
    <div class="d-flex flex-row flex-column-fluid page">
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layout.base._header-mobile')
            @include('pages.frontPage.header')


            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="d-flex flex-column-fluid">
                    @include('layout.base._content')
                </div>
            </div>
            <x-footer />
        </div>
    </div>
</div>
@include('layout.partials.extras._quick_notifications')
{{--@include('layout.partials.extras._quick_user')--}}
@include('layout.partials.extras._quick_panel')
@include('layout.partials.extras._chatpanel')
@include('layout.partials.extras._scrolltop')

<script>
    var HOST_URL = "";
</script>

<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>

<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('plugins/fancybox/jquery.fancybox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/jspdf.min.js')}}"></script>
<script src="{{asset('plugins/nepali-datepicker/nepali-datepicker.min.js')}}" type="text/javascript"></script>
@yield('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("form").submit(function() {
            KTApp.block('#kt_blockui_card', {
                overlayColor: '#000000',
                state: 'primary',
                message: 'Processing...'
            });
        });

        $('.password, .opass, .cpass, .pass').on('copy paste cut', function(e) {
            e.preventDefault();
        });

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if(\Session::has('success'))
swal.fire({
            title: "Success!",
            text: "{!! session('success') !!}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            showCancelButton: false,
            customClass: {
                confirmButton: "btn btn-success",
            }
        });
        @elseif(\Session::has('fail'))
swal.fire({
            title: "Failure!",
            text: "{!! session('fail') !!}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            showCancelButton: false,
            customClass: {
                confirmButton: "btn btn-success",
            }
        });
        @elseif(\Session::has('info'))
toastr.info("{!! session('info') !!}");
        @endif

$(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var $this = $(this);
            swal.fire({
                title: "Delete!",
                text: "Are you sure you want to delete this?",
                icon: "question",
                buttonsStyling: false,
                confirmButtonText: "Yes I'm sure",
                showCancelButton: true,
                cancelButtonText: "No",
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-default"
                }
            }).then(function(result) {
                console.log(result);
                if (result.hasOwnProperty('value')) {
                    $this.parents('form').submit();
                }
            });
        });

        $('.disableRole').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            swal.fire({
                title: "Disable!",
                text: "Are you sure you want to disable?",
                icon: "question",
                buttonsStyling: false,
                confirmButtonText: "Yes I'm sure",
                showCancelButton: true,
                cancelButtonText: "No",
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-default"
                }
            }).then(function(result) {
                console.log(result);
                if (result.hasOwnProperty('value')) {
                    $this.parents('form').submit();
                }
            });
        });

        $('.enableRole').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            swal.fire({
                title: "Enable!",
                text: "Are you sure you want to enable?",
                icon: "question",
                buttonsStyling: false,
                confirmButtonText: "Yes I'm sure",
                showCancelButton: true,
                cancelButtonText: "No",
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-default"
                }
            }).then(function(result) {
                console.log(result);
                if (result.hasOwnProperty('value')) {
                    $this.parents('form').submit();
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $('.nepdatepicker').nepaliDatePicker();




</script>
</body>

</html>