<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('sign.sign_in') }}</title>

    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <!--- Style css -->
            @if (App::getLocale() == 'en')
                <link href="{{ asset('assets/user/css/ltr.css') }}" rel="stylesheet">
            @else
                <link href="{{ asset('assets/user/css/rtl.css') }}" rel="stylesheet">
            @endif


</head>
<body>



    @if (Session::has('success') || Session::has('faild') ||  Session::has('warning') )

    <div style="margin-top: 20px;display: flex;justify-content: center; align-items:center;">
        @if (Session::has('success'))

        <div class="alert alert-info text-center" style="width:200px;color:#3065D0;background:none;font-size: 20px;"  role="alert">
           {{Session::get('success')}}
          </div>

        @endif
        @if (Session::has('faild'))

        <div class="alert alert-faild text-center" style="width:200px;color:rgb(255, 42, 42);background:none;font-size: 20px;"   role="alert">
           {{Session::get('faild')}}
          </div>

        @endif
        @if (Session::has('warning'))

        <div class="alert alert-warning text-center" style="width:200px;color:#d49101;background:none;font-size: 20px;"  role="alert">
           {{Session::get('warning')}}
          </div>

        @endif
       </div>

       @endif

  <div class="signin-area open">


      <div class="signin-area-wrapper">
         <div class="signup-box text-center">
            <div class="signup-text">
               <h3>{{ trans('sign.sign_in') }}</h3>
            </div>
            <div class="signup-thumb">
               <img src="{{ asset('assets/user/img/sing-up/sign-up.png') }}" alt="image not found">
            </div>
         </div>
         <form method="POST" action="{{ route('login') }}">
            @csrf

            <span class="text-danger" style="padding-bottom: 10px ;margin-left:30px;">
                <x-auth-session-status class="mb-4" :status="session('status')" />

            </span>

            <!-- Email Address -->
         <div class="signup-form-wrapper" style="margin-top:60px">
            @if($errors->has('email'))
            <span class="text-danger"> {{ $errors->first('email') }} </span>
            @endif
            <div class="signup-wrapper">
                <label>{{ trans('sign.email') }}</label>
               <input type="email" placeholder="{{ trans('sign.email') }} " name="email" :value="old('email')" required autofocus id="email" >
            </div>
            @if($errors->has('password'))
            <span class="text-danger"> {{ $errors->first('password') }} </span>
            @endif
            <div class="signup-wrapper">
                <label>{{ trans('sign.password') }}</label>

               <input type="password" placeholder="{{ trans('sign.password') }}"  id="password"

               type="password"
               name="password"
               required autocomplete="current-password" >
            </div>
            <div class="signup-action">
               <div class="course-sidebar-list">
                  <input class="signup-checkbo"  id="remember_me" type="checkbox"  name="remember" >
                  <label  class="sign-check" for="sing-in"><span>{{ trans('sign.remember_me') }}</span></label>
               </div>
            </div>
            <div class="sing-buttom mb-20">
               <button class="sing-btn">{{ trans('sign.sign_in') }}</button>
            </div>
            <div class="registered wrapper">
               <div class="not-register">
                  <span>{{ trans('sign.not_registered') }}?</span><span><a href="{{ route('register') }}">{{ trans('sign.sign_up') }}</a></span>
               </div>
               <div class="forget-password">
                  @if (Route::has('password.request'))

                  <a href="{{ route('password.request') }}"> {{ trans('sign.forget_pass') }}?</a>
                  @endif

               </div>
            </div>


        </form>

      </div>
   </div>



</body>
</html>
