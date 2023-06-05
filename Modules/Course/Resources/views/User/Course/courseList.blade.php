@extends('user.master')

@section('title')
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content=" education,online courses,best online courses,courses,education course,distance education courses,coursera courses,education course tips,free courses on coursera with certificates,free online courses,physical education course,physical education courses after plus two,online education,coursera,after plus two physical education course,early childhood education course in india,free courses,sell online courses,course,free online courses with certificates,لغات,تعليم,تعليم لغة,كيف اتعلم اللغة الانجليزية,كيف تتعلم اللغات,اللغات,نصائح لتعلّم اللغات,اتعلم لغة,كيف تتعلم اللغات بسهولة,تعلم لغات البرمجة,نصائح لتعلم اللغات بسهولة,تعلم اللغات,أفضل 9 تطبيقات لتعلم اللغات,التعليم,كيف اتعلم لغة,افضل التطبيقات لتعلم اللغات,ازاي اتعلم لغه,ازاي اتعلم لغة,اتعلم,كورس شامل لتعلم اللغة الانجليزية,أسهل 10 لغات للتعلّم,أهم 10 لغات لتعلّمها,تعليم اللغة العربية,كيف تتعلم اللغة الانجليزية,أسرار تعلم اللغات لغات , لغة , ترجمة , لغة تركية , لغة صينية , لغة انجلزية , تعلمي ,تعليمية , لغات , تعليم اون لاين ,دورات تعليمية,دورات,دورات تدريبية,دوبلاج دورات تعليمية,دورات تعليمية مجانية,كيفية عمل دورات اون لاين,بيع دورات تدريبية,تعليم,دورة تعليمية,اعداد الدورات التعليمية عبر الانترنت,تعليمية,ابغى اسوي دورات,دورات تعلم الإنجليزية,بيع الدورات,كورسات تعليم اللغة الانجليزية كاملة,مواقع تعليمية,بيع الدورات التدريبية,تصميم منصة دورات تدريبية,دورات تدريب,فيديوهات ىتعليمية,دورات مجانية,دورات على الانترنت,دورات تدريبيه,أفكار دورات تدريبية,إعداد دورات تدريبية,">

@endsection
@section('content')
<main style="margin-top:170px" >

    <button class="show-menu d-lg-none">
        <i class="fas fa-stream"></i>
    </button>

    <div class="video-main-content container-fluid">
        <div class="sidebar d-none d-lg-block">
            @include('course::User.Playlist.sidebarComponent')

        </div>

       <div class="row">
        <div class="col-lg-12">
            <div class="all-videos">
                @foreach ( $allcourses   as $course )

                <div class="one-videos">
                    <a  href="{{ route('user.courseDetails' , $course->slug ) }}"
                        >
                        <img src="{{ asset($course->image) }}" class="video-img" alt="">
                    </a>

                    <div class="details-video">
                        <div>
                            <a href="#">
                                <img src="assets/img/course/academic-tutor-1.png" alt="">
                            </a>

                        </div>

                        <a href="#">
                            @if (App::getLocale() == 'en')
                            <h6>    <a  href="{{ route('user.courseDetails' , $course->slug ) }}"
                                >   {{ $course->title_en }} </a></h6>

                            @else
                            <h6>   <a  href="{{ route('user.courseDetails' , $course->slug ) }}"
                                >{{ $course->title_ar }} </a></h6>

                            @endif



                        </a>
                        <button class="video-menu-button">
                            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        </button>


                    </div>
                    <div class="other-details">
                        <span>40 subscribers</span>
                        <span>700 views</span>
                        <span>7 hours ago</span>
                    </div>

                    @if ($course->type == 'paid')

                    <div class="buyoperation">
                        <span class="cost">{{ $course->price }}$</span>
                        <button type="submit" class="btn btn-primary mb-2" onclick="AddOneToCart({{ $course->id }})"> {{ trans('course_list_trans.addtocart') }} </button>

                    </div>
                    @endif


                    @if ($course->type == 'free')

                    <div class="buyoperation">
                        <span class="cost">0$</span>
                        <button type="submit" class="btn btn-primary mb-2" >  {{ trans('course_list_trans.free') }} </button>

                    </div>
                    @endif


                </div>
                @endforeach








            </div>


        </div>
       </div>




    </div>

    <!-- End Section Six -->




















        </main>
        <div class="col-lg-12 text-center">
            <div >
                {{ $allcourses->links('vendor.pagination.tailwind') }}
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
    function AddOneToCart(id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                id:id,
            },

            url: "/cart/data/course/store/",
            success:function(data){


                let icon='success'
                if(data.error)
                {
                    icon='error'

                }

              // Start Message
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: icon,
                showConfirmButton: false,
                timer: 4000
              })

                var cart= $('#cart_number')
                cart.html(data.cart_count)
                console.log(cart)


          if ($.isEmptyObject(data.error)) {
              Toast.fire({
                  type: icon,
                  title: data.success?data.success:data.error
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


