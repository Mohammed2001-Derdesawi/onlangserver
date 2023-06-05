<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ trans('sign.sign_up') }}</title>

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

  <div class="signup-area open">
     <div class="sign-up-wrapper">

         <div class="signup-box text-center">
             <div class="signup-text">
                 <h3>{{ trans('sign.sign_up') }}</h3>
             </div>
             <div class="signup-message">
                 <img src="{{ asset('assets/user/img/sing-up/sign-up-message.png') }}" alt="image not found">
             </div>
             <div class="signup-thumb">
                 <img height="250px" src="{{ asset('assets/user/img/sing-up/sign-up.png') }}" alt="image not found">
             </div>
         </div>
         @php
             $route=route('register');

             if(request()->share_id && request()->camp_id)
             $route.="?share_id=".request()->share_id."&&camp_id=".request()->camp_id;


         @endphp
         <form method="POST" action="{{ $route}}">
           @csrf
           <x-auth-validation-errors class="mb-4" :errors="$errors" />

         <div class="signup-form-wrapper">
            @if($errors->has('name'))
            <span class="text-danger"> {{ $errors->first('name') }} </span>
            @endif
             <div class="signup-input-wrapper">
                 <input type="text" placeholder="{{ trans('sign.name') }}" id="name" name="name" :value="old('name')" required autofocus>
             </div>
             @if($errors->has('email'))
             <span class="text-danger"> {{ $errors->first('email') }} </span>
             @endif
             <div class="signup-wrapper">
                 <input placeholder="{{ trans('sign.email') }}" id="email"  type="email" name="email" :value="old('email')" required>
             </div>
            @if($errors->has('password'))
            <span class="text-danger"> {{ $errors->first('password') }} </span>
            @endif
             <div class="signup-wrapper">
                 <input  placeholder="{{ trans('sign.password') }}" id="password" class="block mt-1 w-full"
                 type="password"
                 name="password"
                 required autocomplete="new-password">
             </div>

             @if($errors->has('password_confirmation'))
             <span class="text-danger"> {{ $errors->first('password_confirmation') }} </span>
             @endif
             <div class="signup-wrapper">
              <input  placeholder="{{ trans('sign.con_password') }}"  id="password_confirmation"
              type="password"
              name="password_confirmation" required >
          </div>
       
             <div class="sing-buttom mb-20">
                 <button class="sing-btn">{{ trans('sign.sign_up') }}</button>
             </div>
             <div class="acount-login text-center">
                 <span>{{ trans('sign.have_account') }}? <a href="{{ route('login') }}">{{ trans('sign.sign_in') }}</a></span>
             </div>
         </div>
         </form>
     </div>
 </div>
</body>
</html>
