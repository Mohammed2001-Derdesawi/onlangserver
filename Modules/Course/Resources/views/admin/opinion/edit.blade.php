@extends('admin.master')

@section('title','تعديل رأي')

@section('title_page','تعديل رأي')

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
                    <h4 class="mb-sm-0">تعديل رأي</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">تعديل رأي</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">تعديل رأي</h4>

                       <form action="{{route('admin.opinion.update',$opinion->id)}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">الرأي بالعربي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('opinion_ar')?'is-invalid':''}}" value="{{$opinion->opinion_ar}}" name="opinion_ar" type="text" placeholder="الرأي.." id="example-text-input">
                                @if ($errors->has('opinion_ar'))
                                <div class="invalid-feedback">
                                    {{$errors->first("opinion_ar")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">الرأي بالإنجليزي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('opinion_en')?'is-invalid':''}}" value="{{$opinion->opinion_en}}" name="opinion_en" type="text" placeholder="..opinion" id="example-text-input">
                                @if ($errors->has('opinion_en'))
                                <div class="invalid-feedback">
                                    {{$errors->first("opinion_en")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                        </div>
                        <div class="row mb3">


                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة الرأي</label>

                                <input type="file"  name="image" class="{{ $errors->has('image') ? 'is-invalid' : '' }} form-control">
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
