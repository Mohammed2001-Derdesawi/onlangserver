@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
@endsection
@section('content')
<main style="margin-top: 170px">

    <button class="show-menu d-lg-none">
        <i class="fas fa-stream"></i>
    </button>
    <div class="video-main-content container-fluid">
        <div class="sidebar d-none d-lg-block">
            @include('course::User.Playlist.sidebarComponent')

        </div>

<div class="all-videos">
    @foreach ( $likedVideos   as $likedvideo )

    @if($likedvideo->likeable_type === 'Modules\Course\Entities\Various')
        @php
        $likedvideo = $likedvideo->likeable
        @endphp

    <div class="one-videos">

        <a  href="{{ route('user.freeVideoShow' , $likedvideo->id ) }}" >
            <img src="{{ asset($likedvideo->poster) }}" class="video-img" alt="">
        </a>

        <div class="details-video">
            <div>
                <a href="#">
                    <img src="assets/img/course/academic-tutor-1.png" alt="">
                </a>

            </div>

            <a href="#">
                @if (App::getLocale() == 'en')

                @if($likedvideo->type == 'free')

                <h6>    <a  href="{{ route('user.freeVideoShow' , $likedvideo->id ) }}"
                    >   {{ $likedvideo->title_en }} </a></h6>
                 @else

                    <h6>    <a  href="{{ route('user.paidVideoShow' , $likedvideo->id ) }}"
                        >   {{ $likedvideo->title_en }} </a></h6>
                     @endif

                @else


                @if($likedvideo->type == 'free')

                <h6>    <a  href="{{ route('user.freeVideoShow', $likedvideo->id ) }}"
                    >   {{ $likedvideo->title_ar }} </a></h6>
                 @else

                    <h6>    <a  href="{{ route('user.paidVideoShow' , $likedvideo->id ) }}"
                        >   {{ $likedvideo->title_ar }} </a></h6>
                     @endif

          @endif





            </a>



    </div>

   </div>

   @endif



   @if($likedvideo->likeable_type === 'Modules\Course\Entities\Lecture')
   @php
   $likedvideo = $likedvideo->likeable
   @endphp

    <div class="one-videos">

        <a  href="{{ route('user.showLecture' , $likedvideo->id ) }}" >
            <img src="{{ asset($likedvideo->poster) }}" class="video-img" alt="">
        </a>

        <div class="details-video">
            <div>
                <a href="#">
                    <img src="assets/img/course/academic-tutor-1.png" alt="">
                </a>

            </div>

            <a href="#">
                @if (App::getLocale() == 'en')

                <h6>    <a  href="{{ route('user.showLecture' , $likedvideo->id ) }}"
                    >   {{ $likedvideo->title_en }} </a></h6>
                 @else

                    <h6>    <a  href="{{ route('user.showLecture' , $likedvideo->id ) }}"
                        >   {{ $likedvideo->title_ar }} </a></h6>
                     @endif



            </a>



    </div>

   </div>

   @endif


    @endforeach


</div>



    <!-- End Section Six -->




















        </main>


        <div class="col-lg-12 text-center">
            <div >
                {{ $likedVideos->links('vendor.pagination.tailwind') }}
                </div>
        </div>

@endsection





@section('js')



@endsection


