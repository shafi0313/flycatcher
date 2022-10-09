<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('/') }}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/vendors.min.css">
    @yield('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/extensions/sweetalert2.min.css">
    @yield('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet"  href="{{ asset('app-assets/css/all.min.css') }}">

</head>
<body class="vertical-layout vertical-menu-modern footer-static menu-expanded pace-done navbar-sticky" data-open="click" data-menu="vertical-menu-modern" data-col="">
  @include('rider.partials.topbar')
  <!-- END: Header-->


  <!-- BEGIN: Main Menu-->
  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/rider/dashboard') }}"><span class="brand-logo">
              <img src="{{ asset('/') }}app-assets/images/ico/favicon.ico">
            </span>
            <h2 class="brand-text">Rider</h2>
          </a></li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
      @include('rider.partials.sidebar')
    </div>
  </div>
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    @yield('content')
  </div>
  <!-- END: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <!-- BEGIN: Footer-->
  <footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="https://www.parcelsheba.com/" target="_blank">Parcelsheba</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
  </footer>
  <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
  <!-- END: Footer-->


  <!-- BEGIN: Vendor JS-->
  <script src="{{ asset('/') }}app-assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->
  @yield('vendor-js')
  <<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{ asset('/') }}app-assets/js/core/app-menu.js"></script>
  <script src="{{ asset('/') }}app-assets/js/core/app-menu.js"></script>
  <script src="{{ asset('/') }}app-assets/js/core/app.js"></script>
  <script src="{{ asset('/') }}app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
  <script src="{{ asset('/') }}app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
  <script src="{{ asset('/') }}app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
  <script src="{{ asset('/') }}app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
  <script src="{{ asset('/') }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
  <script src="{{ asset('/') }}app-assets/js/scripts/forms/form-select2.js"></script>
  <script src="{{ asset('/') }}app-assets/js/all.min.js"></script>
  <script src="{{ asset('/') }}app-assets/js/scripts/components/components-dropdowns.js"></script>
  @yield('page-js')
  {!! Toastr::message() !!}
  <!-- Google analytics script-->
  @include('rider.partials.message')
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
  @stack('script')
</body>
<!-- END: Body-->

</html>
