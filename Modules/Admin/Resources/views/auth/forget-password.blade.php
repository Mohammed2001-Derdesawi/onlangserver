@extends('admin::auth.master')
@section('title','نسيت كلمة المرور')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="text-muted text-center font-size-18"><b>نسيت كلمة المرور</b></h4>

        <div class="p-3">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="form-horizontal mt-3" action="{{ route('admin.password.email') }}" method="POST">
                @csrf
                <div class="form-group mb-3 row">
                    <div class="form-group">
                        <label><strong>البريد الإلكتروني</strong></label>
                        <input type="email" name="email" class="form-control" value="{{old("email")}}">
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first("email") }}</span>
                    @endif
                </div>

                <div class="form-group mb-3 row">
                    <div class="col-12">
                        <input class="form-control" type="password" name="password" required="" placeholder="كلمة المرور">
                    </div>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first("password") }}</span>
                   @endif
                </div>

                <div class="form-group mb-3 row">
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                            <input name="remember" type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="form-label ms-1" for="customCheck1">تذكرني</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3 text-center row mt-3 pt-1">
                    <div class="col-12">
                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">نسيت كلمة المرور</button>
                    </div>
                </div>


            </form>
        </div>
        <!-- end -->
    </div>
    <!-- end cardbody -->
</div>

@endsection