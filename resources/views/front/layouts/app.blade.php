<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ config('app.name')}}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front-assets/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front-assets/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front-assets/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front-assets/assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{ asset('front-assets/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('front-assets/assets/img/favicons/mstile-150x150.png')}}"> --}}
    {{-- <meta name="theme-color" content="#ffffff"> --}}


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('front-assets/assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-assets/assets/css/custom.css') }}" rel="stylesheet" />

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

      @include('front.layouts.includes.navigation')

      @yield('content')



      @include('front.layouts.includes.footer')

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('front-assets/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('front-assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-assets/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('front-assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('front-assets/assets/js/theme.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  </body>

</html>
