@extends('user.master')

@section('title')
OnLanguage Courses
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content="education,online courses,best online courses,courses,education course,distance education courses,coursera courses,education course tips,free courses on coursera with certificates,free online courses,physical education course,physical education courses after plus two,online education,coursera,after plus two physical education course,early childhood education course in india,free courses,sell online courses,course,free online courses with certificates, لغات,تعليم,تعليم لغة,كيف اتعلم اللغة الانجليزية,كيف تتعلم اللغات,اللغات,نصائح لتعلّم اللغات,اتعلم لغة,كيف تتعلم اللغات بسهولة,تعلم لغات البرمجة,نصائح لتعلم اللغات بسهولة,تعلم اللغات,أفضل 9 تطبيقات لتعلم اللغات,التعليم,كيف اتعلم لغة,افضل التطبيقات لتعلم اللغات,ازاي اتعلم لغه,ازاي اتعلم لغة,اتعلم,كورس شامل لتعلم اللغة الانجليزية,أسهل 10 لغات للتعلّم,أهم 10 لغات لتعلّمها,تعليم اللغة العربية,كيف تتعلم اللغة الانجليزية,أسرار تعلم اللغات لغات , لغة , ترجمة , لغة تركية , لغة صينية , لغة انجلزية , تعلمي ,تعليمية , لغات , تعليم اون لاين ,دورات تعليمية,دورات,دورات تدريبية,دوبلاج دورات تعليمية,دورات تعليمية مجانية,كيفية عمل دورات اون لاين,بيع دورات تدريبية,تعليم,دورة تعليمية,اعداد الدورات التعليمية عبر الانترنت,تعليمية,ابغى اسوي دورات,دورات تعلم الإنجليزية,بيع الدورات,كورسات تعليم اللغة الانجليزية كاملة,مواقع تعليمية,بيع الدورات التدريبية,تصميم منصة دورات تدريبية,دورات تدريب,فيديوهات ىتعليمية,دورات مجانية,دورات على الانترنت,دورات تدريبيه,أفكار دورات تدريبية,إعداد دورات تدريبية,">

@endsection
@section('content')
<main style="margin-top: 170px">

    <!-- Start Section One -->
    <section class="one" >

    </section>


    <button class="show-menu d-lg-none">
        <i class="fas fa-stream"></i>
    </button>

        <div class="video-main-content container-fluid">
            <div class="sidebar d-none d-lg-block">
                @include('course::User.Playlist.sidebarComponent')

            </div>

            <div class="all-videos">

             @foreach ( $languageLists   as $languageList )


                <div class="one-videos">
                    <a
                        >
                        <img  style="height:170px !important " src="{{ asset($languageList->image) }}" class="video-img" alt="">
                    </a>
                    {{--  href="{{ route('user.showCourses' , $languageList->id ) }}"  --}}

                    <a href="{{ route('user.coursesList' , $languageList->slug ) }}" >
                        <button class="playlist-button" >
                            @if (App::getLocale() == 'en')
                            <span class="playlist-label" >Open Playlist</span>

                            @else
                            <span class="playlist-label"> اضغط لرؤية جميع الدورات </span>

                            @endif

                            <br>
                            <i class="fas fa-dumbbell"></i>
                        </button>
                    </a>


                    <div class="details-video">
                        <div>
                            <a    href="{{ route('user.coursesList' , $languageList->slug ) }}"  >
                            </a>

                        </div>

                        <a >

                            @if (App::getLocale() == 'en')
               <h6>   {{  $languageList->title_en }}  </h6>
                    @else
                    <h6>  {{  $languageList->title_ar }}  </h6>
                    @endif

                            <h5 >{{ trans('course_list_trans.alllevel') }}</h5>
                        </a>
                        <button class="video-menu-button">
                            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        </button>


                    </div>
                    <div class="other-details">
                        <span>700 views</span>
                        <span>{{  $languageList->created_at->diffForHumans() }}</span>
                    </div>


                    <div class="buyoperation">

                        {{--  <span class="cost">${{ $languageList->courses_sum_price }}</span>  --}}
                        <div class="evaluation">
                            <i class="fas fa-star"></i>
                            <span>5.0</span>
                        </div>
                        <div>
                            <button type="submit"  onclick="addToCart({{ $languageList->id }})" >{{ trans('course_list_trans.addtocart') }}</button>
                        </div>
                    </div>
                    <div class="card-details">
                        @if (App::getLocale() == 'en')
                        <h3>   {{  $languageList->title_en }}  </h3>
                             @else
                             <h3>  {{  $languageList->title_ar }}  </h3>
                             @endif
                        <button type="submit" class="btn btn-primary mb-2" onclick="addToCart({{ $languageList->id }})"> {{ trans('course_list_trans.addtocart') }}</button>
                    </div>

                </div>

                @endforeach


            </div>
        </div>



    <!-- End Section Six -->




















        </main>
        <div class="col-lg-12 text-center">
            <div >
                {{ $languageLists->links('vendor.pagination.tailwind') }}
                </div>
        </div>

@endsection





@section('js')


<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
// Start Product View with Modal

// Eend Product View with Modal
 // Start Add To Cart Product
    function addToCart(id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                id:id,
            },

            url: "/cart/data/store/",
            success:function(data){

                let icon='success'
                if(data.error)
                {
                    icon='error'

                }


                    var cart= $('#cart_number')

                    console.log(cart)
                    cart.html(data.cart_count)



              // Start Message
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: icon,
                showConfirmButton: false,
                timer: 4000
              })
          if ($.isEmptyObject(data.error)) {
              Toast.fire({
                  type:icon,
                  title: data.success
              })
          }else{
              Toast.fire({
                  type: 'error',
                  title: data.error
              })
          }
          // End Message
        }

        })
    }

// End Add To Cart Product
</script>




@endsection


