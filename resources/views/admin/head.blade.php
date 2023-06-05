
    <meta charset="utf-8" />
    <title>            @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="لوحة التحكم الخاصة في منصة On language Courses" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/user/img/logo/main_logo.png')}}" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admin/css/bootstrap-rtl.min.css') }} " id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin/css/icons.min.css') }} " rel="stylesheet" type="text/css" />
    <!-- App Css-->

    <link rel="stylesheet" href="{{asset('assets/admin/css/app-rtl.min.css')}}" id="app-style" type="text/css">

    @stack('css')
