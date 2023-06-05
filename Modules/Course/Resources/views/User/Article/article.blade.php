@extends('user.master')

@section('title')
{{ trans('article_trans.title') }}
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
                   <h2>{{ trans('article_trans.title') }}</h2>
                </div>
                <div class="course-title-breadcrumb" style="background: none">
                   <nav>
                      <ol class="breadcrumb" style="background: none">
                         <li class="breadcrumb-item"><a href="{{ URL('/') }}">Home</a></li>
                         <li class="breadcrumb-item"><span></span></li>
                         <li class="breadcrumb-item"><a href="{{ URL('articles') }}">{{ trans('article_trans.title') }}</a></li>

                      </ol>
                   </nav>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- hero-area-end -->
    <!-- course-detailes-area-start -->
    <div class="course-detalies-area pt-120 pb-100">
       <div class="container">
          <div class="row">

             <div class="col-xl-12 col-lg-12">
                <div class="course-detelies-wrapper">

                   <div class="my-course-info">
                      <h3>{{ trans('article_trans.title') }}</h3>
                   </div>
                   <div class="row">
                    @foreach ($Articles_list as $Articles )


                      <div class="col-xl-6 col-lg-6 col-md-6 col-md-6">
                         <div class="eduman-course-main-wrapper mb-30">
                            <div class="eduman-course-img w-img">
                               <a href="{{  route('user.showArticle' ,$Articles->slug)}}"><img width="390px"  height="390px" src="{{ asset( $Articles->image) }}"
                                     alt="course-img"></a>
                            </div>
                            <div class="eduman-course-wraper">
                               <div class="eduman-course-heading">
                                  <a href="course.html" class="course-link-color-1">{{ trans('article_trans.article') }}</a>
                                  <span class="couse-star"><i class="fas fa-star"></i>5 (25)</span>
                               </div>
                               @if (App::getLocale() == 'ar')

                               <div class="eduman-course-text">
                                  <h3><a href="{{  route('user.showArticle' ,$Articles->slug)}}">{{ $Articles->title_ar}} </a></h3>
                               </div>
                               @else
                               <div class="eduman-course-text">
                                <h3><a href="{{  route('user.showArticle' ,$Articles->slug)}}"> {{ $Articles->title_en }} </a></h3>
                             </div>
                              @endif

                            </div>
                            <div class="eduman-course-footer">

                               <div class="course-deteals-btn" style="margin:auto">
                                  <a  href="{{  route('user.showArticle' ,$Articles->slug)}}"><span class="me-2">{{ trans('article_trans.readMore') }}</span><i
                                        class="far fa-arrow-right"></i></a>
                               </div>
                            </div>
                         </div>
                      </div>

                      @endforeach

                     </div>



                   </div>

                </div>
             </div>

             <div class="row" id="paginator">
                <div >
                    {{ $Articles_list->links('vendor.pagination.tailwind') }}
                    </div>
          </div>
          </div>
       </div>
    </div>
    <!-- course-detailes-area- end -->
 </main>




@endsection





@section('js')



@endsection


