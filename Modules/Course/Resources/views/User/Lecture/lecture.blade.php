@extends('user.master')

@section('title')
{{$Lectures->title_en }}
@endsection

@section('css')

<style>
    .notpaid {
        overflow: auto;
        scroll-behavior: smooth;
        scrollbar-width: thin; /* thin, auto or none */
  scrollbar-color: #ccc #f5f5f5; /* thumb color and track color */
      }

    .notpaid::-webkit-scrollbar-track {
      width: 10px;
      background-color: #226251;
    }


    .notpaid::-webkit-scrollbar-thumb {
      width: 10px;
      background-color: #db0808;
    }

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
</style>
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

           <smartvideo class="swarm-fluid" controls playsinline
           width="1066" height="568"
            src="{{$Lectures->path_video }}" poster="{{ asset( str_replace('\\','/',$Lectures->poster)) }}"  >
</smartvideo>


        @if (App::getLocale() == 'en')
        <h3>{{ $Lectures->title_en }} </h3>

    @else
    <h3>{{ $Lectures->title_ar }} </h3>
    @endif
    
<div style="position: relative;margin: 0px 0;padding: 11px 0;">
    <div class="reactions" style="display: flex;margin-top:0 !important;margin-left:5px !imporatnt;flex-direction: row !important;top:0 !important">
        <button class="open-book" >
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
      <div class="modal-content" style="
      margin-top: 198px;
  ">
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
        <button id="liked_id" onclick="likedVideos( {{  $Lectures->id  }})" class="like" >
             <i class="fas fa-heart heart" style="color:{{ $Lectures->liked()?'red':'' }}" id="button1"></i>

</button>


    </div>
    </div>
    <div class="description">


    @if(App::getLocale() == 'ar')
وصف المحاضرة 
<p> {!! $Lectures->description_ar !!}</p>
  @else
  Description:

  <p> {!! $Lectures->description_en !!}</p>
  @endif



  <span style="text-align: center; font-size:18px">مرفقات المحاضرة </span>


  <div class="attachments">
    @if($Lectures->course->attachment)

    <div class="attach1">
        <h6 style="width: 141px;">{{$Lectures->course->attachment->title }}</h6>

        <a class="btn btn-outline-info btn-sm"
        href="{{route('user.Download.course.attachment' ,[ $Lectures->course->id , $Lectures->course->attachment->id ])}}"
                                    role="button"><i class="fas fa-download"></i>&nbsp;{{trans('blog_trans.download')}}</a>
            </div>

            @endif
        </div>

  @foreach ($Lectures->attachments as $attachment)
   <div class="attach1">

  <h6 style="width: 141px;">{{ $attachment->title }}</h6>
  <div class="openbtn">
      <a class="btn btn-outline-info btn-sm"
      href="{{route('user.Download.lecture.attachment' ,[ $Lectures->id , $attachment->id ])}}"
                                  role="button"><i class="fas fa-download"></i>&nbsp;{{trans('blog_trans.download')}}</a>
  </div>
  </div>

  @endforeach
  <hr>



</div>





@auth
    <div class="allnotes-1">
        <div class="description my-notes">
            ملاحظاتي:

                 <ul id="note-list" >
                    @foreach($notes as $note)

                    <li>{{   $note->text }} </li>
                    @endforeach

                </ul>

        </div>
        <div class="addonenote">
            <form id="create-note-form">
                <div class="form-group">
                    <label for="note-text">ملاحظاتي:</label>
                    <textarea id="note-text" class="form-control" ></textarea>
                    <span id="note-error" class = "text-danger mt-4"></span>
                </div>
                <input type="hidden" value="{{ $Lectures->id }}" id="note-id">
                <button type="submit" class="btn btn-primary"> كتابة ملاحظة</button>
            </form>
        </div>

    </div>
@endauth

      </div>
      <div class="sideContent">

            <div >
                @if($Lectures->course->attachment)
                <iframe class="myIframe" id="myFrame" hide-toolbar="true" src="{{ asset($Lectures->course->attachment->path) }}" frameborder="0" allow="fullscreen" width="90%">
                </iframe>
                @else
                <iframe>
                </iframe>
                
                @endif
                <button onclick="openFullscreen();" ><i class="fas fa-expand-arrows-alt full"></i></button>
                     </div>
          <div class="more-videos notpaid" style="
            overflow: auto;
            scroll-behavior: smooth;
            scrollbar-width: thin;
      scrollbar-color: #d06767">
            @foreach($recentLectures as  $recentLecture )

            <div class="onevideo mb-4">
                <a href="{{ route('user.showLecture' ,$recentLecture->id  ) }}">
                    <img   width="200px" src="{{ asset( $recentLecture->poster) }}" ></img>

                </a>
                <div class="sidedetails">
                    @if(App::getLocale() == 'ar')
                    <a href="{{ route('user.showLecture' ,$recentLecture->id  ) }}"><h5>{{ $recentLecture->title_ar }}</h5></a>

                  @else
                  <a href="{{ route('user.showLecture' ,$recentLecture->id  ) }}"><h5>{{ $recentLecture->title_en }}</h5></a>

                  @endif



                </div>


            </div>
    @endforeach

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
 // Start   Cart Product

 function likedVideos(){
    var id = "{{ $Lectures->id }}"
    $.ajax({
        type: "post",
        dataType: 'json',

        url: "{{ route('user.lectures.liked.videos', $Lectures->id ) }}",
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

    $('#create-note-form').submit(function(event) {
        event.preventDefault();
        var text = $('#note-text').val();
        var id = $('#note-id').val();
        if(text!='')
        $.ajax({
            url: '{{ route('user.lecture.notes.store') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                text: text,
                id: id

            },
            success: function(response) {
                var note = response.note;
                $('#note-list').append('<li>' + note + '</li>');
                $('#note-text').val('');
            },
            error: function(response) {
                var error =response.responseJSON.errors.text[0];
                $("#note-error").html(error)


            },


        });
    });

    // Disable the note textarea while the Ajax request is being made
    $(document).ajaxStart(function() {
        $('#note-text').prop('disabled', true);
    });

    // Enable the note textarea after the Ajax request has completed
    $(document).ajaxStop(function() {
        $('#note-text').prop('disabled', false);
    });

</script>




    <script>
        function Share(share)
        {
            switch(share)
            {
                case "facebook":
                    window.open("https://www.facebook.com/sharer/sharer.php?u={{route('user.showLecture',$Lectures->id)}}&text={{$Lectures->title_en}}")
                    break;
                    case "twitter":
                    window.open("https://twitter.com/intent/tweet?url={{route('user.showLecture',$Lectures->id)}}")
                    break;
                    case "whatsapp":
                    window.open("https://wa.me/?text={{route('user.showLecture',$Lectures->id)}}")

                    break;

            }

        }
        </script>
        <script>
            function copyToClipboard() {
              const input = document.getElementById("copyLinkInput");
              input.select();
              document.execCommand("copy");
              alert("تم نسخ رابط المحاضرة ");

            }
            </script>

@endsection


