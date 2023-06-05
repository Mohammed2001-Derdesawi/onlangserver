@extends('user.master')

@section('title')
{{trans('header_trans.teachers')}}
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content=" education,online courses,best online courses,courses,education course,distance education courses,coursera courses,education course tips,free courses on coursera with certificates,free online courses,physical education course,physical education courses after plus two,online education,coursera,after plus two physical education course,early childhood education course in india,free courses,sell online courses,course,free online courses with certificates, لغات,تعليم,تعليم لغة,كيف اتعلم اللغة الانجليزية,كيف تتعلم اللغات,اللغات,نصائح لتعلّم اللغات,اتعلم لغة,كيف تتعلم اللغات بسهولة,تعلم لغات البرمجة,نصائح لتعلم اللغات بسهولة,تعلم اللغات,أفضل 9 تطبيقات لتعلم اللغات,التعليم,كيف اتعلم لغة,افضل التطبيقات لتعلم اللغات,ازاي اتعلم لغه,ازاي اتعلم لغة,اتعلم,كورس شامل لتعلم اللغة الانجليزية,أسهل 10 لغات للتعلّم,أهم 10 لغات لتعلّمها,تعليم اللغة العربية,كيف تتعلم اللغة الانجليزية,أسرار تعلم اللغات لغات , لغة , ترجمة , لغة تركية , لغة صينية , لغة انجلزية , تعلمي ,تعليمية , لغات , تعليم اون لاين ,دورات تعليمية,دورات,دورات تدريبية,دوبلاج دورات تعليمية,دورات تعليمية مجانية,كيفية عمل دورات اون لاين,بيع دورات تدريبية,تعليم,دورة تعليمية,اعداد الدورات التعليمية عبر الانترنت,تعليمية,ابغى اسوي دورات,دورات تعلم الإنجليزية,بيع الدورات,كورسات تعليم اللغة الانجليزية كاملة,مواقع تعليمية,بيع الدورات التدريبية,تصميم منصة دورات تدريبية,دورات تدريب,فيديوهات ىتعليمية,دورات مجانية,دورات على الانترنت,دورات تدريبيه,أفكار دورات تدريبية,إعداد دورات تدريبية,">

@endsection
@section('content')
<main style="margin-top: 100px">
    <div class=" container difinationaffiliate" style="margin-top:120px">
        <div class="imgaffilliate">


        </div>
    </div>
    <section class="member-area pt-125 pb-90">
        <div class="container">
           <div class="row">
            @foreach ($PrivateTeachers as $teacher )

              <div class="col-xl-3 col-lg-4 col-md-6">
                 <div class="member-main-wrapper mb-30">
                    <div class="member-body text-center">
                       <div class="member-item">
                          <div class="member-thumb">
                            @if(App::getLocale() == 'ar')

                             <a href="{{ route('user.showPrivateTeacher' ,$teacher->slug ) }}" class="img-teacher"><img src="{{asset($teacher->image)}}"
                                   alt="member-img"></a>
                                   @else
                             <a href="{{ route('user.showPrivateTeacher' ,$teacher->slug ) }}" class="img-teacher"><img  src="{{asset($teacher->image)}}"
                                    alt="member-img">
                                  </a>
                                  @endif
                          </div>
                          <div class="member-content">
                            @if(App::getLocale() == 'ar')

                            <h4><a href="{{ route('user.showPrivateTeacher' ,$teacher->slug ) }}">{{$teacher->name_ar}}</a>
                                @else
                                <h4><a href="{{ route('user.showPrivateTeacher' ,$teacher->slug ) }}">{{$teacher->name_en}}</a>
                                @endif
                            </h4>
                         </div>

                       </div>
                    </div>
                    <div class="member-meta">
                       <div class="member-reating">
                          <i class="fas fa-star"></i>
                          <span>4.8 (54k+)</span>
                       </div>
                       <div class="member-course">
                          <i class="flaticon-computer"></i><a href="#"><span>12 Courses</span></a>
                       </div>
                    </div>
                 </div>
              </div>

              @endforeach



           </div>
        </div>
     </section>
 </main>







@endsection

@section('js')



@endsection


