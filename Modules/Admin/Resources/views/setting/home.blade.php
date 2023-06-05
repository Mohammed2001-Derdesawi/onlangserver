@extends('admin.master')

@section('title', 'إعدادات الصفحة الرئيسية')

@section('title_page', 'إعدادات الصفحة الرئيسية')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
@endpush
@php

    $settings=(cache()->get('settings') && isset(cache()->get('settings')['home'])) ?cache()->get('settings')['home']:config('front_settings.home');


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
                        <h4 class="mb-sm-0">إعدادات الصفحة الرئيسية</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active">إعدادات الصفحة الرئيسية</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">إعدادات الصفحة الرئيسية</h4>

                            <form action="{{ route('admin.setting.home.update') }}" method="POST" class=""
                                enctype="multipart/form-data">
                                @csrf
                                 {{-- Start section_one --}}
                                <div class="row mb3">
                                    <div class="col-lg-12">
                                        <h3 for="example-text-input" class="col-sm-2">القسم الأول</h3>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">1-الوصف
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                value="{{ $settings['first_section']['ar']['sliders'][0] }}" name="first_section[ar][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">1-الوصف
                                            بالإنلجيزي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['en']['sliders'][0] }}" name="first_section[en][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">2-الوصف
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['ar']['sliders'][1] }}" name="first_section[ar][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">2-الوصف
                                            بالإنلجيزي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['en']['sliders'][1] }}" name="first_section[en][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">3-الوصف
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['ar']['sliders'][2] }}" name="first_section[ar][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">3-الوصف
                                            بالإنلجيزي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['en']['sliders'][2] }}" name="first_section[en][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">4-الوصف
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['ar']['sliders'][3] }}" name="first_section[ar][sliders][]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">4-الوصف
                                            بالإنلجيزي</label>
                                        <div class="col-sm-10">
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['en']['sliders'][3] }}" name="first_section[en][sliders][]"
                                                type="text" required placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">رابط الفيديو التعريفي
                                            </label>
                                        <div class="col-sm-10">
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['video'] }}" required name="first_section[video]"
                                                type="text" placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">صورة للفيديو
                                            </label>
                                        <div class="col-sm-10">
                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['first_section']['poster'] }}"  name="first_section[poster]"
                                                type="file"  placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                {{-- End section_one --}}

                                {{-- Start section_two --}}

                                <div class="row mb3">
                                    <div class="col-lg-12 mt-5">
                                        <h3 for="example-text-input" class="col-sm-4">القسم الثاني
                                        </h3>
                                        </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['seconed_section']['ar']['title'] }}" required name="seconed_section[ar][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['seconed_section']['en']['title'] }}" required name="seconed_section[en][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="seconed_section[ar][description]" class="form-control">{{ $settings['seconed_section']['ar']['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">

                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="seconed_section[en][description]" class="form-control">{{ $settings['seconed_section']['en']['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="urls">
                                                <div class="col-lg-12">
                                                    <h3 for="example-text-input" class="col-sm-4">
                                                        روابط القسم الثاني
                                                    </h3>
                                                </div>
                                              <div class="url-first">

                                                <div class="col-lg-12 mt-2">
                                                    <h5>
                                                        الرابط الأول
                                                    </h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">النص بالعربي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['ar']['urls'][0]['text'] }}" required name="seconed_section[ar][urls][0][text]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالعربي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['ar']['urls'][0]['url'] }}" required name="seconed_section[ar][urls][0][url]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">النص بالإنجليزي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['en']['urls'][0]['text'] }}" required name="seconed_section[en][urls][0][text]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['en']['urls'][0]['url'] }}" required name="seconed_section[en][urls][0][url]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                              </div>
                                            {{-- End First url in seconed section --}}


                                            <div class="url-first mt-2">

                                                <div class="col-lg-12">
                                                    <h5>
                                                        الرابط الثاني
                                                    </h5>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">النص بالعربي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['ar']['urls'][1]['text'] }}" required name="seconed_section[ar][urls][1][text]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالعربي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['ar']['urls'][1]['url'] }}" required name="seconed_section[ar][urls][1][url]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">النص بالإنجليزي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['en']['urls'][1]['text'] }}" required name="seconed_section[en][urls][1][text]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['en']['urls'][1]['url'] }}" required name="seconed_section[en][urls][1][url]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>


                                              </div>
                                            {{-- End Seconed url in seconed section --}}


                                            <div class="url-first mt-2">

                                                <div class="col-lg-12">
                                                    <h5>
                                                        الرابط الثالث
                                                    </h5>
                                                </div>
                                               <div class="row">
                                                <div class="col-lg-3">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">النص بالعربي
                                                        </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ $settings['seconed_section']['ar']['urls'][2]['text'] }}" required name="seconed_section[ar][urls][2][text]"
                                                            type="text"  placeholder="الإسم.." id="example-text-input">
                                                        @if ($errors->has('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالعربي
                                                        </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ $settings['seconed_section']['ar']['urls'][2]['url'] }}" required name="seconed_section[ar][urls][2][url]"
                                                            type="text"  placeholder="الإسم.." id="example-text-input">
                                                        @if ($errors->has('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">النص بالإنجليزي
                                                        </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ $settings['seconed_section']['en']['urls'][2]['text'] }}" required name="seconed_section[en][urls][2][text]"
                                                            type="text"  placeholder="الإسم.." id="example-text-input">
                                                        @if ($errors->has('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                        </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ $settings['seconed_section']['en']['urls'][2]['url'] }}" required name="seconed_section[en][urls][2][url]"
                                                            type="text"  placeholder="الإسم.." id="example-text-input">
                                                        @if ($errors->has('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                               </div>


                                              </div>
                                            {{-- End Third url in seconed section --}}


                                            <div class="url-first mt-2">

                                                <div class="col-lg-12">
                                                    <h5>
                                                        الرابط الرابع
                                                    </h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">النص بالعربي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['ar']['urls'][3]['text'] }}" required name="seconed_section[ar][urls][3][text]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالعربي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['ar']['urls'][3]['url'] }}" required name="seconed_section[ar][urls][3][url]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">النص بالإنجليزي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['en']['urls'][3]['text'] }}" required name="seconed_section[en][urls][3][text]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                            </label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            value="{{ $settings['seconed_section']['en']['urls'][3]['url'] }}" required name="seconed_section[en][urls][3][url]"
                                                                type="text"  placeholder="الإسم.." id="example-text-input">
                                                            @if ($errors->has('name'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>


                                              </div>
                                            {{-- End Fifth url in seconed section --}}

                                            </div>

                                </div>
                                {{-- End section_two --}}

                                {{-- Start section_three --}}

                                <div class="row mb3">
                                    <div class="col-lg-12 mt-5">
                                        <h3 for="example-text-input" class="col-sm-4">القسم الثالث
                                        </h3>
                                        </div>
                                             <div class="col-lg-12 mt-2">
                                                <h4 for="example-text-input" class="col-sm-4">السلايدر الأول
                                                </h4>
                                             </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['third_section']['ar']['sliders'][0]['title'] }}" required name="third_section[ar][sliders][0][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['third_section']['en']['sliders'][0]['title'] }}" required name="third_section[en][sliders][0][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="third_section[ar][sliders][0][description]" class="form-control">{{ $settings['third_section']['ar']['sliders'][0]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="third_section[en][sliders][0][description]" class="form-control">{{ $settings['third_section']['en']['sliders'][0]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['third_section']['ar']['sliders'][0]['url_text'] }}" required name="third_section[ar][sliders][0][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][0]['url_text'] }}" required name="third_section[en][sliders][0][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط  بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][0]['url'] }}" required name="third_section[ar][sliders][0][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][0]['url'] }}" required name="third_section[en][sliders][0][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][0]['video'] }}" required name="third_section[ar][sliders][0][video]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][0]['poster'] }}"  name="third_section[ar][sliders][0][poster]"
                                                        type="file"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>



                                            {{-- seconed slider --}}
                                            <div class="col-lg-12 mt-2">
                                                <h4 for="example-text-input" class="col-sm-4">السلايدر الثاني
                                                </h4>
                                             </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][1]['title'] }}" required name="third_section[ar][sliders][1][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][1]['title'] }}" required name="third_section[en][sliders][1][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="third_section[ar][sliders][1][description]" class="form-control">{{$settings['third_section']['ar']['sliders'][1]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="third_section[en][sliders][1][description]" class="form-control">{{$settings['third_section']['en']['sliders'][1]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][1]['url_text'] }}" required name="third_section[ar][sliders][1][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][1]['url_text'] }}" required name="third_section[en][sliders][1][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط  بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][1]['url'] }}" required name="third_section[ar][sliders][1][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][1]['url'] }}" required name="third_section[en][sliders][1][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][1]['video'] }}" required name="third_section[ar][sliders][1][video]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][1]['poster'] }}"  name="third_section[ar][sliders][1][poster]"
                                                        type="file"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- end socned slider --}}


                                            {{-- start third slider --}}

                                            <div class="col-lg-12 mt-2">
                                                <h4 for="example-text-input" class="col-sm-4">السلايدر الثالث
                                                </h4>
                                             </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][2]['title'] }}" required name="third_section[ar][sliders][2][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][2]['title'] }}" required name="third_section[en][sliders][2][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="third_section[ar][sliders][2][description]" class="form-control">{{$settings['third_section']['ar']['sliders'][2]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="third_section[en][sliders][2][description]" class="form-control">{{$settings['third_section']['en']['sliders'][2]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][2]['url_text'] }}" required name="third_section[ar][sliders][2][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][2]['url_text'] }}" required name="third_section[en][sliders][2][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط  بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][2]['url'] }}" required name="third_section[ar][sliders][2][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['en']['sliders'][2]['url'] }}" required name="third_section[en][sliders][2][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label"> الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][2]['video'] }}" required name="third_section[ar][sliders][2][video]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['third_section']['ar']['sliders'][2]['poster'] }}"  name="third_section[ar][sliders][2][poster]"
                                                        type="file"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- end third slider --}}

                                </div>
                                {{-- End section_three --}}


                                {{-- Start section_four --}}
                                <div class="row mb3">
                                    <div class="col-lg-12 mt-5">
                                        <h3 for="example-text-input" class="col-sm-4">القسم الرابع
                                        </h3>
                                        </div>
                                             <div class="col-lg-12 mt-2">
                                                <h4 for="example-text-input" class="col-sm-4">السلايدر الأول
                                                </h4>
                                             </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][0]['title'] }}" required name="fourth_section[ar][sliders][0][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][0]['title'] }}" required name="fourth_section[en][sliders][0][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fourth_section[ar][sliders][0][description]" class="form-control">{{$settings['fourth_section']['ar']['sliders'][0]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fourth_section[en][sliders][0][description]" class="form-control">{{$settings['fourth_section']['en']['sliders'][0]['description'] }}"</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][0]['url_text'] }}" required name="fourth_section[ar][sliders][0][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][0]['url'] }}" required name="fourth_section[en][sliders][0][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط  بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][0]['url'] }}" required name="fourth_section[ar][sliders][0][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][0]['url'] }}" required name="fourth_section[en][sliders][0][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">رابط الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][0]['video'] }}" required name="fourth_section[ar][sliders][0][video]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][0]['poster'] }}"  name="fourth_section[ar][sliders][0][poster]"
                                                        type="file"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>




                                            {{-- seconed slider --}}
                                            <div class="col-lg-12 mt-2">
                                                <h4 for="example-text-input" class="col-sm-4">السلايدر الثاني
                                                </h4>
                                             </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][1]['title'] }}" required name="fourth_section[ar][sliders][1][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][1]['title'] }}" required name="fourth_section[en][sliders][1][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fourth_section[ar][sliders][1][description]" class="form-control">{{$settings['fourth_section']['ar']['sliders'][1]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fourth_section[en][sliders][1][description]" class="form-control">{{$settings['fourth_section']['en']['sliders'][1]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][1]['url_text'] }}" required name="fourth_section[ar][sliders][1][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][1]['url_text'] }}" required name="fourth_section[en][sliders][1][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط  بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][1]['url'] }}" required name="fourth_section[ar][sliders][1][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][1]['url'] }}" required name="fourth_section[en][sliders][1][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">رابط الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][1]['video'] }}" required name="fourth_section[ar][sliders][1][video]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][1]['poster'] }}"  name="fourth_section[ar][sliders][1][poster]"
                                                        type="file"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- end socned slider --}}


                                            {{-- start third slider --}}

                                            <div class="col-lg-12 mt-2">
                                                <h4 for="example-text-input" class="col-sm-4">السلايدر الثالث
                                                </h4>
                                             </div>
                                             <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][2]['title'] }}" required name="fourth_section[ar][sliders][2][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][2]['title'] }}" required name="fourth_section[en][sliders][2][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fourth_section[ar][sliders][2][description]" class="form-control">{{$settings['fourth_section']['ar']['sliders'][2]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fourth_section[en][sliders][2][description]" class="form-control">{{$settings['fourth_section']['en']['sliders'][2]['description'] }}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][2]['url_text'] }}" required name="fourth_section[ar][sliders][2][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][2]['url'] }}" required name="fourth_section[en][sliders][2][url_text]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط  بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][2]['url'] }}" required name="fourth_section[ar][sliders][2][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الرابط بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['en']['sliders'][2]['url'] }}" required name="fourth_section[en][sliders][2][url]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">رابط الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][2]['video'] }}" required name="fourth_section[ar][sliders][2][video]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الفيديو
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fourth_section']['ar']['sliders'][2]['poster'] }}"  name="fourth_section[ar][sliders][2][poster]"
                                                        type="file"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>







                                            {{-- end third slider --}}

                                </div>
                                {{-- End section_four --}}


                                   {{-- Start section_fifth --}}
                                   <div class="row mb3">
                                    <div class="col-lg-12 mt-5">
                                        <h3 for="example-text-input" class="col-sm-4">القسم الخامس
                                        </h3>
                                        </div>

                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fifth_section']['ar']['title']}}" required name="fifth_section[ar][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{$settings['fifth_section']['en']['title']}}" required name="fifth_section[en][title]"
                                                        type="text"  placeholder="الإسم.." id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fifth_section[ar][description]" class="form-control">{{$settings['fifth_section']['ar']['description']}}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="fifth_section[en][description]" class="form-control">{{$settings['fifth_section']['en']['description']}}</textarea>

                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <label class="form-label d-block">المميزات</label>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12" id="feachers">
                                               @foreach ($settings['fifth_section']['ar']['feachers'] as $feacher)
                                               <div class="form-group fallback w-200 mt-2" id="feacher-{{$loop->iteration}}">
                                                <div class="row">


                                                    <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                                        <label class="form-label" style="margin-left: 10px;">{{$loop->iteration}}-</label>
                                                        <input type="text" value="{{$feacher}}" name="fifth_section[ar][feachers][]" class="form-control">
                                                        @if ($errors->first("feachers"))
                                                        <span class="text-danger" style="padding-bottom: 10px;">
                                                            {{$errors->first("feachers")[$loop->iteration=1][0]}}

                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" value="{{$settings['fifth_section']['en']['feachers'][$loop->iteration-1]}}" name="fifth_section[en][feachers][]" class="form-control">
                                                        <span class="text-danger" style="padding-bottom: 10px;">
                                                            @if ($errors->first("feachers"))

                                                            {{$errors->first("feachers")[$loop->iteration-1][1]}}

                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <button style="border: 0;background: none;" onclick="removeFeacher(event,{{$loop->iteration}})"><i class="fas fa-trash" style="font-size: 25px;color: red"></i></button>
                                                    </div>
                                                </div>

                                                 </div>

                                               @endforeach


                                               @if (count($settings['fifth_section']['ar']['feachers'])==0)
                                               <div class="form-group fallback w-200" id="feacher-1">
                                                <div class="row">

                                                    <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                                        <label class="form-label" style="margin-left: 10px;">1-</label>
                                                        <input type="text" name="fifth_section[ar][feachers][]" class="form-control">
                                                        @if ($errors->first("feachers"))

                                                        <span class="text-danger" style="padding-bottom: 10px;">
                                                            {{$errors->first("feachers")[0][0]}}

                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="fifth_section[en][feachers][]" class="form-control">
                                                        @if ($errors->first("feachers"))

                                                        <span class="text-danger" style="padding-bottom: 10px;">
                                                            {{$errors->first("feachers")[0][1]}}

                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <button style="border: 0;background: none;" onclick="removeFeacher(event,1)"><i class="la la-trash" style="font-size: 25px;color: red"></i></button>
                                                    </div>
                                                </div>

                                                 </div>
                                               @endif



                                            </div>


                                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                                <div class="form-group fallback">

                                              <button class="btn btn-success" onclick="addFeacher(event)" style="color: #fff">+</button>
                                                </div>

                                            </div>


                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">الصور
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('name') }}" 
                                                        type="file" multiple name="fifth_section[images][]"  id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص صغير للصور بالعربي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ $settings['fifth_section']['ar']['text_photos'] }}" required
                                                        type="text" name="fifth_section[ar][text_photos]"  id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">نص صغير للصور بالإنجليزي
                                                    </label>
                                                <div class="col-sm-10">
                                                    <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ $settings['fifth_section']['en']['text_photos'] }}" required
                                                        type="text" name="fifth_section[en][text_photos]"  id="example-text-input">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <input type="hidden" id="count_feachers" value="{{count($settings['fifth_section']['ar']['feachers'])}}">








                                </div>
                                {{-- End section_fifth --}}

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

    <script>

 function addFeacher(e)
 {
    e.preventDefault();

    countfeachers++;
   var newTextDiv = $(document.createElement('div'))
         .attr("id", 'feacher-' + countfeachers).addClass("form-group fallback w-200");

         newTextDiv.after().html(`

                            <div class="row mt-2">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">${countfeachers}-</label>
                                    <input type="text" name="fifth_section[ar][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="fifth_section[en][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,${countfeachers})"><i class="fas fa-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>


         `);

          newTextDiv.appendTo("#feachers");

 }
 function removeFeacher(e,id)
 {
    e.preventDefault();
    if(countfeachers==1 || id==1)
    {
        alert("لا يمكن حذف جميع المميزات");
         return false;

    }

    $("#feacher-"+id).remove()

    countfeachers--;
     if(id==countfeachers || id<countfeachers)
     {
        $("#feachers").html('')

        let defaultvalues=@json($settings['fifth_section']['ar']['feachers']);;
        defaultvalues.splice(id-1,1)
        for(let i=0;i<countfeachers;i++)
     {

        var newTextDiv = $(document.createElement('div'))
         .attr("id", 'feacher-' + (i+1)).addClass("form-group fallback w-200");


         newTextDiv.after().html(`

                            <div class="row mt-2">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">${i+1}-</label>
                                    <input type="text" value="${defaultvalues.length>i?defaultvalues[i][0]:""}" name="fifth_section[ar][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" value="${defaultvalues.length>i?defaultvalues[i][0]:""}" name="fifth_section[en][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,${i+1})"><i class="fas fa-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>


         `);

          newTextDiv.appendTo("#feachers");
     }

     }


 }

 let countfeachers=$('#count_feachers').val()


</script>

@endpush

