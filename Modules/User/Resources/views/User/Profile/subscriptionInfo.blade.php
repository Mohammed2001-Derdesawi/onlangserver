@extends('user.master')

@section('title')
Subscription
@endsection

@section('css')
<style>
@import url('https://fonts.googleapis.com/css?family=Dancing+Script|Open+Sans|Questrial&display=swap');


body {
  background: #eaeaea;
  font-family: 'Open Sans', sans-serif;
}

.banner {
  background: rgb(232, 221, 15);
  color: white;
}

.banner, .email-content {
  padding: 2em 5em;
  overflow: hidden;
}

h1 {
  font-family: 'Questrial', sans-serif;
  font-size: 30px;
  margin: 0 0 .5em 0;
}

hr {
  margin-top: 2em;
  background: rgb(73, 73, 203);
}

a {
  text-decoration: none;
}

.sig {
  font-family: 'Dancing Script', cursive;
  font-size: 3.5em;
  margin: 0;
}

.email-container {
  background: #ffffff;
}

footer {
  text-align: center;
  margin: 0;
  padding: 1em;
}

</style>

@endsection
@section('content')
@php

$settings=cache()->get('settings') && isset(cache()->get('settings')['subscribes_page'])?cache()->get('settings')['subscribes_page']:config('front_settings.subscribes_page');
@endphp

<main  style="margin-top:117px;">

<button class="show-menu d-lg-none">
    <i class="fas fa-stream"></i>
</button>
<div class="video-main-content container-fluid">
    <div class="sidebar d-none d-lg-block">
         @include('user::User.Profile.sidebar')
    </div>
    <div class="course-detalies-area pb-100">
        <div class="container">
            <div class="row">


                @if(auth()->user()->subscribed($plan->name))
                   <main>
                    <div class="email-container">
                    <div class="email-body">
                      <div class="banner">
                        <h1 style="padding: 30px">{{ trans('myProfile_trans.Subscription') }} </h1>
                      </div>
                      <div class="email-content">
                        <p>{{ trans('myProfile_trans.hey') }} {{ auth()->user()->name }}!</p>
                        <p>{{ trans('myProfile_trans.text1') }} {{ $settings['price']}}$  {{ trans('myProfile_trans.text2') }}
                        </p>

                        <p>{{ trans('myProfile_trans.text3') }}
                            <form   action="{{ route('variouses.subscriptions.cancel') }}" method="post">
                                @csrf <button  style="text-decoration: underline"   type="submit"> 👈{{ trans('myProfile_trans.click') }}</button></form>
                        </p>

                      <hr>
                      <p>{{ trans('myProfile_trans.best') }}</p>
                      <p><em>Hothifa Ahmed </em>
                      <br> Manager</p>
                      </div>
                    </div>
                  </div>
                  </main>

                  @else



                            <h2 style="margin-top:190px" >  {{ trans('myProfile_trans.notsub') }}</h2>





                  @endif



           </div>
           </div>
        </div>


    </main>

@endsection





@section('js')



@endsection


