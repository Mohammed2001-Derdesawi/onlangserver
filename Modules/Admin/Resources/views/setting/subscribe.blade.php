@extends('admin.master')

@section('title', 'إعدادات صفحة الإشتراك الشهري')

@section('title_page', 'إعدادات صفحة الإشتراك الشهري')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
@endpush
@php
    $settings=(cache()->get('settings') && isset(cache()->get('settings')['subscribes_page'])) ?cache()->get('settings')['subscribes_page']:config('front_settings.subscribes_page');
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
                        <h4 class="mb-sm-0">إعدادات صفحة الإشتراك الشهري</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">صفحة الإشتراك الشهري</a></li>
                                <li class="breadcrumb-item active">إعدادات صفحة الإشتراك الشهري</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">إعدادات صفحة الإشتراك الشهري</h4>

                            <form action="{{ route('admin.setting.monthlypage.update') }}" method="POST" class=""
                                enctype="multipart/form-data">
                                @csrf
                                 {{-- Start section_one --}}
                                <div class="row mb3">

                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">العنوان
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                value="{{ $settings['ar']['card_title'] }}" name="subscribes_page[ar][card_title]"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">العنوان
                                            بالإنلجيزي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['en']['card_title'] }}" name="subscribes_page[en][card_title]"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">عنوان الفيديو
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['ar']['title'] }}" name="subscribes_page[ar][title]"
                                                type="text"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">عنوان الفيديو
                                            بالإنلجيزي</label>
                                        <div class="col-sm-10">
                                            <input required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['en']['title'] }}" name="subscribes_page[en][title]"
                                                type="text"  id="example-text-input">
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
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['video'] }}" required name="subscribes_page[video]"
                                                type="text"  id="example-text-input">
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
                                            value="{{ $settings['poster'] }}" required name="subscribes_page[poster]"
                                                type="file"  id="example-text-input">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">سعر الإشتراك الشهري
                                            </label>
                                        <div class="col-sm-10">
                                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            value="{{ $settings['price'] }}" required name="subscribes_page[price]"
                                                type="text"  placeholder="السعر.." id="example-text-input">
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
