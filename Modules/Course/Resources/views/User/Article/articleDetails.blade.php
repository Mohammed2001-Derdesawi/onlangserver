@extends('user.master')

@section('title')
{{ trans('article_trans.title') }}
@endsection

@section('css')
{{--  <meta property="og:url"           content="{{route('show.article',$article_details->id)}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="OnLanguage" />
@if (App::getLocale() == 'ar')
<meta property="og:description"   content="{{$article_details->description_ar}}" />
@else
<meta property="og:description"   content="{{$article_details->description_en}}" />

@endif

<meta property="og:image"         content="{{asset($article_details->image)}}" />  --}}
 <style>
@media (max-width: 767px){
    
    .article-content {
        margin: auto;
    }
    .reaction{
        text-align:center;
    }
    
    
    
}
  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

.swiper {
    margin-left: auto;
    margin-right: auto;
  }

  @media (max-width:767px) {

    .sidebar-article{ background-color: #010a2e;
     padding: 20px;
     border-radius: 20px;
     height: 500px;
     margin: auto;
     width:80%;
     overflow-y: auto;}
     .related-article{
           text-align: center
     }
 }
 </style>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9321767759876601"
     crossorigin="anonymous"></script>

@endsection
@section('content')

 <main     style="margin-top: 117px";
 >



 <div class="shape-5 related" style="top:600px">
        <a href="{{ route('user.paidPlayList')  }}" >
          <h5>
              {{ trans('article_trans.paid') }}
            </h5>
        </a>

    </div>
    <!-- Start Section One -->


        </div>
    </section>

    @if (App::getLocale() == 'ar')
    <h3 class="titleonearticle">{{ $article_details->title_ar }}</h3>
    @else
    <h3 class="titleonearticle">{{ $article_details->title_en }}</h3>
    @endif
    <div class="container container-aticles">
        @foreach ($article_details->attachments as $attachment)

        <div class="panel" style="background-image: url({{ asset('/'.str_replace( '\\', '/', $attachment->path )) }})">
            <h3>{{ $attachment->description_en }}</h3>
        </div>

        @endforeach

      </div>

      <div class="container">
        <div class="article-all">
            <div class="article-content" style="max-width:75%">
                @if (App::getLocale() == 'ar')
                <h4>{{ $article_details->title_ar }}</h4>
                @else
                <h4>{{ $article_details->title_en }}</h4>
                @endif


                @if (App::getLocale() == 'ar')
                <p>{!! $article_details->description_ar !!}</p>
                @else
                <p>{!! $article_details->description_en !!}</p>
                @endif







                <div class="reaction">

                    <!-- Button trigger modal -->
                    <button  id="button2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-share"></i>
                      </button>


                    <button class="dislike">
                        <i class="fas fa-thumbs-down" id="button2"></i>
                     </button>
                    <button class="like" >
                        <i class="fas fa-heart heart" id="button1"></i>
                     </button>

                </div>
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
                        @auth
                        <div class="comments">
                            <h6>{{ count( $article_details->reviews) }} {{ trans('article_trans.reviews') }}</h6>
                            <div class="other-comments" >
                                @foreach( $article_details->reviews as $review)
                      <div style="mrgin-top:5px">
                                <span>   <i  style="  font-size: 30px"  class="far fa-user-circle	"></i>
                                    {{$review->name}}</span>
                                <p> {{ $review->review }}</p>
                            </div>
                                @endforeach


                            </div>

                              <form action="{{ route('user.article.review' ,$article_details->id ) }}" method="post">
                                @csrf

                                <textarea required name="review" placeholder="اكنب النا رأيك ف المقالة"
                                class="comment-input comment-textarea mb-20"></textarea>
                            <div class="comment-submit">
                                <button type="submit" class="edu-btn">ارسال</button>
                            </div>
                            </form>


                        </div>
                       @endauth
            </div>

            <div>

            </div>

            <div class="sidebar-article">
                @foreach ( $Recents as $recentAticle )

                <div class="related-article">
                    <a href="#">
                        <a href="{{  route('user.showArticle' ,$recentAticle->slug)}}"><img  width="200px" src="{{ asset( $recentAticle->image) }}"> </a>
                            <div class="article-details">
                            @if (App::getLocale() == 'ar')

                            <div class="eduman-course-text">
                               <h6><a href="{{  route('user.showArticle' ,$recentAticle->slug)}}">{{ $recentAticle->title_ar}} </a></h6>
                            </div>
                            @else
                            <div class="eduman-course-text">
                             <h6><a href="{{  route('user.showArticle' ,$recentAticle->slug)}}"> {{ $recentAticle->title_en }} </a></h6>
                          </div>
                           @endif

                        </div>
                    </a>

                </div>
                @endforeach


            </div>


        </div>




        </div>

    <!-- End Section Six -->




















        </main>

@endsection





@section('js')
<script>
function Share(share)
{
    switch(share)
    {
        case "facebook":
            window.open("https://www.facebook.com/sharer/sharer.php?u={{route('user.showArticle',$article_details->slug)}}&text={{$article_details->title_en}}")
            break;
            case "twitter":
            window.open("https://twitter.com/intent/tweet?url={{route('user.showArticle',$article_details->slug)}}")
            break;
            case "whatsapp":
            window.open("https://wa.me/?text={{route('user.showArticle',$article_details->slug)}}")
            case "instagram":
            window.open("https://instagram.com/share/{{$article_details->id}}")
            break;

    }

}
</script>
<script>
    function copyToClipboard() {
      const input = document.getElementById("copyLinkInput");
      input.select();
      document.execCommand("copy");
      alert("تم نسخ رابط المقالة ");

    }
    $(document).ready(function(){
    $('img').on('contextmenu', function(e){
        e.preventDefault();
        alert("Downloading images is not allowed on this website.");
    });
});
    
    $(document).ready(function(){
    $('body').bind('cut copy paste', function(e){
        e.preventDefault();
        alert("Copying text is not allowed on this website.");
    });
});

    </script>
@endsection


