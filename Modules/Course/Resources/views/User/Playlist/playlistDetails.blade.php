@extends('user.master')

@section('title')
OnLanguage Courses
@endsection

@section('css')
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

            <smartvideo poster=" {{ asset($video->image) }}" class="swarm-fluid aa" controls playsinline

            src="{{ $video->preview_video }}">
           </smartvideo>


           @if (App::getLocale() == 'en')
           <h3>   {{  $video->title_en }}  </h3>
                @else
                <h3>  {{  $video->title_ar }}  </h3>
                @endif



        <div class="reactions">
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

        <i class="fas fa-heart heart" style="color:{{ $video->liked()?'red':'' }}" id="button1"></i>
     </button>



        </div>
        <div class="teacher-info">




            <div class="description">
               @if(App::getLocale() == 'ar')
                وصف الدورة
                <p> {!! $video->description_ar !!}</p>
              @else
              Description:

              <p> {!! $video->description_en !!}</p>
              @endif




               @if($video->attachments)


                <div class="attachments">
                     <span>المرفقات</span>

@foreach ($video->attachments as $attachment )

                     <div class="attach1">
                        <h6 style="width: 141px;">{{ $attachment->title }}</h6>
                        <div class="openbtn">
                            <button>Open</button>
                            <a class="btn btn-outline-info btn-sm"
                            href="{{route('user.Download.various.attachment' ,[ $video->id , $attachment->id ])}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;{{trans('blog_trans.download')}}</a>
                        </div>

                     </div>

                     @endforeach

                </div>
                @else
                <div class="attachments">
                    لا توجد ملفات لهذه الدورة
               </div>
                 @endif

            </div>



            @auth

            <div class="comments">
                <h6>{{ count( $video->reviews) }} {{ trans('article_trans.reviews') }}</h6>
                <div class="other-comments">
                    @foreach( $video->reviews as $review)

                    <span>   <i  style="  font-size: 30px"  class="far fa-user-circle	"></i>
                        {{$review->name}}</span>
                    <p> {{ $review->review }}</p>

                    @endforeach


                </div>
                  <form action="{{ route('user.various.review' ,$video->id ) }}" method="post">
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
      </div>
      <div class="sideContent">
        <div >
            <iframe class="myIframe" id="myFrame" src="https://docs.google.com/viewerng/viewer?url=http://infolab.stanford.edu/pub/papers/google.pdf&embedded=true" frameborder="0" allow="fullscreen" width="100%">
            </iframe>
            <button onclick="openFullscreen();" ><i class="fas fa-expand-arrows-alt full"></i></button>
          </div>
          <div class="more-videos notpaid">
            @if($recents)
            @foreach($recents as  $recentVideo )

            <div class="onevideo">
                <a  href="{{ route('user.freeVideoShow' ,$recentVideo->id  ) }}">
                    <img   width="200px" src="{{ asset( $recentVideo->poster) }}" ></img>

                </a>
                <div class="sidedetails">
                    @if(App::getLocale() == 'ar')
                    <a href="{{ route('user.show.playlist.video' ,[$playlist->id , $video->id] ) }}"><h5>{{ $recentVideo->title_ar }}</h5></a>

                  @else
                  <a href="{{ route('user.show.playlist.video' ,[$playlist->id , $video->id] ) }}"><h5>{{ $recentVideo->title_en }}</h5></a>

                  @endif


                    <a href="#" class="tutor"><img src="assets/img/course/academic-tutor-2.png" alt=""> Abdullallah</a>

                </div>


            </div>
    @endforeach

@endif
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
        var id ="{{ $video->id }}"

        $.ajax({
            type: "post",
            dataType: 'json',

            url: "{{ route('user.liked.videos', $video->id ) }}",
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
            window.open("https://www.facebook.com/sharer/sharer.php?u={{route('user.freeVideoShow',$video->id)}}&text={{$video->title_en}}")
            break;
            case "twitter":
            window.open("https://twitter.com/intent/tweet?url={{route('user.freeVideoShow',$video->id)}}")
            break;
            case "whatsapp":
            window.open("https://wa.me/?text={{route('user.freeVideoShow',$video->id)}}")

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






