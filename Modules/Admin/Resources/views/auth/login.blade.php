@extends('admin::auth.master')
@section('title','تسجيل الدخول')

@section('content')
<div class="card">
    <div class="card-body">

        <div class="text-center mt-4">
            <div class="mb-3">
                <a class="auth-logo">
          
                    <img width="150px"  src="{{ asset('assets/user/img/logo/main_logo.png')}}" height="120" class="logo-dark mx-auto" alt="">
                </a>
            </div>
        </div>

        <h4 class="text-muted text-center font-size-18"><b>تسجيل الدخول</b></h4>

        <div class="p-3">
            <form class="form-horizontal mt-3" action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="form-group mb-3 row">
                    <div class="col-12">
                        <input class="form-control" type="email" name="email" required="" placeholder="البريد الإلكتروني">
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first("email") }}</span>
                    @endif
                </div>

                <div class="form-group mb-3 row">
                    <div class="col-12">
                        <input class="form-control" type="password" name="password" required="" placeholder="كلمة المرور">
                    </div>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first("password") }}</span>
                   @endif
                </div>

                <div class="form-group mb-3 row">
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                            <input name="remember" type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="form-label ms-1" for="customCheck1">تذكرني</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3 text-center row mt-3 pt-1">
                    <div class="col-12">
                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">تسجيل الدخول</button>
                    </div>
                </div>

                <div class="form-group mb-0 row mt-2">
                    <div class="col-sm-7 mt-3">
                        <a href="{{ route('admin.password.request')}}" class="text-muted"><i class="mdi mdi-lock"></i>هل نسيت كلمة المرور؟</a>
                    </div>

                </div>
            </form>
        </div>
        <!-- end -->
    </div>
    <!-- end cardbody -->
</div>

@endsection
