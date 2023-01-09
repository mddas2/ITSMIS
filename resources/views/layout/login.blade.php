<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../../">
    <meta charset="utf-8" />
    <title>ITSMIS</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset('css/pages/login/classic/login-6.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{asset('media/logos/favicon.ico')}}" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login login-6 login-signin-on login-signin-on d-flex flex-column-fluid" id="kt_login">
            <div class="d-flex flex-column flex-lg-row flex-row-fluid text-center" style="background-image: url({{asset('media/bg/bg-3.jpg')}});">
                <div class="d-flex w-100 flex-center p-15">
                    <div class="login-wrapper">
                        <div class="text-dark-75">
                            <img src="{{asset('media/logos/itsmis-logo.png')}}" class="max-h-100px" alt="" /> <br><br>
                            <div class="title">
                                <span style="font-size: 14px;">{{ __('lang.government_of_nepal') }}</span><br>
                                <span style="font-size: 16px;">{{ __('lang.ministry_of_industry_commerce_and_supplies') }}</span>
                            </div>
                            <h1 class="mb-8 mt-22 font-weight-bold">ITSMIS</h1>
                            <p class="mb-15 text-muted font-weight-bold"></p>
                          <!--   <a href="" id="kt_login_signup" class="btn btn-outline-primary btn-pill py-4 px-9 font-weight-bold">Dashboard</a> -->
                        </div>
                    </div>
                </div>
                <div class="login-divider">
                    <div></div>
                </div>
                <div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
                    <div class="login-wrapper">
                        <div class="login-signin">
                            <div class="text-center mb-10 mb-lg-20">
                                <h2 class="font-weight-bold">Sign In</h2>
                                <p class="text-muted font-weight-bold">{{ __('lang.enter_your_username_password') }}</p>
                            </div>
                            <form class="form text-left" action="{{route('login')}}" method="post">
                                {{csrf_field()}}
                                @if(session('fail'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <div class="alert-text">{!! session('fail')!!}</div>
                                    <!-- <div class="alert-close">							
											<i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>		
										</div>	 -->
                                </div>
                                @endif
                                <div class="form-group py-2 m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Username" name="username" autocomplete="off" />
                                </div>
                                <div class="form-group py-2 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" />
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-5">
                                    <div class="checkbox-inline"> <label class="checkbox m-0 text-muted font-weight-bold">
                                            <input type="checkbox" name="remember" /> <span></span>Remember me</label>
                                    </div>
                                </div>
                                <div class="text-center mt-15">
                                    <button type="submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">{{ __('lang.sign_in') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="login-forgot">
                            <div class="text-center mb-10 mb-lg-20">
                                <h3 class="">Forgotten Password ?</h3>
                                <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
                            </div>
                            <form class="form text-left" id="kt_login_forgot_form">
                                <div class="form-group py-2 m-0 border-bottom"> <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Email" name="email" autocomplete="off" /> </div>
                                <div class="form-group d-flex flex-wrap flex-center mt-10"> <button id="kt_login_forgot_submit" class="btn btn-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Submit</button> <button id="kt_login_forgot_cancel" class="btn btn-outline-primary btn-pill font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button> </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
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
    <script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script src="{{asset('js/scripts.bundle.js')}}"></script>
    <script src="{{asset('js/pages/custom/login/login-general.js')}}"></script>
</body>

</html>
