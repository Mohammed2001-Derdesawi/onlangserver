@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
@endsection
@section('content')
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
              <div class="col-xl-3 col-lg-3">
                 <div class="course-instructors-img mb-30">
                    <img src="{{ asset( auth()->user()->image ) }}" alt="nstructors-img">
                 </div>
              </div>
              <div class="col-xl-8 col-lg-9">
                 <div class="course-detelies-wrapper">
                    <div class="course-detiles-tittle mb-30">
                       <h3>{{  auth()->user()->name }}</h3>
                    </div>
                    @php
                        $user = auth()->user();
                    $user_courses =  $user? $user->courses->pluck('id')->toArray():[];
                    @endphp
                    <div class="course-detiles-meta">
                       <div class="total-course">
                          <a>
                             <span>{{ trans('myProfile_trans.reg') }}</span>

                          <label>{{ count($user_courses) }}</label>
                          </a>

                       </div>
                       <div class="student course">
                          <span>{{ trans('myProfile_trans.liked') }}</span>
                          @if ($likedCourse)
                          <label>{{count($likedCourse)}}</label>
                          @endif
                       </div>
                       @if($user->wallet)

                       <div class="review-course">
                          <span>{{ trans('myProfile_trans.affiliateMoney')}}</span>
                          <div class="review-course-inner d-flex">

                             <p>{{ $user->wallet->total }} $ </p>
                          </div>
                       </div>
                       @endif

                    </div>




                 </div>
              </div>
           </div>
        </div>
     </div>


















    </main>

@endsection





@section('js')



@endsection


