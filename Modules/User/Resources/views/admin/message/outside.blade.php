@extends('admin.master')

@section('title','إرسال رسائل خارجية')

@section('title_page','إرسال رسائل خارجية')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
@endpush
@section('content')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <i class="mdi mdi-bullseye-arrow me-2"></i>
              {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">إرسال رسائل خارجية</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">إرسال رسائل خارجية</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">إرسال رسائل خارجية</h4>

                       <form action="{{route('admin.message.outside.email.sent')}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">العنوان</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('subject')?'is-invalid':''}}" value="{{old('subject')}}" name="subject" type="text" placeholder="العنوان.." id="example-text-input">
                                @if ($errors->has('subject'))
                                <div class="invalid-feedback">
                                    {{$errors->first("subject")}}
                                  </div>

                                @endif
                            </div>
                           </div>

                        </div>
                        <div class="row mb3">
                            <div class="col-lg-12">
                                <label for="example-text-input" class="col-sm-2 col-form-label">الرسالة</label>


                                    <textarea class="elm1 {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" class="form-control">{{old("message")}}</textarea>


                                    @if ($errors->has('message'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('message') }}
                                        </div>
                                    @endif

                            </div>

                        </div>
                        <div class="row mb3">
                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-2 col-form-label">رفع ملف الإيميلات</label>
                                <input accept=".csv" class="form-control {{$errors->has('file')?'is-invalid':''}}" value="{{old('file')}}" name="file" type="file" id="example-text-input">

                                    @if ($errors->has('file'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file') }}
                                        </div>
                                    @endif

                            </div>

                        </div>

                        <div class="mt-2">
                            <button class="btn btn-primary" type="submit">حفظ</button>
                        </div>

                       </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end page title -->

    </div> <!-- container-fluid -->
</div>

@endsection

@push('js')
<script src="{{ asset('assets/admin/libs/tinymce/tinymce.min.js') }}"></script>

<script src="{{ asset('assets/admin/js/pages/form-editor.init.js') }}"></script>

@endpush
