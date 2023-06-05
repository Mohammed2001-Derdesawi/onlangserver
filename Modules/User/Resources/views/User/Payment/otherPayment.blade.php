@extends('user.master')

@section('title')
Payment
@endsection

@section('css')

<style>

    .checkout-form-list input[type=number]{
            background: rgb(255 255 255);
            border: 1px solid rgb(237 238 242);
            border-radius: 0;
            height: 55px;
            line-height: 55px;
            padding: 0 0 0 20px;
            width: 100%;
            outline: none;


    }
</style>
@endsection
@section('content')

@php
$settings=cache()->get('settings') && isset(cache()->get('settings')['general_info'])?cache()->get('settings')['general_info']:config('front_settings.general_info');

@endphp

<main>
    <!-- hero-area-start -->
    <div class="hero-arera course-item-height"    data-background="    {{  asset('assets/user/img/logo/main_logo.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-course-1-text">
                        <h2> {{ trans('main_trans.spayment')}}</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- hero-area-end -->



    <!-- checkout-area start -->
    <section class="checkout-area pb-70" style="margin-top:100px; ">
        <div class="container">
            <form action="{{ route('other.payment') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-3" style="margin-top: 70px">
                        <div class="checkbox-form">
                            <h3>{{ trans('main_trans.spayment')}}</h3>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Name <span class="required">*</span></label>
                                        <input name="name" type="text" placeholder=""  required  />

                                    </div>
                                    <span class="text-danger" style="padding-bottom: 10px;">
                                        {{$errors->first("name")}}

                                    </span>                                </div>


                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>The amount you want to pay ('By Dollar') <span class="required">*</span></label>
                                        <input required  name="price" type="number" />
                                    </div>
                                    <span class="text-danger" style="padding-bottom: 10px;">
                                        {{$errors->first("price")}}

                                    </span>
                                </div>
                                <button type="submit" class="edu-btn">  {{ trans('profile.submit')}} </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="checkbox-form">
                            <div class="row" style="margin: 20px">

                                <div class="col-md-12">
                                    <img width="80%" src="{{$settings['private_payment']['photo']}}" alt="Not Found">
                          </div>
                                <div class="col-md-12">

                                </div>




                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
    <!-- checkout-area end -->


</main>





@endsection





@section('js')

     <script src="https://js.stripe.com/v3/"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

@endsection


