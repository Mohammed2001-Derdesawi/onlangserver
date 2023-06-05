<!doctype html>
<html  lang="zxx"  style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/user/img/logo/main_logo.png')}}" />

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>OnLanguage Courses  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ trans('main_trans.seo_description') }}">
    <meta name="keywords" content="onlanuagecourses, turkey, language , a1 ,a2 ,b1 ,b2 , language,language learning,languages,language study,african language,learn a new language,how to learn a language,foreign languages,how to learn languages,language test,woke language,language hacks,dutch language,polyglot speaking languages,top languages,learn a language,in 60 languages,frisian language,foreign language,harmful language,english language,study languages,learn languages,minority language , turkish language,learn turkish,turkish lesson,turkish phrases,turkish,learn turkish language,turkish pronunciation,turkish language lesson 1,learn turkish beginner,turkic languages,turkish alphabet,turkish language spoken,learn turkish online,turkish for beginners,turkish classes,turkish lessons,language,learning turkish,turkish grammar,how to learn turkish,language learning,turkish words,turkish language course ,تعلم اللغة التركية,اللغة التركية,تعلم اللغة التركية للمبتدئين,تعليم اللغة التركية,تعلم اللغة التركية بالصوت والصورة,تعلم التركية,تعلم قواعد اللغة التركية,دورة تعلم اللغة التركية,تعلم اللغة التركية بسهولة,تعلم اللغة التركية من الصفر,تعلم التركية بسهولة,تعلم التركية ببساطة,تعلم التركية للمبتدئين,اللغة التركية للمبتدئين,تعلم اللغة التركية بالصوت والصورة للمبتدئين,تعلم التركية للاطفال,تعلم التركية من الصفر,تعلم التركية مع أخيك التركي">
    <meta name="author" content="onlanuagecourses">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="robots" content="index, follow">
   <meta property=”og:locale” content=”en_US”>
   <meta property=”og:type” content=”website”>
   <meta property=”og:title” content=”Credo – Hire the best pre-vetted SEO, PPC, and digital marketing firms”>
   <meta property=”og:description” content=”Looking to hire an SEO, PPC, or digital marketing firm/consultant? We’ve created a network of vetted providers and will help you hire the right one!”>
   <meta property=”og:url” content=”https://www.getcredo.com/”>
   <style>

.chat-container {
  position: relative;
}
    .chat-icon {
        position: fixed;
        bottom: 10px;
        right: 20px;
        background-color: #ffb013;
        color: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
    }




   </style>
   {{--  <meta property=”og:locale” content=”en_US”>
   <meta property=”og:type” content=”website”>
   <meta property=”og:title” content=”Credo – Hire the best pre-vetted SEO, PPC, and digital marketing firms”>
   <meta property=”og:description” content=”Looking to hire an SEO, PPC, or digital marketing firm/consultant? We’ve created a network of vetted providers and will help you hire the right one!”>
   <meta property=”og:url” content=”https://www.getcredo.com/”>
   <meta property=”og:site_name” content=”Credo”>  --}}
   @php
   $adsSettings=cache()->get('settings.ads')??['code'=>''];

   @endphp
    @if($adsSettings['code'] != '')

            {!! $adsSettings['code']  !!}

    @endif


    {{--  @php
        $items=0;
        $cart=[];
       if($cart=session()->get('cart'))
        $items=count($cart);
       else
           {
               if(auth()->check())
               if ($cart = auth()->user()->cart)
               $items=count($cart->cart_items);
               else
                   $items = 0 ;

           }

    @endphp  --}}


 @include('user.head')
 @yield('css')
 <style>

    .chat-container {
      position: relative;
    }
        .chat-icon {
            position: fixed;
            bottom: 10px;
            right: 20px;
            background-color: #ffb013;
            color: #fff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }




    </style>


</head>

<body >
    <div class="body-overlay"></div>

@include('user.mainheader_bar')



<main>


 @yield('content')

</main>


@auth
<div class="chat-container">
    <div class="chat-icon" title="click to chat">
        <a href="{{route('user.message.index')}}"><i class="fa fa-comment" style="font-size: 19px"></i></a>
    </div>
</div>
@endauth
@include('user.footer')

@auth
<div class="chat-container">
    <div class="chat-icon" title="click to chat">
        <a href="{{route('user.message.index')}}"><i class="fa fa-comment" style="font-size: 19px"></i></a>
    </div>
</div>
@endauth



@include('user.footer_scripts')

@yield('js')

</body>


</html>

