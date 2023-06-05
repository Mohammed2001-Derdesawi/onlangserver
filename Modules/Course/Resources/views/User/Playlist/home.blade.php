@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
@endsection
@section('content')
<main style="margin-top: 170px">

    <!-- Start Section One -->


    <button class="show-menu d-lg-none">
        <i class="fas fa-stream"></i>
    </button>
    <div class="video-main-content container-fluid">
        <div class="sidebar d-none d-lg-block">
            @include('course::User.Playlist.sidebarComponent')

        </div>

        <div class="all-videos">

        @foreach ( $myplaylist as $playlist )

            <div class="one-videos">
                <a href="{{ route('user.my.playlistVideos' , $playlist->id ) }}">
                    <img  style="

                    margin-right: 23px;
                    margin-left: 20px;
                                " width="200px" src="{{ asset('assets/user/img/logo/main_logo.png')}}" alt="">

                </a>
                <a href="{{ route('user.my.playlistVideos' , $playlist->id ) }}">
                    <button class="playlist-button">
                        <span class="playlist-label">Open Playlist</span>
                        <br>
                        <i class="fas fa-dumbbell"></i>
                    </button>
                </a>


                <div class="details-video">
                    <div>
                        <a href="{{ route('user.my.playlistVideos' , $playlist->id ) }}">
                            <img src="{{ asset('assets/user/img/logo/main_logo.png')}}" alt="">
                        </a>

                    </div>

                    <a href="#">
                        <h6>{{ $playlist->title }}</h6>
                    </a>
                    <button class="video-menu-button">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                    </button>
                    <div class="video-menu-navigation">

                        <div class="video-menu-buttons">



                        </div>
                    </div>

                </div>



            </div>


            @endforeach



        </div>
    </div>

    <!-- End Section Six -->




















        </main>

@endsection





@section('js')



@endsection


