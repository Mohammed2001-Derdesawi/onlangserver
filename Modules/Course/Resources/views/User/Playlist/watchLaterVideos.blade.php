@extends('user.master')

@section('title')
    الرئيسسية
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
    @foreach ( $myWatchLaters   as $myWatchLater )

    <div class="one-videos">
           @if($myWatchLater->video->type == 'free')
        <a  href="{{ route('user.freeVideoShow' , $myWatchLater->video->id ) }}" >
            <img src="{{ asset($myWatchLater->video->poster) }}" class="video-img" alt="">
        </a>
        @else

        <a  href="{{ route('user.paidVideoShow' , $myWatchLater->video->id ) }}" >
            <img src="{{ asset($myWatchLater->video->poster) }}" class="video-img" alt="">
        </a>
            @endif
        <div class="details-video">
            <div>
                <a href="#">
                    <img src="assets/img/course/academic-tutor-1.png" alt="">
                </a>

            </div>

            <a href="#">
                @if (App::getLocale() == 'en')

                @if($myWatchLater->video->type == 'free')
                <a >
                <h6 style="display: flex;padding: -2px; ">    <a  href="{{ route('user.freeVideoShow' , $myWatchLater->video->id ) }}">   {{ $myWatchLater->video->title_en }} </a>

                    <form method="post" action="{{ route('user.delete.from.watchlater' ,  $myWatchLater->video->id  ) }}" style="width: 5px;padding-left: 21px;">
                        @csrf
                        <div class="actions1">

                            <button type="submit">
                                <i  class="fa fa-trash"></i>
                                      </button>
                           </div>

                         </form>
                </h6>
            </a>

                 @else
                 <a>

                 <h6 style="display: flex;padding: -2px; ">    <a  href="{{ route('user.paidVideoShow' , $myWatchLater->video->id ) }}">   {{ $myWatchLater->video->title_ar }} </a>
                 <form method="post" action="{{ route('user.delete.from.watchlater' ,  $myWatchLater->video->id  ) }}" style="width: 5px;padding-left: 21px;" >
                    @csrf
                    <div class="actions1">

                        <button type="submit">
                            <i  class="fa fa-trash"></i>
                                  </button>
                       </div>

                     </form>
                    </h6>
                </a>
                     @endif

                @else


                @if($myWatchLater->video->type == 'free')
                <a>

                <h6 style="display: flex;padding: -2px; ">    <a  href="{{ route('user.freeVideoShow' , $myWatchLater->video->id ) }}" >   {{ $myWatchLater->video->title_ar }} </a>
                <form method="post" action="{{ route('user.delete.from.watchlater' ,  $myWatchLater->video->id  ) }}" style="width: 5px;padding-right: 65px;">
                    @csrf
                    <div class="actions1">
                        <button type="submit">
                            <i  class="fa fa-trash"></i>
                                  </button>
                       </div>

                     </form>
                    </h6>
                </a>
                 @else
                 <a>

                    <h6 style="display: flex;padding: -2px; ">    <a  href="{{ route('user.paidVideoShow' , $myWatchLater->video->id ) }}" >   {{ $myWatchLater->video->title_ar }} </a>
                    <form method="post" action="{{ route('user.delete.from.watchlater' ,  $myWatchLater->video->id  ) }}" style="width: 5px;padding-right: 65px;">
                        @csrf
                        <div class="actions1">

                            <button type="submit">
                                <i  class="fa fa-trash"></i>
                                      </button>
                           </div>

                         </form>
                        </h6>
                    </a>
                     @endif


                @endif



            </a>



    </div>

</div>

    @endforeach








    <!-- End Section Six -->


















        </main>
        <div class="col-lg-12 text-center">
            <div >
                {{ $myWatchLaters->links('vendor.pagination.tailwind') }}
                </div>
        </div>

@endsection





@section('js')



@endsection


