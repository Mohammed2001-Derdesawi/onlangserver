@extends('user.master')

@section('title')
OnLanguage Courses
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content="{{ $courseDetails->features }}">
 <style>
 
 
 .fa-book-open{
       animation-name: color-change;
      animation-duration: 2s;
      animation-iteration-count: infinite;
}
 
    
@keyframes color-change {
   0% {
    color: #2467ec;
  }
  50% {
    color: #0f4dc8;
  }
  100% {
    color: #ffde17;
}
}
 .reactions {
    margin-top: 29px !important;
}
    .content-one-video{max-width: 60%;
    }
    @media (max-width: 767px){
        .content-one-video{    max-width: 100%}


    }


    </style>
  @if (App::getLocale() == 'ar')

    <style>

        @media (max-width: 767px){
            div.reactions {
                position: absolute;
                top: 14% !important;
                left: 232px !important;
                width: 115px;
                height: 73px;
              }

        }
       </style>
       @endif

       @endsection
@section('content')


<main style="margin-top: 100px">

    <!-- Start Section One -->


    <button class="show-menu">
        <i class="fas fa-stream"></i>
    </button>
    <div class="video-main-content container-fluid">
        <div class="sidebar d-none">
            @include('course::User.Playlist.sidebarComponent')

        </div>

      <div class="content-one-video" >

        <smartvideo class="swarm-fluid" controls playsinline
        width="1686" height="868"
        src="{{  $courseDetails->preview_video  }}">
</smartvideo>

        @if (App::getLocale() == 'en')
        <h3>{{ $courseDetails->title_en }} </h3>

    @else
    <h3>{{ $courseDetails->title_ar }} </h3>
    @endif


        <div class="addnote">
            <!-- Button trigger modal -->

        </div>
        
       <div style="position: relative;margin: 0px 0;padding: 11px 0;">
    <div class="reactions" style="display: flex;margin-top:0 !important;margin-left:5px !imporatnt;flex-direction: row !important;top:0 !important">
            <button class="open-book" onclick="showStuff('answer1', 'text1', this); return false;" >
                <i class="fas fa-book-open"></i>
             </button>
             <span id="answer1" style="display: none;">
                <textarea rows="10" cols="115"></textarea>
                </span>



            <!-- Button trigger modal -->
            <button  style="
            font-size: 31px;
            margin-left: 16px;
        " id="button2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-share" style="color:#0f9cf3;"></i>
              </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Share</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="
              text-align: center;
          ">
                <a  onclick="Share('whatsapp')" > <i style="
                    font-size: 49px;
                    padding-right: 31px; " class="fab fa-whatsapp"></i></a>
                <a onclick="Share('facebook')" > <i style="
                    font-size: 42px;
                    padding-right: 31px;
                " class="fab fa-facebook-f"></i></a>
                <a  onclick="Share('instagram')" > <i style="
                    font-size: 42px;
                    padding-right: 31px;
                " class="fab fa-instagram"></i></a>
                <a  onclick="Share('twitter')"> <i style="
                    font-size: 42px;
                    padding-right: 31px;
                " class="fab fa-twitter"></i></a>


              </div>
              <div class="copylink">
                <input type="text" id="copyLinkInput" value="{{ url()->current() }}" placeholder="video Link Here">
                <button class="btncopy" onclick="copyToClipboard()">Copy Link</button>
              </div>
            </div>

          </div>
        </div>
      </div>
      <button class="dislike" onclick="copyToClipboard()">
        <i class="fas fa-link "></i>
     </button>
      <button id="liked_id" onclick="likedVideos( {{  $courseDetails->id  }})" class="like" >
        <i class="fas fa-heart heart" style="color:{{ $courseDetails->liked()?'red':'' }}" id="button1"></i>

</button>


        </div>

        </div>
        <div class="teacher-info">
            @foreach($courseDetails->teachers as $teacher )

            <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}"><img style="width: 79px;
                border-radius: 50%;
                height: 70px;"
                src="{{asset($teacher->image)}}"
                alt="course-meta"></a>
                <h6 style="
                display: inline-block;
            ">
             @if(App::getLocale() == 'ar')
             <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">{{$teacher->name_ar}}</a>
           @else

           <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">{{$teacher->name_en}}</a>
           @endif
                </h6>
            @endforeach

        </div>



            <div class="description">
               @if(App::getLocale() == 'ar')
                وصف الدورة
                <p> {!! $courseDetails->description_ar !!}</p>
              @else
              Description:

              <p> {!! $courseDetails->description_en !!}</p>
              @endif




               @if($courseDetails->attachment)


                <div class="attachments" id="buy">
                     <span>مرفقات</span>


                     <div class="attach1">
                        <h6 style="width: 169px;overflow: hidden;">{{ $courseDetails->attachment->title }}</h6>
                        <div class="openbtn">
                            <button class="open-book" onclick="showStuff('answer1', 'text1', this); return false;" >فتح الكتاب </button>
                            <a class="btn btn-outline-info btn-sm"
                            href="{{route('user.Download.course.attachment' ,[ $courseDetails->id , $courseDetails->attachment->id ])}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;{{trans('blog_trans.download')}}</a>

                        </div>

                     </div>
                </div>
                @else
                <div class="attachments" id="buy">
                    لا توجد ملفات لهذه الدورة
               </div>
                 @endif

            </div>

            @if(App::getLocale() == 'en')

            <div class="buynow"  >
                <button type="submit" onclick="AddOneToCart({{ $courseDetails->id }})"> Buy Now</button>
            </div>
            @else
            <div class="buynow" >
                <button type="submit" onclick="AddOneToCart({{ $courseDetails->id }})"> شراء الان</button>
            </div>
            @endif
            @auth

            <div class="comments">
                <h6>{{ count( $courseDetails->reviews) }} {{ trans('article_trans.reviews') }}</h6>

                <div class="other-comments">
                    @foreach( $courseDetails->reviews as $review)

                    <span>   <i  style="  font-size: 30px"  class="far fa-user-circle	"></i>
                        {{auth()->user()->name}}</span>
                    <p> {{ $review->review }}</p>
                    @endforeach


                </div>

                  <form action="{{ route('user.course.review' ,$courseDetails->id ) }}" method="post">
                    @csrf
                         @method('post')
                    <textarea required name="review" placeholder="Your review"
                    class="comment-input comment-textarea mb-20"></textarea>
                <div class="comment-submit">
                    <button type="submit" class="edu-btn">ارسال</button>
                </div>
                </form>


            </div>
            @endauth
      </div>
      <div class="sideContent">
        <div >
            @if($courseDetails->attachment)
            <iframe class="myIframe" id="myFrame" src="{{ asset($courseDetails->attachment->path) }}" frameborder="0" allow="fullscreen" width="100%">
            </iframe>
            @else
            <iframe>
            </iframe>
            @endif
            <button onclick="openFullscreen();" ><i class="fas fa-expand-arrows-alt full"></i></button>
          </div>
          <div class="more-videos notpaid">


 @php 
 $buyLecture =  in_array($courseDetails->id ,$user_courses )?true:false;
 @endphp
 
@foreach($courseDetails->lectures as  $lecture )
   @if( $lecture->type == 0 || $buyLecture == TRUE )

   <div class="onevideo">
       <a href="{{ route('user.showLecture' ,$lecture->id  ) }}">
           <img   width="200px" src="{{ asset($lecture->poster) }}" ></img>

       </a>
       <div class="sidedetails">
           @if(App::getLocale() == 'ar')
           <a href="{{ route('user.showLecture' ,$lecture->id  ) }}"><h5 style="display: flex"   >{{ $lecture->title_ar }}  <div class="locked">
        </div></h5></a>


         @else
         <a href="{{ route('user.showLecture' ,$lecture->id  ) }}"><h5 style="display: flex">{{ $lecture->title_en }}   <div class="locked">
        </div> </h5>
    </a>


         @endif

       </div>


   </div>
   @else
   <div class="onevideo">
    <a href="{{ route('user.showLecture' ,$lecture->id  ) }}" >
        <img   width="200px" src="{{ asset($lecture->poster) }}" ></img>

    </a>
    <div class="sidedetails">
        @if(App::getLocale() == 'ar')
        <a><h5  style="display: flex" >{{ $lecture->title_ar }}  <div class="locked">
            <i style="color:  red;margin-left:-13px " class="fas fa-lock"></i>
        </div> </h5></a>

       @else
      <a><h5 style="display: flex">{{ $lecture->title_en }}  <div class="locked">
        <i style="color:  red;margin-left:15px ; " class="fas fa-lock"></i>
    </div> </h5></a>

        @endif

    </div>


  </div>
  @endif
   @endforeach


          </div>
      </div>




    </div>
    <div class="related-courses container" style="width: 70%">
        <h3 style="margin: auto">دورات تدريبية مشابهة</h3>
        @foreach ( $oneRealated as $Realated )

        <div class="onevideo">
            <a  href="{{ route('user.courseDetails' , $Realated->slug ) }}"
                >
                <img src="{{ asset($Realated->image) }}" class="video-img" width="220px" alt="">
            </a>
            <div class="sidedetails">
                <a href="#">
                    @if (App::getLocale() == 'en')
                    <h6>    <a  href="{{ route('user.courseDetails' , $Realated->slug ) }}"
                        >   {{ $Realated->title_en }} </a></h6>

                    @else
                    <h6>   <a  href="{{ route('user.courseDetails' , $Realated->slug ) }}"
                        >{{ $Realated->title_ar }} </a></h6>

                    @endif

                    @foreach($Realated->teachers as $teacher )

                    <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">

                     @if(App::getLocale() == 'ar')
                     <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">{{$teacher->name_ar}}</a>
                   @else

                   <a href="{{ route('user.showTeacher' ,$teacher->slug ) }}">{{$teacher->name_en}}</a>
                   @endif
                        </h6>
                    @endforeach
                    </div>
            <div class="locked">
                <i class="fas fa-lock"></i>
            </div>

        </di
        @endforeach
        v>
      </div>


    <!-- End Section Six -->




















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
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
// Start Product View with Modal

// Eend Product View with Modal
 // Start Add To Cart Product
 function AddOneToCart(id) {
  $.ajax({
    type: "POST",
    dataType: 'json',
    data: {
      id: id,
    },
    url: "/cart/data/course/store/",
    success: function (data) {
      const Toast = Swal.mixin({
        toast: true,
        showConfirmButton: false,
        timer: 4000
      });

      var cart = $('#cart_number');
      cart.html(data.cart_count);
      console.log(cart);

      if ($.isEmptyObject(data.error)) {
        Toast.fire({
          icon: 'success',
          title: data.success ? data.success : data.error
        });
      } else {
        Toast.fire({
          icon: 'error',
          title: data.error
        });
      }
      window.location.href="https://onlanguagecourses.com/cart"
 }
});
}
  
    function likedVideos(){
        var id = "{{ $courseDetails->id }}"
        $.ajax({
            type: "post",
            dataType: 'json',

            url: "{{ route('user.courses.liked.videos', $courseDetails->id ) }}",
            success:function(data){
                  if(data.success){
                  $('#button1').css('color','red')

                  }else{
                    $('#button1').css('color','#7e7e7e')

                  }




        }

        })
    }
// End Add To Cart Product
</script>



<script>
    function Share(share)
    {
        switch(share)
        {
            case "facebook":
                window.open("https://www.facebook.com/sharer/sharer.php?u={{route('user.courseDetails',$courseDetails->slug)}}&text={{$courseDetails->title_en}}")
                break;
                case "twitter":
                window.open("https://twitter.com/intent/tweet?url={{route('user.courseDetails',$courseDetails->slug)}}")
                break;
                case "whatsapp":
                window.open("https://wa.me/?text={{route('user.courseDetails',$courseDetails->slug)}}")

                break;

        }

    }
    </script>
    <script>
        function copyToClipboard() {
          const input = document.getElementById("copyLinkInput");
          input.select();
          document.execCommand("copy");
          alert("تم نسخ رابط الدورة التدريبية  ");

        }
        </script>
@endsection


