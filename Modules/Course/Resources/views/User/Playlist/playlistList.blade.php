@extends('user.master')

@section('title')
{{ $playlist->title }}
@endsection

@section('css')
@endsection
@section('content')
<main style="margin-top: 120px">

    <!-- Start Section One -->

    <button class="show-menu d-lg-none">
        <i class="fas fa-stream"></i>
    </button>
    <div class="video-main-content container-fluid">
        <div class="sidebar d-none d-lg-block">
            @include('course::User.Playlist.sidebarComponent')

        </div>
        <div class="all-videos">


            <div class="one-videos myplaylist-1">
                <a>
                    <img style="margin-right: 61px;" width="300px" src="{{ asset('assets/user/img/logo/main_logo.png')}}" alt="">

                </a>



                <div class="details-video">


                    <a href="#">
                        <h6 id="playlist_title_header" style="font-size: 20px">{{ $playlist->title }}</h6>

                    </a>

                    <div class="video-menu-navigation">
                        <div class="video-menu-buttons">




                        </div>

                    </div>
                            <form method="post" action="{{ route('user.playlist.delete' ,  $playlist->id  ) }}">
                                    @csrf
                                    <button type="submit" style="font-size: 12px">
                                        <svg style="
                                        width: 30px;
                                    " viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M128 192v640h768V320H485.76L357.504 192H128zm-32-64h287.872l128.384 128H928a32 32 0 0 1 32 32v576a32 32 0 0 1-32 32H96a32 32 0 0 1-32-32V160a32 32 0 0 1 32-32zm370.752 448-90.496-90.496 45.248-45.248L512 530.752l90.496-90.496 45.248 45.248L557.248 576l90.496 90.496-45.248 45.248L512 621.248l-90.496 90.496-45.248-45.248L466.752 576z"/></svg>             حذف قائمة التشغيل 
                                    </button>
                                     </form>

                </div>

                <div>
                    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary change-name" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fas fa-edit"></i></button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">تغيير اسم قائمة التشغيل</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body change-name-content">
      <input type="text" id="playlist_name" value="{{ $playlist->title }}" class="form-control">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="updatePlayList()">Save</button>
    </div>
    </div>
    </div>
    </div>
                </div>

            </div>
            <div class="more-videos overflow-auto" style="
            max-width: 450px;
            margin-top: 21px;
            margin-right: 100px; ">
                @foreach ( $myplaylistVideos as $playlistvideo )
              @if($playlistvideo->video)
                <div class="onevideo mb-4">
                    <img style="border-radius: 10px"  width="220px" src="{{ asset($playlistvideo->video->poster) }}">

                    <div class="sidedetails" style="display: flex;">


                        <a href="#">


                        @if (App::getLocale() == 'en')

                            @if($playlistvideo->video->type == 'free' )
                            <h6>    <a  href="{{ route('user.show.playlist.video' ,[$playlist->id , $playlistvideo->video->id]) }}">   {{ $playlistvideo->video->title_en }} </a>

                            </h6>
                            <form method="post" action="{{ route('user.remove.from.playlist' ,  [$playlist->id , $playlistvideo->video->id] ) }}">
                                @csrf

                                <button type="submit">
                             <i  style="margin-left:15px;margin-right:15px;color:red  "  class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                                 </form>
                            @else
                            <h6>    <a  href="{{ route('user.show.playlist.video' , [$playlist->id , $playlistvideo->video->id]) }}">   {{ $playlistvideo->video->title_en }} </a>

                            </h6>
                            <form method="post" action="{{ route('user.remove.from.playlist' ,  [$playlist->id , $playlistvideo->video->id] ) }}">
                                @csrf

                                <button type="submit">
                             <i  style="margin-left:15px;margin-right:15px;color:red  "  class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                                 </form>

                            @endif

                        @endif

                        @if (App::getLocale() == 'ar')


                            @if($playlistvideo->video->type == 'free')

                            <h6>    <a  href="{{ route('user.show.playlist.video' , [$playlist->id , $playlistvideo->video->id] ) }}" >   {{ $playlistvideo->video->title_ar }} </a>


                            </h6>
                            <form method="post" action="{{ route('user.remove.from.playlist' ,  [$playlistvideo->id , $playlistvideo->video->id] ) }}">
                                @csrf

                                <button type="submit">
                             <i  style="margin-left:15px;margin-right:15px;color:red  "  class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                                 </form>

                            @else

                            <h6>    <a  href="{{ route('user.show.playlist.video' ,[$playlist->id , $playlistvideo->video->id] ) }}" >   {{ $playlistvideo->video->title_ar }} </a>


                            </h6>
                            <form method="post" action="{{ route('user.remove.from.playlist' ,  [$playlist->id , $playlistvideo->video->id] ) }}">
                                @csrf

                                <button type="submit">
                             <i  style="margin-left:15px;margin-right:15px;color:red  "  class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                                 </form>
                            @endif

                        @endif
                    </a>


                    </div>

                </div>
                @endif

            @endforeach
              </div>






        </div>

    </div>

    <!-- End Section Six -->


















        </main>


@endsection





@section('js')

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }

    })
    function updatePlayList(){
        var name=$("#playlist_name")
        var playlist="{{ $playlist->id }}";

        if(!name.val())
        return alert('The name is required');
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                title:name.val(),
            },

            url: "/my/Playlist/update/"+playlist,
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




          if ($.isEmptyObject(data.error)) {
              Toast.fire({
                  type: icon,
                  title: data.success?data.success:data.error
              })
              name.val(data.title)
              var playlist_title_header=$("#playlist_title_header")
              playlist_title_header.html(data.title)
          }else{
              Toast.fire({
                  type: 'error',
                  title: data.error
              })
          }



            }
    })

    }


</script>





@endsection


