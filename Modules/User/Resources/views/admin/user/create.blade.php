@extends('admin.master')

@section('title','إنشاء طالب')

@section('title_page','إنشاء طالب')

@push('css')
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
                    <h4 class="mb-sm-0">إنشاء طالب</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">إنشاء طالب</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">إنشاء طالب</h4>

                       <form action="{{route('admin.student.store')}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">اسم الطالب</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('name')?'is-invalid':''}}" value="{{old('name')}}" name="name" type="text" placeholder="الإسم.." id="example-text-input">
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{$errors->first("name")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">البريد الإلكتروني</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('email')?'is-invalid':''}}" value="{{old('email')}}" name="email" type="email" placeholder="البريد الإلكتروني" id="example-text-input">
                                @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{$errors->first("email")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                        </div>
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">كلمة السر</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('password')?'is-invalid':''}}" value="{{old('password')}}" name="password" type="password" placeholder="كلمة السر" id="example-text-input">
                                @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{$errors->first("password")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">إعادة كلمة السر</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('password_confirmation')?'is-invalid':''}}" value="{{old('password_confirmation')}}" name="password_confirmation" type="password" placeholder="إعادة كلمة السر" id="example-text-input">
                                @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    {{$errors->first("password_confirmation")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                        </div>
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">العمر</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('age')?'is-invalid':''}}" value="{{old('age')}}" name="age" type="text" placeholder="العمر" id="example-text-input">
                                @if ($errors->has('age'))
                                <div class="invalid-feedback">
                                    {{$errors->first("age")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">الجنس</label>
                            <div class="col-sm-10">
                                <select name="gender" class="{{$errors->has('gender')?'is-invalid':''}} form-control" id="">
                                    <option value="male">ذكر</option>
                                    <option value="female">أنثى</option>
                                </select>
                                @if ($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{$errors->first("gender")}}
                                </div>

                                @endif
                            </div>
                           </div>
                        </div>
                        <div class="row mb3">
                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-2 col-form-label">الكورسات</label>
                                    <select id="course"  name="courses[]" class="{{ $errors->has('course') ? 'is-invalid' : '' }} form-control select2" id="">

                                    </select>
                                    @if ($errors->has('course'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('course') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-2 col-form-label">رقم الجوال</label>
                                <div class="col-sm-10">
                                    <input class="form-control {{$errors->has('phone')?'is-invalid':''}}" value="{{old('phone')}}" name="phone" type="phone" placeholder="رقم الجوال" id="example-text-input">
                                    @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{$errors->first("phone")}}
                                      </div>

                                    @endif
                                </div>
                               </div>

                        </div>
                        <div class="row mb3">
                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-2 col-form-label">صورة الطالب</label>
                                <input class="form-control {{$errors->has('image')?'is-invalid':''}}" value="{{old('image')}}" name="image" type="file" id="example-text-input">

                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('image') }}
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
<script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>    <script>
    $("#course").select2({
        placeholder:'اختيار كورس',
        multiple:true,
        ajax: {
       url: '{{route("admin.api.course.getAll")}}',
       delay: 250,
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
