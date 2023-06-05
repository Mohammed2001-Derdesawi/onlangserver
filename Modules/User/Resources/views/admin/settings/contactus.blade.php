@extends('layouts.admin.master')
@section('title', 'تعديل إعدادات صفحة تواصل معنا')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/pickadate/themes/default.date.css') }}">

@endsection
@section('title_page', 'تعديل إعدادات صفحة تواصل معنا')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>تعديل إعدادات صفحة تواصل معنا</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">

                <li class="breadcrumb-item active"><a href="javascript:void(0);">تعديل إعدادات صفحة تواصل معنا</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>

            </ol>
        </div>
    </div>
    @php
        $settings = cache()->get('settings.contactus') ?? ['phone' => '', 'location' => '', 'email' => ''];

    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">إعدادات صفحة عن الموقع</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.contactus.edit') }}" method="post">
                        @csrf
                        <div class="row">




                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="form-group fallback w-200">

                                    <label class="form-label" style="margin-left: 10px;">رقم الهاتف</label>
                                    <input type="text" name="phone" value="{{$settings['phone']}}" class="form-control">
                                    @if ($errors->first('phone'))
                                        <span class="text-danger" style="padding-bottom: 10px;">
                                            {{ $errors->first('phone') }}

                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="form-group fallback w-200">

                                    <label class="form-label" style="margin-left: 10px;">الإيميل</label>
                                    <input type="text" name="email"  value="{{$settings['email']}}" class="form-control">
                                    @if ($errors->first('email'))
                                        <span class="text-danger" style="padding-bottom: 10px;">
                                            {{ $errors->first('email') }}

                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">


                                <div class="form-group fallback w-200">

                                    <label class="form-label" style="margin-left: 10px;">المكان</label>
                                    <input type="text" name="location"  value="{{$settings['location']}}" class="form-control">
                                    @if ($errors->first('location'))
                                        <span class="text-danger" style="padding-bottom: 10px;">
                                            {{ $errors->first('location') }}
                                        </span>
                                    @endif
                                </div>
                            </div>


                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light">إلغاء</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection
@section('scripts')







@endsection
