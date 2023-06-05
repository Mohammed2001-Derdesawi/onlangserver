@extends('admin::auth.master')
@section('title','إعادة  كلمة المرور')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="text-muted text-center font-size-18"><b>إعادة كلمة المرور</b></h4>

        <div class="p-3">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label><strong>البريد الإلكتروني</strong></label>
                    <input type="email" name="email" value="{{old('email', $request->email)}}" class="form-control">
                </div>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first("email") }}</span>
               @endif
                <div class="form-group">
                    <label><strong>كلمة المرور</strong></label>
                    <input type="password" name="password" class="form-control">
                </div>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first("password") }}</span>
               @endif
                <div class="form-group">
                    <label><strong>إعادة كلمة المرور</strong></label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">إعادة كلمة المرور</button>
                </div>
            </form>
        </div>
        <!-- end -->
    </div>
    <!-- end cardbody -->
</div>

@endsection