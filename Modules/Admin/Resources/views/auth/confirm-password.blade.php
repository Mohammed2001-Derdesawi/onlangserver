<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">


        <!-- FAVICONS ICON -->
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

        <!-- PAGE TITLE HERE -->
        <title>لوحة التحكم- نسيت كلمة المرور</title>

        <!-- MOBILE SPECIFIC -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- STYLESHEETS -->
        <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">

    </head>
<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">تأكيد كلمة المرور</h4>
                                    <form method="POST" action="{{ route('admin.password.confirm') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label><strong>البريد الإلكتروني</strong></label>
                                            <input id="password" class="block mt-1 w-full"
                                             type="password"
                                           name="password"
                                         required autocomplete="current-password" />
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">تأكيد كلمة المرور</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->
     <!-- Required vendors -->
     <script src="{{asset('assets/admin/vendor/global/global.min.js')}}"></script>
     <script src="{{asset('assets/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
     <script src="{{asset('assets/admin/js/custom.min.js')}}"></script>
     <script src="{{asset('assets/admin/js/dlabnav-init.js')}}"></script>
</body>
</html>
