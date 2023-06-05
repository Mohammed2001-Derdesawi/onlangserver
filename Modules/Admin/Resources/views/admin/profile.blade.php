@extends('admin.master')
@section('title','الصفحة الشخصية')
@section('css')

@endsection
@section('title_page','الصفحة الشخصية')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">الملف الشخصي</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="route('admin.dashboard')">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">الملف الشخصي</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>


<div class="row">
        <div class="col-lg-2">
            <div class="col-md-6">
                <div class="mt-4 mt-md-0">
                    @php
                        $src=$admin->image?asset($admin->image):asset('assets/admin/images/users/avatar-2.jpg');
                    @endphp
                    <img class="rounded-circle avatar-xl" alt="200x200" src="{{$src}}" data-holder-rendered="true">
                </div>
            </div>
        </div>
    <div class="col-xl-10 col-xxl-10 col-lg-10">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">تعديل الملف الشخصي</h4>

                <form action="{{route('admin.update.myprofile')}}" method="POST" class="" enctype="multipart/form-data">
                 @csrf
                 <div class="row mb3">
                    <div class="col-lg-6">
                     <label for="example-text-input" class="col-sm-2 col-form-label">الإسم</label>
                     <div class="col-sm-10">
                         <input class="form-control {{$errors->has('name')?'is-invalid':''}}" value="{{$admin->name}}" name="name" type="text" placeholder="الإسم.." id="example-text-input">
                         @if ($errors->has('name'))
                         <div class="invalid-feedback">
                             {{$errors->first("name")}}
                           </div>

                         @endif
                     </div>
                    </div>

                     @if($admin->can('جميع الصلاحيات super_admin'))
                     <div class="col-lg-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">البريد الإلكتروني</label>
                        <div class="col-sm-10">
                            <input class="form-control {{$errors->has('email')?'is-invalid':''}}" value="{{$admin->email}}" name="email" type="email" placeholder="البريد الإلكتروني" id="example-text-input">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{$errors->first("email")}}
                              </div>

                            @endif
                        </div>
                       </div>
                       <div class="col-lg-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">كلمة المرور</label>
                        <div class="col-sm-10">
                            <input class="form-control {{$errors->has('password')?'is-invalid':''}}"  name="password" type="password" placeholder="كلمة المرور" id="example-text-input">
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{$errors->first("password")}}
                              </div>

                            @endif
                        </div>
                       </div>
                       <div class="col-lg-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">تأكيد كلمة المرور</label>
                        <div class="col-sm-10">
                            <input class="form-control {{$errors->has('password_confirmation')?'is-invalid':''}}" name="password_confirmation" type="password" placeholder="تأكيد كلمة المرور" id="example-text-input">
                            @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{$errors->first("password_confirmation")}}
                              </div>

                            @endif
                        </div>
                       </div>
                     @endif


                    <div class="col-lg-6">
                        <label for="example-text-input" class="col-sm-2 col-form-label">الصورة</label>
                        <div class="col-sm-10">
                            <input name="image" class="form-control {{$errors->has('image')?'is-invalid':''}}" type="file">
                            @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                {{$errors->first("image")}}
                              </div>

                            @endif
                        </div>
                       </div>
                       <div class="mt-4">
                        <button class="btn btn-primary" type="submit">حفظ</button>
                    </div>
                 </div>
                </form>

            </div>
        </div>
    </div>
</div>

    </div>
</div>

@endsection
@section('scripts')

<script src="{{asset('assets/admin/vendor/svganimation/vivus.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/svganimation/svg.animation.js')}}"></script>



@endsection

