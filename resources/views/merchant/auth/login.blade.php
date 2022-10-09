<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="SOURCES">
    <title>Login | {{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/sources1.png') }}'">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/sources.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-auth.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <div class="d-none d-lg-flex align-items-center p-5 col-lg-8">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset('app-assets\images\banner\merchant.png') }}" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex align-items-center auth-bg px-2 p-lg-5 col-lg-4">
                            <div class="px-xl-2 mx-auto col-sm-8 col-md-10 col-lg-12">
                                <div class="d-flex justify-content-center">
                                    <a class="" href="{{url('/')}}">
                                        <img style="height:55px;" src="{{ asset('logo.png') }}" />
                                    </a>
                                </div>
                                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                    <h1 class="card-title font-weight-bold mb-1" style="text-align: center;  text-decoration: underline;"><b>Merchant Login</b></h1>
                                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                                    @if ($errors->any())
                                    <div role="alert" aria-live="polite" aria-atomic="true" class="alert alert-primary">
                                        <div class="alert-body font-small-2">
                                            @foreach ($errors->all() as $error)
                                            <p><small class="mr-50">{{ $error }}</small></p>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    <form class="auth-login-form mt-2" action="{{ route('merchant.loginCheck') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                        <label class="form-label" for="login-mobile">Mobile</label>
                                        <input class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" id="login-mobile" type="text" name="mobile" placeholder="01710355789" aria-describedby="login-mobile" autofocus="" tabindex="1" />
                                    </div>
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between">
                                                <label for="login-password">Password</label><a href="{{route('merchant.password.request')}}"><small>Forgot Password?</small></a>
                                            </div>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i data-feather="lock"></i></span>
                                                </div>
                                                <input type="password" id="login-password" class="form-control form-control-merge" name="password" placeholder="Password" aria-describedby="login-password" tabindex="2" />
                                                <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} tabindex="3" />
                                                <label class="custom-control-label" for="remember"> Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('') }}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('') }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('') }}app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('') }}app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('') }}app-assets/js/scripts/pages/page-auth-login.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>