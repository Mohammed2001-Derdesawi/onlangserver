@extends('user.master')

@section('title')
    Messages
@endsection

@section('css')
@endsection
@section('content')
<main>


<div class="video-main-content container-fluid"  style="margin-top: 116px;">
    <div class="sidebar d-none d-lg-block">
        @include('user::User.Profile.sidebar')

    </div>

    <div class="setting-notification">
        <div class="notifyillustration">
            <img src="assets/img/1/undraw_subscriber_re_om92.svg" alt="">
        </div>
        <h3>Notifications Setting</h3>
        <form action="">
            <div>
                <input type="checkbox" name="" id="">
            <label for="">Notifications</label>
            <span>Receive notifications from Onlanguage Courses</span>
            </div>


        </form>






    </div>
</div>

<!-- End Section Six -->





    </main>
@endsection





@section('js')



@endsection


