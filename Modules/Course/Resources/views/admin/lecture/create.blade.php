@extends('admin.master')

@section('title', 'إنشاء محاضرة')

@section('title_page', 'إنشاء محاضرة')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
    <link href="{{asset('assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

@endpush


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
                        <h4 class="mb-sm-0">إنشاء محاضرة</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active">إنشاء محاضرة</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">إنشاء محاضرة</h4>

                            <form action="{{ route('admin.lecture.store') }}" method="POST" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb3">
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">العنوان
                                            بالعربي</label>
                                        <div class="col-sm-10">
                                            <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                                                value="{{ old('title_ar') }}" name="title_ar" type="text"
                                                placeholder="الإسم.." id="example-text-input">
                                            @if ($errors->has('title_ar'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('title_ar') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">العنوان
                                            بالإنجليزي</label>
                                        <div class="col-sm-10">
                                            <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}"
                                                value="{{ old('title_en') }}" name="title_en" type="text"
                                                placeholder="..title" id="example-text-input">
                                            @if ($errors->has('title_en'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('title_en') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb3">
                                    <div class="col-lg-12">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">الوصف
                                            بالعربي</label>


                                            <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" class="form-control">{{old("description_ar")}}</textarea>


                                            @if ($errors->has('description_ar'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('description_ar') }}
                                                </div>
                                            @endif

                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">الوصف
                                            بالإنجليزي</label>

                                            <textarea class="elm1 {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en"  class="form-control">{{old("description_en")}}</textarea>
                                            @if ($errors->has('description_en'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('description_en') }}
                                                </div>
                                            @endif

                                    </div>
                                </div>

                                <div class="row mb3">
                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">مدة المحاضرة</label>


                                            <input type="text" class="{{ $errors->has('duration') ? 'is-invalid' : '' }} form-control" name="duration"  value="{{old("duration")}}">


                                            @if ($errors->has('duration'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('duration') }}
                                                </div>
                                            @endif

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">حالة الظهور</label>



                                            <select name="visiable" class="form-control" id="">
                                                <option value="1">يظهر</option>
                                                <option value="0">مخفي</option>
                                            </select>
                                            @if ($errors->has('visiable'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('visiable') }}
                                                </div>
                                            @endif

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">فيديو المحاضرة </label>

                                        <input type="text" class="{{ $errors->has('lecture_link') ? 'is-invalid' : '' }} form-control" name="lecture_link"  value="{{old("lecture_link")}}">
                                        @if ($errors->has('lecture_link'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('lecture_link') }}
                                                </div>
                                            @endif

                                    </div>

                                </div>
                                <div class="row mb3">


                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">صورة المحاضرة</label>

                                        <input type="file"  name="poster" class="{{ $errors->has('poster') ? 'is-invalid' : '' }} form-control">
                                              @if ($errors->has('poster'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('poster') }}
                                                </div>
                                              @endif

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">نوع المحاضرة</label>



                                            <select name="type" class="{{ $errors->has('type') ? 'is-invalid' : '' }} form-control" id="">
                                                <option value="1">مقفلة</option>
                                                <option value="0">مجانية</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('type') }}
                                                </div>
                                            @endif

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">الترتيب</label>

                                        <input type="number" class="{{ $errors->has('order') ? 'is-invalid' : '' }} form-control" name="order"  value="{{old("order")}}">

                                            @if ($errors->has('order'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('order') }}
                                                </div>
                                            @endif

                                    </div>
                                </div>





                                <div class="row mb3">
                                    <div class="col-lg-4">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">الكورس</label>
                                            <select id="course"  name="course" class="{{ $errors->has('course') ? 'is-invalid' : '' }} form-control select2" id="">

                                            </select>
                                            @if ($errors->has('course'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('course') }}
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
    <script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>    <script>
        $("#course").select2({
            placeholder:'اختيار كورس',
            ajax: {
           url: '{{route("admin.api.course.getAll")}}',
           delay: 500,
           dataType: 'json',
          data: function (params) {
              var query = {
               search: params.term,
                type: 'public',
                page: params.page || 1
                }
                // Query parameters will be ?search=[term]&type=public
                return query;
           },
           processResults: function (data,params) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      params.page = params.page || 1;


      return {
        results: data.data,
        pagination: {
             more:data.pagination.more
          }
        };
            },
           results: function (data) {
                return {results: data.data};
            }
            },


         });

    </script>
    @endpush
