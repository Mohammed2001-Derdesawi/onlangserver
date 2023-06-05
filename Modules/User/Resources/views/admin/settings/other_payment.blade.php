@extends('layouts.admin.master')
@section('title','تعديل إعدادات صفحة المدفوعات الخاصة')
@section('css')

@endsection
@section('title_page','تعديل إعدادات صفحة المدفوعات الخاصة')

@section('content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>تعديل إعدادات صفحة المدفوعات الخاصة</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">

            <li class="breadcrumb-item active"><a href="javascript:void(0);">تعديل إعدادات صفحة المدفوعات الخاصة</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a></li>

        </ol>
    </div>
</div>
@php
    $settings=cache()->get('settings.other_payment_settings')??['description_ar'=>'','description_en'=>'','image'=>''];

@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">إعدادات المدفوعات الخاصة</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.settings.other_payments.edit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">





                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">الوصف باللغة العربية</label>

                                 <textarea class="summernote"  id="description" name="description_ar">{{ $settings['description_ar'] }}</textarea>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("description_ar")}}

                                </span>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">الوصف باللغة الإنجليزية</label>

                                 <textarea class="summernote"  id="description" name="description_en">{{  $settings['description_en']  }}</textarea>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("description_en")}}

                                </span>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">صورة</label>
                                <input type="file" name="image" class="dropify" data-default-file="">
                            </div>
                            <span class="text-danger" style="padding-bottom: 10px;">
                                {{$errors->first("image")}}

                            </span>
                        </div>
                        @if ($settings['image']!='')
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">الصورة القديمة</label>
                                <img class="img-responsive" width="350px" height="350px" src="{{asset( $settings['image'] )}}" alt="Not Found">

                            </div>

                        </div>
                        @endif

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

<script src="{{asset('assets/admin/vendor/svganimation/vivus.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/svganimation/svg.animation.js')}}"></script>
	<!-- pickdate -->

	<!-- Pickdate -->

  <script>
    $('.summernote').summernote({
        height: 150,   //set editable area's height

  toolbar: [
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['insert', ['link']],
  ['view', ['fullscreen']],
],

});
</script>



@endsection

