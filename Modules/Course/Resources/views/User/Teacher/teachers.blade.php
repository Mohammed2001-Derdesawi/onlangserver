@extends('user.master')

@section('title')
{{trans('header_trans.teachers')}}
@endsection

@section('css')
@endsection
@section('content')
<main>
    <div class=" container difinationaffiliate" style="margin-top:70px">
        <div class="imgaffilliate">


        </div>
    </div>
    <section class="member-area pt-125 pb-90">
        <div class="container">
           <div class="row">
            @foreach ($teachers as $teacher )

              <div class="col-xl-3 col-lg-4 col-md-6">
                 <div class="member-main-wrapper mb-30">
                    <div class="member-body text-center">
                       <div class="member-item">
                          <div class="member-thumb">
                            @if(App::getLocale() == 'ar')

                             <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}" class="img-teacher"><img src="{{asset($teacher->image)}}"
                                   alt="member-img"></a>
                                   @else
                             <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}" class="img-teacher"><img  src="{{asset($teacher->image)}}"
                                    alt="member-img">
                                  </a>
                                  @endif
                          </div>
                          <div class="member-content">
                            @if(App::getLocale() == 'ar')

                            <h4><a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">{{$teacher->name_ar}}</a>
                                @else
                                <h4><a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">{{$teacher->name_en}}</a>
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


