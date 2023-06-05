@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
@endsection
@section('content')
<main  style="margin-top:117px;">

<button class="show-menu d-lg-none">
    <i class="fas fa-stream"></i>
</button>
<div class="video-main-content container-fluid">
    <div class="sidebar d-none d-lg-block">
         @include('user::User.Profile.sidebar')
    </div>
    <div class="course-detalies-area pb-100">
        <div class="container">
           <div class="row">
                        <div class="col-md-12" style="width: 492px">
                            <div class="card">
                                <div class="card-header"> {{ trans('myProfile_trans.change') }}</div>

                                <form action="{{ route('update-password') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @elseif (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="oldPasswordInput" class="form-label">{{ trans('myProfile_trans.oldpass') }}</label>
                                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                                placeholder="{{ trans('myProfile_trans.oldpass') }}">
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPasswordInput" class="form-label">{{ trans('myProfile_trans.newpass') }}</label>
                                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                                placeholder="{{ trans('myProfile_trans.newpass') }}">
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmNewPasswordInput" class="form-label">{{ trans('myProfile_trans.confirmnewpass') }}</label>
                                            <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                                placeholder="{{ trans('myProfile_trans.confirmnewpass') }}">
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button class="user-btn-sign-in">{{ trans('myProfile_trans.submit') }}</button>
                                    </div>

                                </form>
                            </div>
                        </div>

           </div>
        </div>
     </div>


    </div>
















    </main>

@endsection





@section('js')



@endsection


