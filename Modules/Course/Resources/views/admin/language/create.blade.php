@extends('admin.master')

@section('title','إنشاء لغة')

@section('title_page','إنشاء لغة')

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
                    <h4 class="mb-sm-0">إنشاء لغة</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">إنشاء لغة</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">إنشاء لغة</h4>

                       <form action="{{route('admin.language.store')}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">العنوان بالعربي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('title_ar')?'is-invalid':''}}" value="{{old('title_ar')}}" name="title_ar" type="text" placeholder="الإسم.." id="example-text-input">
                                @if ($errors->has('title_ar'))
                                <div class="invalid-feedback">
                                    {{$errors->first("title_ar")}}
                                  </div>

                                @endif
                            </div>

                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">العنوان بالإنجليزي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('title_en')?'is-invalid':''}}" value="{{old('title_en')}}" name="title_en" type="text" placeholder="..title" id="example-text-input">
                                @if ($errors->has('title_en'))
                                <div class="invalid-feedback">
                                    {{$errors->first("title_en")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">صورة اللغة</label>

                            <input type="file"  name="picture" class="{{ $errors->has('picture') ? 'is-invalid' : '' }} form-control">
                                  @if ($errors->has('picture'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('picture') }}
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
