@extends('layouts.admin.master')
@section('title', 'تعديل إعدادات صفحة المنوعات')
@section('css')

@endsection
@section('title_page', 'تعديل إعدادات صفحة المنوعات')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>تعديل إعدادات صفحة المنوعات</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">

                <li class="breadcrumb-item active"><a href="javascript:void(0);">تعديل إعدادات صفحة المنوعات</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>

            </ol>
        </div>
    </div>
    @php
        $settings = cache()->get('settings.variouses') ?? ['price' => '', 'preview_video' => ''];

    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">إعدادات المنوعات</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.variouses.edit') }}" method="post">
                        @csrf
                        <div class="row">




                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="form-group fallback w-200">

                                    <label class="form-label" style="margin-left: 10px;">سعر الإشتراك</label>
                                    <input type="text" name="price" value="{{$settings['price']}}" class="form-control">
                                    @if ($errors->first('price'))
                                        <span class="text-danger" style="padding-bottom: 10px;">
                                            {{ $errors->first('price') }}

                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div class="form-group fallback w-200">

                                    <label class="form-label" style="margin-left: 10px;">رابط فيديوالمقدمة</label>
                                    <input type="text" name="preview_video"  value="{{$settings['preview_video']}}" class="form-control">
                                    @if ($errors->first('preview_video'))
                                        <span class="text-danger" style="padding-bottom: 10px;">
                                            {{ $errors->first('preview_video') }}

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
