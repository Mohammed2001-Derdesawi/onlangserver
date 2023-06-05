@extends('admin.master')

@section('title', 'إعدادات صفحة من نحن')

@section('title_page', 'إعدادات صفحة من نحن')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
@endpush
@php
    $settings = (cache()->get('settings') && isset(cache()->get('settings')['aboutus'])) ?cache()->get('settings')['aboutus']:config('front_settings.aboutus');

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
                        <h4 class="mb-sm-0">إعدادات صفحة من نحن</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">صفحة من نحن</a></li>
                                <li class="breadcrumb-item active">إعدادات صفحة من نحن</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">إعدادات صفحة من نحن</h4>

                            <form action="{{ route('admin.setting.aboutus.update') }}" method="POST" class=""
                                enctype="multipart/form-data">
                                @csrf
                                {{-- Start section_one --}}
                                <div class="row mb3">
                                    <div class="col-lg-12">
                                        <h3 for="example-text-input" class="col-sm-2">القسم الأول</h3>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">العنوان
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input required
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                value="{{ $settings['first_section']['ar']['title'] }}"
                                                name="first_section[ar][title]" type="text" placeholder="الإسم.."
                                                id="example-text-input">
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
                                            <input required
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                value="{{ $settings['first_section']['en']['title'] }}"
                                                name="first_section[en][title]" type="text" placeholder="الإسم.."
                                                id="example-text-input">
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
                                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="first_section[ar][description]"
                                                class="form-control">{{ $settings['first_section']['ar']['description'] }}</textarea>

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
                                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="first_section[en][description]"
                                                class="form-control">{{ $settings['first_section']['en']['description'] }}</textarea>

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
                                        @foreach ($settings['first_section']['ar']['feachers'] as $feacher)
                                            <div class="form-group fallback w-200 mt-2"
                                                id="feacher-{{ $loop->iteration }}">
                                                <div class="row">


                                                    <div class="col-lg-4"
                                                        style="display: flex;justify-content: center;align-items: center;">
                                                        <label class="form-label"
                                                            style="margin-left: 10px;">{{ $loop->iteration }}-</label>
                                                        <input type="text" value="{{ $feacher }}"
                                                            name="first_section[ar][feachers][]" class="form-control">
                                                        @if ($errors->first('feachers'))
                                                            <span class="text-danger" style="padding-bottom: 10px;">
                                                                {{ $errors->first('feachers')[($loop->iteration = 1)][0] }}

                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text"
                                                            value="{{ $settings['first_section']['en']['feachers'][$loop->iteration - 1] }}"
                                                            name="first_section[en][feachers][]" class="form-control">
                                                        <span class="text-danger" style="padding-bottom: 10px;">
                                                            @if ($errors->first('feachers'))
                                                                {{ $errors->first('feachers')[$loop->iteration - 1][1] }}

                                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-2">
                                        <button style="border: 0;background: none;"
                                            onclick="removeFeacher(event,{{ $loop->iteration }})"><i class="fas fa-trash"
                                                style="font-size: 25px;color: red"></i></button>
                                    </div>
                                </div>

                        </div>
                        @endforeach


                        @if (count($settings['first_section']['ar']['feachers']) == 0)
                            <div class="form-group fallback w-200" id="feacher-1">
                                <div class="row">

                                    <div class="col-lg-4"
                                        style="display: flex;justify-content: center;align-items: center;">
                                        <label class="form-label" style="margin-left: 10px;">1-</label>
                                        <input type="text" name="first_section[ar][feachers][]" class="form-control">
                                        @if ($errors->first('feachers'))
                                            <span class="text-danger" style="padding-bottom: 10px;">
                                                {{ $errors->first('feachers')[0][0] }}

                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" name="first_section[en][feachers][]" class="form-control">
                                        @if ($errors->first('feachers'))
                                            <span class="text-danger" style="padding-bottom: 10px;">
                                                {{ $errors->first('feachers')[0][1] }}

                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-2">
                                        <button style="border: 0;background: none;" onclick="removeFeacher(event,1)"><i
                                                class="la la-trash" style="font-size: 25px;color: red"></i></button>
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
                    <input type="hidden" id="count_feachers"
                        value="{{ count($settings['first_section']['ar']['feachers']) }}">


                    <div class="col-lg-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">الصورة
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ $settings['first_section']['ar']['photo'] }}"  type="file"
                                name="first_section[photo]" id="example-text-input">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    {{-- Start seconed Section --}}

                    <div class="col-lg-12">
                        <h3 for="example-text-input" class="col-sm-2">القسم الثاني</h3>
                    </div>
                    <div class="col-lg-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">العنوان
                            بالعربي</label>
                        <div class="col-sm-10">
                            <input required
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ $settings['seconed_section']['ar']['title'] }}"
                                name="seconed_section[ar][title]" type="text" placeholder="الإسم.."
                                id="example-text-input">
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
                            <input required
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ $settings['seconed_section']['en']['title'] }}"
                                name="seconed_section[en][title]" type="text" placeholder="الإسم.."
                                id="example-text-input">
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
                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="seconed_section[ar][description]"
                                class="form-control">{{ $settings['seconed_section']['ar']['description'] }}</textarea>

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
                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="seconed_section[en][description]"
                                class="form-control">{{ $settings['seconed_section']['en']['description'] }}</textarea>

                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- End seconed Section --}}



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

    <script>
        function addFeacher(e) {
            e.preventDefault();

            countfeachers++;
            var newTextDiv = $(document.createElement('div'))
                .attr("id", 'feacher-' + countfeachers).addClass("form-group fallback w-200");

            newTextDiv.after().html(`

                            <div class="row mt-2">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">${countfeachers}-</label>
                                    <input type="text" name="first_section[ar][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="first_section[en][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,${countfeachers})"><i class="fas fa-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>


         `);

            newTextDiv.appendTo("#feachers");

        }

        function removeFeacher(e, id) {
            e.preventDefault();
            if (countfeachers == 1 || id == 1) {
                alert("لا يمكن حذف جميع المميزات");
                return false;

            }

            $("#feacher-" + id).remove()

            countfeachers--;
            if (id == countfeachers || id < countfeachers) {
                $("#feachers").html('')

                let defaultvalues = @json($settings['first_section']['ar']['feachers']);
                defaultvalues.splice(id - 1, 1)
                for (let i = 0; i < countfeachers; i++) {

                    var newTextDiv = $(document.createElement('div'))
                        .attr("id", 'feacher-' + (i + 1)).addClass("form-group fallback w-200");


                    newTextDiv.after().html(`

                            <div class="row mt-2">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">${i+1}-</label>
                                    <input type="text" value="${defaultvalues.length>i?defaultvalues[i][0]:""}" name="first_section[ar][feachers][]" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" value="${defaultvalues.length>i?defaultvalues[i][0]:""}" name="first_section[en][feachers][]" class="form-control">
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

        let countfeachers = $('#count_feachers').val()
    </script>
@endpush
