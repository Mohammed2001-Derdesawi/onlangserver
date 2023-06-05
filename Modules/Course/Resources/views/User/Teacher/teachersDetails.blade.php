@extends('user.master')

@section('title')
{{trans('header_trans.teachers')}}

@endsection

@section('css')
@endsection
@section('content')

<main>
    <!-- hero-area-start -->
    <div class="hero-arera course-item-height" data-background="{{ asset('assets/user/img/slider/course-slider.jpg') }}">
       <div class="container">
          <div class="row">
             <div class="col-xl-12">
                <div class="hero-course-1-text">
                   <h2>{{trans('header_trans.teachers')}}</h2>
                </div>
                <div class="course-title-breadcrumb">
                   <nav>
                      <ol class="breadcrumb" style="background: none">
                        <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{trans('header_trans.home')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{trans('header_trans.teachers')}}</li>

                        {{--  @if(App::getLocale() == 'ar')

                          <li class="breadcrumb-item active" aria-current="page"><h4 style="font-weight:100 ;font-size:15px;paddibg-bottom:20px">{{ $Teachers->name_ar }}</h4></li>
                            @else
                            <li class="breadcrumb-item active" aria-current="page"><h4 style="font-weight:100 ;font-size:15px;paddibg-bottom:20px">{{ $Teachers->name_en }}</h4></li>
                            @endif  --}}
                         </li>
                      </ol>
                   </nav>
                </div>
             </div>
          </div>
       </div>
    </div>
    @php

    $poster = str_replace( '\\', '/', asset($Teachers->image) );

@endphp
    <!-- hero-area-end -->
    <!-- course-detailes-area-start -->
    <div class="course-detalies-area pt-120 pb-100">
       <div class="container">
          <div class="row">
             <div class="col-xl-3 col-lg-3">
                <div class="course-instructors-img mb-30" style="margin-right:40px ">
                   <img  style="border-radius:40px   " src="{{ asset($poster) }}" alt="nstructors-img">
                </div>
             </div>
             <div class="col-xl-8 col-lg-9">
                <div class="course-detelies-wrapper">
                   <div class="course-detiles-tittle mb-30">
                    @if(App::getLocale() == 'ar')

                 <h3>{{ $Teachers->name_ar }}</h3>
                      @else
                   <h3>{{ $Teachers->name_en }}</h3>
                      @endif                   </div>
                   <div class="course-detiles-meta">

                      <div class="student course">
                        @if(App::getLocale() == 'ar')

                         <span>عدد الطلاب</span>
                         @else
                         <span>Students</span>
@endif
                         <label>{{ 100 }}</label>
                      </div>
                      <div class="review-course">
                        @if(App::getLocale() == 'ar')

                        <span>اراء الطلاب </span>
                        @else
                        <span>Review</span>

@endif                         <div class="review-course-inner d-flex">
                            <ul>
                               <li><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                            <p>4.9 (540)</p>
                         </div>
                      </div>
                      <div class="course-details-action">

                         <div class="course-share">
                            <a href="#" class="share-btn"><i class="far fa-share-alt"></i></a>
                         </div>
                      </div>
                   </div>
                   <div class="blog-meta" style="display: flex;justify-content:center">
                    @php




                            $poster = str_replace( '\\', '/', asset($Teachers->image) );

                  @endphp
                    <smartvideo width="1486" poster="{{ $poster }}" height="856" class="swarm-fluid" controls playsinline
                                src="{{ $Teachers->preview_video }}">
                    </smartvideo>

                </div>
                   <div class="course-bio-text pt-45 pb-20">
                      <h3>{{trans('main_trans.teacherdescription')}}</h3>
                      @if(App::getLocale() == 'ar')

                      <p> {!! $Teachers->description_ar !!}</p>
                    @else
                    <p> {!! $Teachers->description_en !!}</p>
                    @endif
                     </div>



                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- course-detailes-area- end -->
 </main>

@endsection

@section('js')

<script data-cfasync="false">
    var swarmoptions = {
        swarmcdnkey: "d0474def-2c8e-4cc2-99bf-80504a2846d2",
        iframeReplacement: "iframe",
        autoreplace: {
            youtube: true
        }
    };
</script>
<script async data-cfasync="false" src="https://assets.swarmcdn.com/cross/swarmdetect.js"></script>


@endsection


