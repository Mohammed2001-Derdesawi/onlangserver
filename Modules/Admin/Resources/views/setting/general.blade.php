@extends('admin.master')

@section('title', ' الإعدادات العامة')

@section('title_page', ' الإعدادات العامة')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
@endpush
@php
    $settings=(cache()->get('settings') && isset(cache()->get('settings')['general_info'])) ?cache()->get('settings')['general_info']:config('front_settings.general_info');
@endphp
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-bullseye-arrow me-2"></i>
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> الإعدادات العامة</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active"> الإعدادات العامة</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">إعدادات الإعدادات العامة</h4>

                            <form action="{{ route('admin.setting.general.info.update') }}" method="POST" class=""
                                enctype="multipart/form-data">
                                @csrf
                                 {{-- Start section_one --}}
                                <div class="row mb3">

                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">رقم الجوال العام</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                value="{{ $settings['support_phone'] }}" name="support_phone"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">البريد الإلكتروني للموقع</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['support_email'] }}" name="support_email"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">رقم الدراسات الخاصة</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['whatsapp_phone'] }}" name="whatsapp_phone"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">الموقع</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['location'] }}" name="location"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">صورة صفحة المدفوعات الخاصة
                                            </label>
                                        <div class="col-sm-10">
                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['private_payment']['photo'] }}"  name="photo"
                                                type="file"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">الوصف التربح بشكل عام بالعربي
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="affilate[ar][description]"
                                                class="form-control">{{ $settings['affilate']['ar']['description'] }}</textarea>

                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">الوصف التربح بشكل عام بالإنجليزي
                                        </label>
                                        <div class="col-sm-10">
                                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="affilate[en][description]"
                                                class="form-control">{{ $settings['affilate']['en']['description'] }}</textarea>

                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                       ..................
                       
                                             <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> رابط فيديو سلايدر 1 
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['affilate']['sliders'][0]['video'] }}"  name="affilate_sliders[sliders][0][video] "
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة فيديو سلايدر 1 
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            type="file"  name="affilate_sliders[sliders][0][poster]"  id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                                         <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> رابط فيديو سلايدر 2 
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['affilate']['sliders'][1]['video'] }}"  name="affilate_sliders[sliders][1][video] "
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة فيديو سلايدر 2 
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" type="file"
name="affilate_sliders[sliders][1][poster]"  id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                                         <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> رابط فيديو سلايدر 3 
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['affilate']['sliders'][2]['video'] }}"  name="affilate_sliders[sliders][2][video] "
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة فيديو سلايدر 3 
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                             type="file"  name="affilate_sliders[sliders][2][poster]"  id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                       
                       
                                
                                </div>
                                {{-- End section_one --}}











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
