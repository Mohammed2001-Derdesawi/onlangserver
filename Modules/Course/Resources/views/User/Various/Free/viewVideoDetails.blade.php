@extends('user.master')

@section('title')
OnLanguage Courses
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content="فيديوهات بدون حقوق,فيديوهات بدون حقوق ملكية,فيديوهات,مدفوعة,كورسات مدفوعة مجانا,فيديوهات مجانية للمونتاج,احصل على دورات مدفوعة,تطبيقات مدفوعة مجانا,شركة مدفوعة,تحرير الفيديوهات,فيديوهات بدون حقوق نشر,كورسات مدفوعة بالمجان,تطبيقات مدفوعه,الحصول على دورات مدفوعة,برامج مدفوعة,تطبيقات مدفوعه جديده 2022,نصابين مدفوعة,فيديوهات اونلي فانز ببلاش,ابلكيشن مدفوعة,احصل على دورات مدفوعة مجانا,افكار فيديوهات بدون الظهور,فيديوهات للمونتاج بدون حقوق , educational videos for kids,blippi videos,educational videos for toddlers,education,educational,educational videos,kids educational videos,educational videos for children,kg educational videos,learning videos,educational video,kids education,kids educational video,educational video for kids,blippi educational videos for kids,preschool education videos,videos for kids,best educational videos for toddlers,educational video for children , تعليم,تطبيقات تعليم اللغات,تعليم اللغات,تعلم اللغات,لغات,تطبيق طليق لتعلم اللغات,تعلم اللغات الاجنبية,كيف تتعلم اللغة الانجليزية,تعليم scc,أكثر اللغات تعلماً,أهم لغات في العالم,تعليم الطفل,تعليم اللغة الصينية,تعليم اللغة الروسية,تعليم لغة تركية تعلم لغة تركية,تعليم الاطفال,اسهل تعليم css,تعليم اللغة الاسبانية,تطبيق تعلم اللغات,تعلم اللغات بسرعة,تعلم اللغات ابراهيم عادل,تعليم اللغة الانجليزية,تعلم اللغات بسهولة,تعلم اللغات وأنت نائم,تتعلم , تعليم الاطفال,تعليم الارقام,تعليم الحروف,تعليم,فيديوهات تعليم للاطفال,تعليم الالوان,تعليم العربية,تعليم اسماء الحيوانات,تعليم الطفل,تعليم الاشكال,تعليم الأطفال,تعليم حروف الهجاء,تعليم الطفل المسلم,تعليم اسماء الفواكه,تعليم اللغة الانجليزية,تعليم اطفال,فيديو تعليمي,تعليمي الفيديو,فيديوهات رائعة,فيديوهات اطفال,تعليم النطق للأطفال,العاب تعليمية,فديوهات,تعليم ديني,تعليم الالوان للاطفال,تعليم الألوان للأطفال,فيديوهات مفيدة للاطفال,تعليم ال">

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

      <div class="content-one-video" style="min-width: 60%">

        <smartvideo poster=" {{ asset($FreeDetails->poster) }}" class="swarm-fluid aa" controls playsinline

            src="{{ $FreeDetails->path }}">
           </smartvideo>


           @if (App::getLocale() == 'en')
           <h3>   {{  $FreeDetails->title_en }}  </h3>
                @else
                <h3>  {{  $FreeDetails->title_ar }}  </h3>
                @endif



<div style="position: relative;margin: 0px 0;padding: 11px 0;">
    <div class="reactions" style="display: flex;margin-top:0 !important;margin-left:5px !imporatnt;flex-direction: row !important;top:0 !important">          
             <span id="answer1" style="display: none;">
                <textarea rows="10" cols="115"></textarea>
                </span>



            <!-- Button trigger modal -->
            <button  style="
            font-size: 31px;
            margin-left: 16px;
        " id="button2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-share"></i>
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
      <button  onclick="likedVideos()"   class="like" >

        <i class="fas fa-heart heart" style="color:{{ $FreeDetails->liked()?'red':'' }}" id="button1"></i>
     </button>


        </div>

        </div>
        <div class="teacher-info">




            <div class="description">
               @if(App::getLocale() == 'ar')
                وصف الدورة
                <p> {!! $FreeDetails->description_ar !!}</p>
              @else
              Description:

              <p> {!! $FreeDetails->description_en !!}</p>
              @endif




               @if($FreeDetails->attachments)


                <div class="attachments">
                     <span>المرفقات</span>


                     @foreach ($FreeDetails->attachments as $attachment )

                     <div class="attach1">
                        <h6 style="width: 141px;">{{ $attachment->title }}</h6>
                        <div class="openbtn">
                            <button>Open</button>
                            <a class="btn btn-outline-info btn-sm"
                            href="{{route('user.Download.various.attachment' ,[ $FreeDetails->id , $attachment->id ])}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;{{trans('blog_trans.download')}}</a>
                        </div>

                     </div>

                     @endforeach

                </div>
                </div>
                @else
                <div class="attachments">
                    لا توجد ملفات لهذه الدورة
               </div>
                 @endif

            </div>



            @auth

            <div class="comments">
                <h6>{{ count( $FreeDetails->reviews) }} {{ trans('article_trans.reviews') }}</h6>
                <div class="other-comments">
                    @foreach( $FreeDetails->reviews as $review)

                    <span>   <i  style="  font-size: 30px"  class="far fa-user-circle	"></i>
                        {{auth()->user()->name}}</span>
                    <p> {{ $review->review }}</p>
                    @endforeach


                </div>
                  <form action="{{ route('user.various.review' ,$FreeDetails->id ) }}" method="post">
                    @csrf
                         @method('post')
                    <textarea required name="review" placeholder="Your review"
                    class="comment-input comment-textarea mb-20"></textarea>
                <div class="comment-submit">
                    <button type="submit" class="edu-btn">Submit</button>
                </div>
                </form>


            </div>
            @endauth
        </div>
      <div class="sideContent">

          <div class="more-videos notpaid">
            @if($recents)
            @foreach($recents as  $recentVideo )

            <div class="onevideo">
                <a  href="{{ route('user.freeVideoShow' ,$recentVideo->id  ) }}">
                    <img   width="200px" src="{{ asset( $recentVideo->poster) }}" ></img>

                </a>
                <div class="sidedetails">
                    @if(App::getLocale() == 'ar')
                    <a href="{{ route('user.freeVideoShow' ,$recentVideo->id  ) }}"><h5>{{ $recentVideo->title_ar }}</h5></a>

                  @else
                  <a href="{{  route('user.freeVideoShow' ,$recentVideo->id  ) }}"><h5>{{ $recentVideo->title_en }}</h5></a>

                  @endif



                </div>


            </div>
    @endforeach

@endif
          </div>
      </div>
    </div>




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

    function likedVideos(){
        var id ="{{ $FreeDetails->id }}"

        $.ajax({
            type: "post",
            dataType: 'json',

            url: "{{ route('user.liked.videos', $FreeDetails->id ) }}",
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
            window.open("https://www.facebook.com/sharer/sharer.php?u={{route('user.freeVideoShow',$FreeDetails->id)}}&text={{$FreeDetails->title_en}}")
            break;
            case "twitter":
            window.open("https://twitter.com/intent/tweet?url={{route('user.freeVideoShow',$FreeDetails->id)}}")
            break;
            case "whatsapp":
            window.open("https://wa.me/?text={{route('user.freeVideoShow',$FreeDetails->id)}}")

            break;

    }

}
</script>
<script>
    function copyToClipboard() {
      const input = document.getElementById("copyLinkInput");
      input.select();
      document.execCommand("copy");
      alert("تم نسخ رابط الفيديو ");

    }
    </script>

@endsection






