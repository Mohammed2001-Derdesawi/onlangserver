@extends('admin.master')

@section('title','تعديل معلم')

@section('title_page','تعديل معلم')

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
              {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">تعديل معلم</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">تعديل معلم</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">تعديل معلم</h4>

                       <form action="{{route('admin.teacher.update',$teacher->id)}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-4">
                            <label for="example-text-input" class="col-sm-4 col-form-label">الإسم بالعربي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('name_ar')?'is-invalid':''}}" value="{{$teacher->name_ar}}" name="name_ar" type="text" placeholder="الإسم.." id="example-text-input">
                                @if ($errors->has('name_ar'))
                                <div class="invalid-feedback">
                                    {{$errors->first("name_ar")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-4">
                            <label for="example-text-input" class="col-sm-4 col-form-label">الإسم بالإنجليزي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('name_en')?'is-invalid':''}}" value="{{$teacher->name_en}}" name="name_en" type="text" placeholder="..name" id="example-text-input">
                                @if ($errors->has('name_en'))
                                <div class="invalid-feedback">
                                    {{$errors->first("name_en")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-4">
                            <label for="example-text-input" class="col-sm-4 col-form-label">البريد الإلكتروني</label>



                            <input type="email" value="{{$teacher->email}}"  name="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }} form-control">

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif

                        </div>
                        </div>
                        <div class="row mb3">
                            <div class="col-lg-12">
                                <label for="example-text-input" class="col-sm-2 col-form-label">الوصف
                                    بالعربي</label>


                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" class="form-control">{{$teacher->description_ar}}</textarea>


                                    @if ($errors->has('description_ar'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description_ar') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-12 mt-2">
                                <label for="example-text-input" class="col-sm-2 col-form-label">الوصف
                                    بالإنجليزي</label>

                                    <textarea class="elm1 {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en"  class="form-control">{{$teacher->description_en}}</textarea>
                                    @if ($errors->has('description_en'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description_en') }}
                                        </div>
                                    @endif

                            </div>
                        </div>
                        <div class="row mb3">


                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة المعلم</label>

                                <input type="file"  name="image" class="{{ $errors->has('image') ? 'is-invalid' : '' }} form-control">
                                      @if ($errors->has('image'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('image') }}
                                        </div>
                                      @endif

                            </div>

                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">فيديو التقديمي للمعلم</label>



                                <input type="url" value="{{$teacher->preview_video}}"  name="preview_video" class="{{ $errors->has('preview_video') ? 'is-invalid' : '' }} form-control">

                                    @if ($errors->has('preview_video'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('preview_video') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">الكورس</label>
                                    <select id="course"  name="courses[]" class="{{ $errors->has('course') ? 'is-invalid' : '' }} form-control select2" id="">
                                       @foreach ($teacher->courses as $course)
                                              <option value="{{$course->id}}">{{$course->title_ar}}</option>
                                       @endforeach
                                    </select>
                                    @if ($errors->has('course'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('course') }}
                                        </div>
                                    @endif

                            </div>


                        </div>


                        <div class="row mb3">

                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-4 col-form-label">الدراسات الخاصة</label>
                                <select   name="has_private_learning" class="{{ $errors->has('has_private_learning') ? 'is-invalid' : '' }} form-control" id="">
                                  <option value="1" {{ $teacher->has_private_learning=='1'?'selected':''  }}>نعم</option>
                                  <option value="0" {{ $teacher->has_private_learning=='0'?'selected':''  }}>لا</option>
                                </select>
                                @if ($errors->has('has_private_learning'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('has_private_learning') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-4 col-form-label">رابط مقدمة المعلم للدراسات الخاصة</label>



                                <input  value="{{$teacher->private_video}}"  name="private_video" class="{{ $errors->has('private_video') ? 'is-invalid' : '' }} form-control">

                                    @if ($errors->has('private_video'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('private_video') }}
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
<script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>
   <script>
  var coursesids=@json($teacher->courses);

   coursesids=coursesids.map((i)=>i["id"]);
    $("#course").select2({
        placeholder:'اختيار كورس',
        multiple:true,
        ajax: {
       url: '{{route("admin.api.course.getAll")}}',
       delay: 500,
       minimumInputLength: 3,
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
     $("#course").val(coursesids).trigger('change')


</script>
@endpush
