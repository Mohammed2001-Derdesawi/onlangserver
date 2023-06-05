
    @extends('user.master')

    @section('title')
        {{ trans('header_trans.my_courses')  }}
    @endsection

    @section('content')



        <!-- hero-area-start -->
        <div class="hero-arera course-item-height"  data-background="{{ asset('assets/user/img/slider/course-slider.jpg')}} ">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-course-1-text">
                            <h2>{{ trans('header_trans.my_courses')  }}</h2>
                        </div>
                        <div class="course-title-breadcrumb">
                            <nav>
                                <ol class="breadcrumb"  style="background: none">
                                    <li class="breadcrumb-item"><a href="{{ URL('/') }} ">{{ trans('header_trans.home')  }}</a></li>
                                    <li class="breadcrumb-item"><span>{{ trans('header_trans.my_courses')  }}</span></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero-area-end -->


        <!-- course-barup-area-end -->
    @if( count($courses))
        <!-- course-content-start -->
        <section class="course-content-area pb-90">
            <div class="container">
                <div class="row mb-10">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row" style="margin-top:20px ">

                            @foreach($courses as $course)

                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="course-wrapper-2 mb-30">
                                        <div class="student-course-img">
                                            <img  style="cursor:pointer;" width="255px" height="205px" src="{{ asset($course->image) }}" alt="courde-img">
                                        </div>
                                        <div class="student-course-footer">
                                            <div class="student-course-text">
                                                <h3>

                                                    @if (App::getLocale() == 'en')
                                                    <h6>    <a  href="{{ route('user.courseDetails' , $course->slug ) }}"
                                                        >   {{ $course->title_en }} </a></h6>

                                                    @else
                                                    <h6>   <a  href="{{ route('user.courseDetails' , $course->slug ) }}"
                                                        >{{ $course->title_ar }} </a></h6>

                                                    @endif

                                                </h3>
                                            </div>
                                            <div class="student-course-linkter">
                                                <div class="course-lessons">

                                                    <span class="ms-2">{{$course->lec_count}} Lessons</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    </div>
@else
                    <div class="row" >
                        <div class="col-md-5 ml-auto" style="text-align: center;margin:50px">
                            <div class="cart-page-total">


                                <h2> لم يتم إضافة كورسات إلى قائمة دوراتي التدريبية  </h2>

                            </div>
                        </div>
                    </div>
@endif
                </div>
            </div>
        </section>
        <!-- course-content-end -->


    @endsection





@section('js')



@endsection


