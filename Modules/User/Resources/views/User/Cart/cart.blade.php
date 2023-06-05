@extends('user.master')

@section('title')
    {{  trans('cart_trans.cart') }}
@endsection

@section('css')
@endsection
@section('content')
    <main>
        <!-- hero-area-start -->
        <div class="hero-arera course-item-height" data-background="{{  asset('assets/user/img/slider/course-slider.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-course-1-text">
                            <h2>{{  trans('cart_trans.my_cart') }}</h2>
                        </div>
                        <div class="course-title-breadcrumb">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ URL('/') }} ">{{  trans('header_trans.home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{  trans('cart_trans.cart') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero-area-end -->


        <!-- Cart Area Strat-->
        <section class="cart-area pt-100 pb-100" style="margin-top:50px ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @if(count($cart))
                        <div class="table-content table-responsive">

                            <table class="table">

                                    <thead>
                                    <tr>  
                                        <th class="cart-product-name">   {{  trans('cart_trans.product') }} </th>
                                        <th class="product-price">  {{  trans('cart_trans.price') }}  </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @auth
                                        @foreach($cart as $cart_item)

                                            <tr>

                                                @if(App::getlocale() == 'en')
                                                    <td class="product-name">{{$cart_item->name}}</td>
                                                @else
                                                    <td class="product-name">{{$cart_item->name}}</td>
                                                @endif
                                                <td class="product-price"><span class="amount">${{$cart_item->price}}</span></td>
                                                 <td>
                                                   <form action="{{route('cart.remove',$cart_item->id)}}" method="post">

                                                    @csrf
                                                    @method('post')
                                                      <button type="submit"><i class='fas fa-trash text-danger'></i></button>
                                                      </form>
                                                 </td>

                                            </tr>
                                        @endforeach
                                    @endauth
                                    @guest
                                        @foreach($cart as $course)

                                            <tr>

                                                @if(App::getlocale() == 'en')
                                                    <td class="product-name">{{$course->name}}</td>
                                                @else
                                                    <td class="product-name">{{$course->name}}</td>
                                                @endif
                                                <td class="product-price"><span class="amount">${{$course->price}}</span></td>
                                                  <td>
                                                    <form action="{{route('cart.remove',$course->id)}}"  method="post">
                                                        @csrf
                                                                 @method('post')
                                                           <button type="submit"><i class='fas fa-trash text-danger'></i></button>
                                                        </form>
                                                    </td>
                                            </tr>
                                        @endforeach
                                    @endguest

                                    </tbody>


                            </table>

                        </div>


                    @auth

                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">

                                    <h2>{{  trans('cart_trans.cart_total') }}</h2>
                                    <ul class="mb-20">

                                            @php
                                              $total =  $cart->sum('price')
                                            @endphp
                                        <li>Total <span>${{$total }}</span></li>
                                    </ul>
                                    <a class="edu-border-btn" href="{{ URL('checkout' ) }}">{{  trans('cart_trans.cart_process') }}</a>
                                </div>
                            </div>
                        </div>
                        @endauth
                        @guest
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">


                                            <h2>{{  trans('cart_trans.cart_total') }}</h2>
                                            <ul class="mb-20">
                                                @php
                                                    $total =  $cart->sum('price')
                                                @endphp

                                                <li>Total <span>${{ $total }}</span></li>
                                            </ul>
                                        <a class="edu-border-btn" href="{{ URL('checkout'  ) }}">{{  trans('cart_trans.cart_process') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endguest
                        @endif


                    </div>
                    @if(!count($cart))
                        <div class="row" >
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">


                                    <h2> لم يتم إضافة كورسات إلى السلة </h2>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Cart Area End-->

    </main>

@endsection





@section('js')



@endsection


