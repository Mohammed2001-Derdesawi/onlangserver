@extends('user.master')

@section('title')
    الشراء
@endsection

@section('css')

@endsection

@section('content')


    <main>
    <!-- hero-area-start -->
    <div class="hero-arera course-item-height" data-background="{{asset('assets/user/img/slider/course-slider.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-course-1-text">
                        <h2>Checkout</h2>
                    </div>
                    <div class="course-title-breadcrumb">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ URL('/') }} ">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero-area-end -->



    <!-- checkout-area start -->
    <section style="margin-top:50px;"  class="checkout-area pb-70">
        <div class="container">
                <div class="row">
                    <div class="col-lg-6" style="margin: auto">
                        <div class="your-order mb-30 " style="overflow-x: auto">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table-responsive">

                                    <thead>
                                    <tr>
                                        <th style="font-size: 20px;font-weight: bolder" class="product-name">Course Name</th>
                                        <th style="font-size: 20px;font-weight: bolder" class="product-total">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($cart as $cart_item)
                                            <td class="product-name">{{$cart_item->name}}</td>

                                        <td class="product-price"><span class="amount">${{$cart_item->price}}</span></td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>


                                    <tr class="order-total" style="border: 2px black solid;margin-top: 30px">
                                        <th >Order Total</th>

                                        @php
                                        $total =  $cart->sum('price')
                                      @endphp
                                        <td><strong><span class="amount">{{$total}} $</span></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="payment-method">

                                <div class="order-button-payment mt-20">
                                    <form method="post" action="{{ URL('payment') }}">
                                        @csrf
                                    <button  class="edu-btn" type="submit">الذهاب لعملية الشراء</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- checkout-area end -->


</main>


@endsection





@section('js')


    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
@endsection





