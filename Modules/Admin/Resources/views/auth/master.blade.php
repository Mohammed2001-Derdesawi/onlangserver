<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>            @yield('title')
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }} ">


        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/admin/css/bootstrap-rtl.min.css') }} " id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/admin/css/icons.min.css') }} " rel="stylesheet" type="text/css" />
        <!-- App Css-->

        <link rel="stylesheet" href="{{asset('assets/admin/css/app-rtl.min.css')}}" id="app-style" type="text/css">

        @stack('css')

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">

                <!-- end card -->
                @yield('content')
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/admin/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/admin/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/admin/libs/node-waves/waves.min.js')}}"></script>


        <script src="{{ asset('assets/admin/js/app.js')}}"></script>
        @stack('js')


    </body>
</html>
