@extends('user.master')

@section('title')
    {{trans('header_trans.about_us')}}
@endsection

@section('css')
@endsection
@section('content')
@php
$settings=cache()->get('settings') && isset(cache()->get('settings')['aboutus'])?cache()->get('settings')['aboutus']:config('front_settings.aboutus');
@endphp

    <main>
        <!-- hero-area-start -->
        <div class="hero-arera course-item-height" data-background="{{ asset('assets/user/img/slider/course-slider.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-course-1-text">
                            <h2>    {{trans('header_trans.about_us')}}
                            </h2>
                        </div>
                        <div class="course-title-breadcrumb">
                            <nav>
                                <ol class="breadcrumb" style="background: none">
                                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">    {{trans('header_trans.home')}}
                                        </a></li>
                                    <li class="breadcrumb-item"><span>    {{trans('header_trans.about_us')}}
</span></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero-area-end -->

        <!-- student-choose-area start -->
        <div class="student-choose-area fix pt-110 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5">
                        <div class="student-wrapper mb-30">

                            <div class="section-title mb-30">
                                    <h2>  {{ $settings["first_section"][app()->getLocale()]['title']  }}</h2>

                            </div>
                            <div class="sitdent-choose-content">
                                {!! $settings["first_section"][app()->getLocale()]['description'] !!}
                            </div>

                            <div class="student-choose-list">
                                <ul>

                                @foreach($settings["first_section"][app()->getLocale()]['feachers'] as $feacher)

                                <li><i class="fas fa-check-circle"></i> {{ $feacher }} </li>
                                @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="student-wrapper position-relative">
                            <div class="shap-01">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="student-choose-wrapper position-relative mb-30">
                            <div class="shap-02">
                            </div>
                            <div class="shap-03">
                                <img src="{{ asset('assets/user/img/shape/student-shape-03.png')}}" alt="image not found">
                            </div>
                            <div class="shap-04">
                                <img src="{{ asset('assets/user/img/shape/student-shape-04.png')}}" alt="image not found">
                            </div>
                            <div class="shap-05">
                                <img src="{{ asset('assets/user/img/shape/student-shape-05.png')}}" alt="image not found">
                            </div>
                            <div class="shap-06">
                                <img src="{{ asset('assets/user/img/shape/student-shape-06.png')}}" alt="image not found">
                            </div>
                            <div class="shap-07">
                                <img src="{{ asset('assets/user/img/shape/student-shape-07.png')}}" alt="image not found">
                            </div>

                            <div class="student-choose-thumb">
                                <img src="{{ asset( $settings['first_section'][app()->getLocale()]['photo'] ) }}" alt="image not found">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- student-choose-area end -->



        <!-- counter-area start -->
        <!-- counter-area start -->
        <div class="know-us-better-area pb-90">
            <div class="container">
                <div class="know-us-border pt-110">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="section-title mb-55">

                                        <h2>{{ $settings["seconed_section"][app()->getLocale()]['title'] }}</h2>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 justify-content-end">
                                    <div class="know-us-tittle mb-55">
                                        <p>
                                           {!! $settings["seconed_section"][app()->getLocale()]['description'] !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($Recents as $Recent )

                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="know-us-wrapper mb-30">
                                <div class="know-us-better-thumb">
                                    <a href="{{ route('user.showArticle' , $Recent->slug) }}"><img width="300px" height="300px" src="{{ asset($Recent->image) }}" alt=""></a>
                                </div>
                                <div class="know-us-text text-center" >


                                    @if (App::getLocale() == 'ar')

                                    <h6 class="rc__title" style="color: white"><a href="{{ route('user.showArticle' , $Recent->slug) }}">{{ $Recent->title_ar}} </a> </a></h6>
                                    @else
                                    <div class="eduman-course-text">
                                      <h6 class="rc__title" style="color: white"><a href="{{ route('user.showArticle' , $Recent->slug) }}">{{ $Recent->title_en}} </a> </a></h6>
                                  </div>
                                   @endif
                                </a>
                               </div>

                            </div>

                        </div>
@endforeach
                    </div>
                </div>
            </div>
        </div>



    </main>

@endsection


@section('js')



@endsection


