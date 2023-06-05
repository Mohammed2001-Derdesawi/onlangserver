 <!-- Add your site or application content here -->


@php
$settings=cache()->get('settings') && isset(cache()->get('settings')['general_info'])?cache()->get('settings')['general_info']:config('front_settings.general_info');



$user=Auth::user();
if ($user) {
        $user->load(['UnReardreceivedMessages','unreadNotifications']);
  $cart = \Cart::session($user->id)->getContent();
  $notifications=$user->UnReardreceivedMessages->merge($user->unreadNotifications);

} else {
 $cart = \Cart::getContent();
 $notifications=collect();
}



@endphp



<!-- side toggle start -->
<div class="fix">
    <div class="side-info">
        <div class="side-info-content">
            <div class="offset-widget offset-logo mb-40">
                <div class="row align-items-center ">
                    <div class="col-9">
                        <a>
                            <img  width="50px" src="{{asset('assets/user/img/logo/main_logo.png')}}" alt="Logo">
                        </a>
                    </div>
                    <div class="col-3 text-end">
                        <button class="side-info-close"><i class="fal fa-times"></i></button>
                    </div>
                </div>
            </div>
            <div class="mobile-menu d-xl-none fix">

                @auth


                    <ul class="sub-menu menu-item-has-children" style="width: 150px">

                        <li class="user-btn-sign-in" style="width: 150px" >Welcome: {{auth()->user()->name}}</li>
                        <li class="user-btn-sign-in" style="width: 150px"><a href="{{ route('profile.show') }}">{{trans('profile.my_profile')}} </a></li>
                        <li  style="width: 150px">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                @method('POST')
                                <button class="user-btn-sign-in" type="submit "> <span style="font-size: 15px;padding-top: 10px">{{trans('header_trans.logout')}} </span></button>

                            </form>
                        </li>

                    </ul>





                    </div>
                    @endauth

                    @guest
                    <a class=" edu-btn"
                       href="{{  URL('register') }}">{{trans('header_trans.sign_up')}}</a>




                       <a class="user-btn-sign-in"
                       href="{{ URL('login') }}">{{trans('header_trans.sign_in')}}</a>                @endguest
            </div>
            <div class="offset-widget offset_searchbar mb-30">
                <div class="menu-search position-relative ">

                </div>
            </div>

        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<div class="offcanvas-overlay-white"></div>
<!-- side toggle end -->


<!-- header note area end -->

<!-- header-area-start  -->
<header>

    <div class="header-top-area d-none d-lg-block">
        <div class="container-fluid">
           <div class="header-top-inner">
              <div class="row align-items-center">
                 <div class="col-xl-8 col-lg-8">
                    <div class="header-top-icon">
                       <a href="tel:{{ $settings['support_phone'] }} " target="_blank"><i class="fas fa-phone"></i> <span> {{ $settings['support_phone'] }}</span></a>
                       <a href="mailto:{{ $settings['support_phone'] }}" target="_blank" ><i class="fal fa-envelope"></i><span class="__cf_email__" data-cfemail="b6dfd8d0d9f6d3ced7dbc6dad398d5d9db">{{$settings['support_phone'] }}
                    </span></a>
                       <i class="fal fa-map-marker-alt"></i><span>{{$settings['location'] }}</span>
                    </div>
                 </div>
                 <div class="col-xl-4 col-lg-4">
                    <div class="header-top-login d-flex f-right">
                       <div class="header-user-login p-relative ">
                          <span><a  target="_blank" class="user-btn-sign-up" href="https://www.facebook.com/onlanguagecourses"> <a  target="_blank" href="https://www.facebook.com/onlanguagecourses"><i style="margin-right: 50px; font-size: 25px;" class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="#"><i style="margin-right: 50px; font-size: 25px;" class="fab fa-twitter"></i></a>
                            <a target="_blank" href="https://wa.me/905436300505"><i style="margin-right: 50px; font-size: 25px;" class="fab fa-whatsapp"></i></a>
                            <a target="_blank" href="https://www.youtube.com/@onlanguagecourses"><i style="margin-right: 50px; font-size: 25px;" class="fab fa-youtube"></i></a>

                            <a target="_blank" href="https://www.instagram.com/on_language_courses/"><i style="margin-right: 50px; font-size: 25px;" class="fab fa-instagram"></i></a></a></span>
                       </div>
                       <div class="">

                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>

    <div class="header-area header-transparent sticky-header">
        <div class="container-fluid">
            <div class="header-main-wrapper">
                <div class="row align-items-center mobile" style="background-color:white ">

                    <div class="col-xl-9  col-sm-9 col-9">
                        <div class="header-left  align-items-center rtl-margin">
                            <a class="display" href="{{ route('home') }}" >
                                <img  width="100px" src="{{asset('assets/user/img/logo/main_logo.png')}}" alt="Logo">
                            </a>

                            <div class="main-menu d-none d-xl-block">
                                <nav id="mobile-menu">
                                    <ul  style="    min-width: 120%;  ">
                                        <li class="menu-item-has-childre">  <div class="header-logo">
                                            <a style="padding: 0px" href="{{ route('home')}}"><img width="100px" height="100px" src="{{asset('assets/user/img/logo/main_logo.png')}}"
                                                                      alt="logo"></a>
                                        </div>

                                    </li>
                                        <li class="menu-item-has-childre"><a
                                                href=" {{ route( 'home')  }}">{{trans('header_trans.home')}}</a>

                                        </li>

                                        <li class="menu-item-has-children"><a
                                                href="#">{{trans('header_trans.course')}}</a>
                                            <ul class="sub-menu">
                                                 <li><a href="{{  route('user.allCourses') }}">{{ trans('header_trans.onlinecourse' )}}</a>
                                                 </li>
                                                 <li><a    href="{{  route('user.privateTeachers') }}" >{{trans('header_trans.privatecourse')}}</a>
                                                 </li>
                                                @auth
                                                <li><a href="{{ URL('my/courses')  }}">{{trans('header_trans.my_courses')}}</a>
                                                </li>
                                                @endauth
                                                <li class="menu-item-has-childre"><a
                                                    href="{{ route('private.payment') }}">{{trans('header_trans.sepregister')}}</a>

                                            </li>
                                            <li><a href="{{ route('user.teachers')  }}">{{trans('header_trans.teachers')}}</a>
                                            </li>
                                            </ul>
                                        </li>




                                        <li class="menu-item-has-children"><a
                                                href="#">{{trans('header_trans.videos')}}</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('user.freePlayList')  }}">{{trans('header_trans.free')}}</a>
                                                </li>
                                                    <li><a href="{{ route('user.paidPlayList')  }}">{{trans('header_trans.paid')}}</a>
                                                    </li>


                                            </ul>
                                        </li>

                                        <li class="menu-item-has-childre"><a
                                            href=" {{ route('affiliate.all.details') }}">{{trans('header_trans.rewards')}}</a>

                                    </li>

                                    <li class="menu-item-has-childre"><a
                                        href=" {{ route('user.allArticles') }}">{{trans('header_trans.blog')}}</a>

                                </li>

                                        <li class="menu-item-has-childre"><a
                                                href="{{ route('contactUs') }}">{{trans('header_trans.contact_us')}}</a>

                                        </li>
                                        <li class="menu-item-has-childre"><a
                                            href="{{ route('aboutUs') }}">{{trans('header_trans.about_us')}}</a>

                                        </li>


                                        <li class="menu-item-has-children"><a
                                                href="#">{{  trans('header_trans.lang') }}</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                                        {{  trans('header_trans.lang_en') }} <img
                                                            src="{{ URL::asset('assets/user/img/flags/US.png') }}"
                                                            alt="">
                                                    </a>
                                                </li>

                                                <li><a href="{{LaravelLocalization::getLocalizedURL('ar')}}">
                                                        {{  trans('header_trans.lang_ar') }} <img
                                                            src="{{ URL::asset('assets/user/img/flags/EG.png') }}"
                                                            alt="">
                                                    </a></li>

                                                <div class="dropdown-menu">
                                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                        <a class="dropdown-item" rel="alternate"
                                                           hreflang="{{ $localeCode }}"
                                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                            {{ $properties['native'] }}
                                                        </a>
                                                    @endforeach
                                                </div>


                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-7 col-sm-3 col-3">

                        <div class=" d-flex align-items-center justify-content-center">
                            @auth
                                <div class="main-menu d-none d-xl-block">
                                    <nav id="mobile-menu">
                                        <ul style="padding-right: 70px">

                                            <li class="menu-item-has-childre" >
                                                <a> <i  style="  font-size: 30px"  class="far fa-user-circle	"></i></a>
                                                <ul class="sub-menu" style="width: 150px">

                                                    <li  style="width: 150px"><a href="{{ route('profile.show') }}" > {{trans('profile.my_profile')}} </a></li>
                                                    <li  style="width: 150px">
                                                        <form action="{{route('logout')}}" method="post">
                                                            @csrf

                                                            <button type="submit  ">{{trans('header_trans.logout')}}</button>

                                                        </form>
                                                    </li>

                                                </ul>

                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            @endauth

{{--                        @auth--}}
{{--                                <div class="d-none d-md-block">--}}
{{--                                    <form action="{{route('logout')}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                    <button class="user-btn-sign-up edu-btn"--}}
{{--                                          type="submit ">{{trans('header_trans.logout')}}</button>--}}

{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            @endauth--}}

<div class="header-btn">
    <div class="cart-wrapper mr-45" style="margin: 30px">
        <a href="{{ route('cart.details') }}" class="cart-toggle-btn">
            <div class="header__cart-icon p-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="19.988" height="19.988"
                    viewBox="0 0 19.988 19.988">
                    <g id="trolley-cart" transform="translate(-1 -1)">
                        <path id="Path_36" data-name="Path 36"
                            d="M1.666,2.333H3.8L6.159,12.344a1.993,1.993,0,0,0,.171,3.98H17.656a.666.666,0,1,0,0-1.333H6.33a.666.666,0,0,1,0-1.333H17.578a1.992,1.992,0,0,0,1.945-1.541l1.412-6a2,2,0,0,0-1.946-2.456H5.486L4.98,1.514A.666.666,0,0,0,4.331,1H1.666a.666.666,0,0,0,0,1.333ZM18.989,5a.677.677,0,0,1,.649.819l-1.412,6a.662.662,0,0,1-.648.514H7.524L5.8,5Z"
                            transform="translate(0 0)" fill="#141517" />
                        <path id="Path_37" data-name="Path 37"
                            d="M20,27a2,2,0,1,0,2-2A2,2,0,0,0,20,27Zm2.665,0A.666.666,0,1,1,22,26.333.666.666,0,0,1,22.665,27Z"
                            transform="translate(-6.341 -8.01)" fill="#141517" />
                        <path id="Path_38" data-name="Path 38"
                            d="M9,27a2,2,0,1,0,2-2A2,2,0,0,0,9,27Zm2.665,0A.666.666,0,1,1,11,26.333.666.666,0,0,1,11.665,27Z"
                            transform="translate(-2.67 -8.01)" fill="#141517" />
                    </g>
                </svg>
                <span class="item-number" id="cart_number">{{ count($cart) }}</span>
                </div>
        </a>
    </div>
    @auth
    <div class="notification">
        <button onclick="myFunction()">
            <i class="far fa-bell" id="notify"></i>
            <span class="item-number">{{ count($notifications) }}</span>

        </button>
        <ul class="sub-menu1" id="toggleshow" style="width:280px">
            <li class="totally">
                <h6>الاشعارات </h6>
                <p>{{ count($notifications) }} new</p>
            </li>

            @foreach($notifications as $notify)
                @if(class_basename($notify) == "Message")
            <li>
                <i class="fas fa-envelope"></i> <a  href="{{ route('user.message.index') }}" >{!! substr($notify->message,0 , 20) !!} ...</a>
                <a class="user-btn-sign-in"  href="{{ route('user.message.index') }}">الرد</a>

            </li>
            @else

            <li>
                <i class="fas fa-bell"></i>
                <a href="{{ route('user.notification.all') }}">{!! substr($notify->data['title'],0 , 20 ) !!} ...</a>
                <a class="user-btn-sign-up edu-btn" style="color: white;height:44px;padding:0px 20px"  href="{{ route('user.notification.all') }}">قراءة</a>
            </li>
            @endif

            @endforeach

        </ul>
     </div>
    @endauth


<div class="menu-bar ml-20 d-lg-none d-sm-block">
<a class="side-toggle header-2" href="javascript:void(0)">
<div class="bar-icon">
    <span></span>
    <span></span>
    <span></span>
</div>
</a>
</div>

</div>

                                    <div class="user-btn-inner p-relative d-none d-md-block">
                                <div class="user-btn-wrapper">
                                    @guest
                                        <div class="user-btn-content ">

                                            <a class="user-btn-sign-in"
                                            href="{{ route('login') }}">{{trans('header_trans.sign_in')}}</a>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                            @guest
                                <div class="d-none d-md-block">
                                    <a class="user-btn-sign-up edu-btn"
                                  style="font-size:13.5px"   href="{{ route('register') }}">{{trans('header_trans.sign_up')}}</a>
                                    @endguest

                                </div>




                                 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- header-area-end -->
