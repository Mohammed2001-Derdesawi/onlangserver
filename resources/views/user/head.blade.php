   <style>

    @media (min-width: 767px){
        .display{
            display: none;
        }
    }
   </style>

<!--- Style css -->
@if (App::getLocale() == 'en')
<link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}">

@elseif(App::getLocale() == 'ar')
<link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.rtl.min.css') }}">

@endif
{{--  <link rel="stylesheet" href="{{ asset('assets/user/css/meanmenu.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/animate.min.css') }}">  --}}
<link rel="stylesheet" href="{{ asset('assets/user/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/swiper-bundle.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/backToTop.css') }}">

{{--  <link rel="stylesheet" href="{{ asset('assets/user/css/magnific-popup.css') }}">  --}}
{{--  <link rel="stylesheet" href="{{ asset('assets/user/css/huicalendar.css') }}">  --}}
<link rel="stylesheet" href="{{ asset('assets/user/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/fontAwesome5Pro.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/default.css') }}">
{{--  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">  --}}


    @auth
    <style>
        @media (max-width: 776px) {
            .header-btn{
                margin-left: 90px
            }
        }
    </style>
    @endauth


<!--- Style css -->
@if (App::getLocale() == 'en')
<link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
  <style>

    .sub-menu1{
        margin-right: 100px;
    }
   .modal-content{
    margin-top: 200px;
   }
    @media (max-width: 575px) {

        div.mean-bar{
            direction: ltr ;

}
.mean-container .mean-nav ul li {
            position: relative;
            float: left;
            width: 77%;
    }
 .mobile{

    padding-right: 100px;
    height: 100px;

 }
      }
      @media (max-width: 776px) {

        .mobile{

            padding-right: 100px;
            height: 100px;
         }

    }


</style>
@endif

@if (App::getLocale() == 'ar')

 <style>
    .modal-content{
        margin-top: 200px;
       }
 @media (max-width: 575px) {
    .user-btn-sign-in{
        font-size: 13px;
    }


    div.mean-bar{
        direction: ltr ;

    }
    .mean-container .mean-nav ul li {
        position: relative;
        float: left;
        width: 77%;}
 .mobile{

    padding-left: 7px;
    height: 100px;

 }
 .one{
 margin-top: 101px;}

 }

@media (max-width: 776px) {

    .user-btn-sign-in{
        font-size: 13px;
    }


        div.mean-bar{
            direction: ltr ;

}

.mean-container .mean-nav ul li {
            position: relative;
            float: left;
            width: 77%;
    }

.mobile{
            height: 100px;

            padding-left: 7px;
        }

.one{
           margin-top: 120px;}

      }


 </style>


<link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/user/css/rtl/style.css') }}">
{{--  <link rel="stylesheet" href="{{ asset('assets/user/css/rtl.css') }}">  --}}


@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
