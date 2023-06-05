@extends('layouts.admin.master')
@section('title','اعدادات صفحة الاعلانات ')
@section('css')

@endsection
@section('title_page','اعدادات صفحة الاعلانات ')

@section('content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>    اعدادات صفحة الاعلانات  </h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">

            <li class="breadcrumb-item active"><a href="javascript:void(0);">  اعدادات صفحة الاعلانات  </a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a></li>

        </ol>
    </div>
</div>
@php
    $settings=cache()->get('settings.ads')??['code'=>''];

@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">تفاصيل  صفحة الاعلانات </h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.settings.google.ads.edit')}}" method="post" >
                    @csrf
                    <div class="row">


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">كود الاعلانات </label>

                                 <input type="text"  class="form-control"  id="code" name="code" value="{{ $settings['code'] }}"/>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("code")}}

                                </span>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                            <a href="{{route('admin.dashboard')}}" class="btn btn-light">إلغاء</a>
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

