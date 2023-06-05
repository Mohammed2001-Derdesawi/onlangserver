@extends('admin.master')

@section('title','إنشاء مستخدم')

@section('title_page','إنشاء مستخدم')

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
                    <h4 class="mb-sm-0">إنشاء مستخدم</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">إنشاء مستخدم</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">إنشاء مستخدم</h4>

                       <form action="{{route('admin.admins.update',$admin->id )}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">اسم المستخدم</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('name')?'is-invalid':''}}" value="{{$admin->name}}" name="name" type="text" placeholder="الإسم.." id="example-text-input">
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
                                <input class="form-control {{$errors->has('email')?'is-invalid':''}}" value="{{$admin->email}}" name="email" type="email" placeholder="البريد الإلكتروني" id="example-text-input">
                                @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{$errors->first("email")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                        </div>
                        <div class="row mb3">
                           <div class="col-lg-4">
                            <label for="example-text-input" class="col-sm-4 col-form-label">كلمة السر</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('password')?'is-invalid':''}}" value="{{old('password')}}" name="password" type="password" placeholder="كلمة السر" id="example-text-input">
                                @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{$errors->first("password")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-4">
                            <label for="example-text-input" class="col-sm-4 col-form-label">إعادة كلمة السر</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('password_confirmation')?'is-invalid':''}}" value="{{old('password_confirmation')}}" name="password_confirmation" type="password" placeholder="إعادة كلمة السر" id="example-text-input">
                                @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    {{$errors->first("password_confirmation")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-4">
                            <label for="example-text-input" class="col-sm-4 col-form-label">صورة المستخدم</label>
                            <input class="form-control {{$errors->has('image')?'is-invalid':''}}" name="image" type="file" id="example-text-input">

                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif

                        </div>
                        </div>

                        <div class="row mb3">

                            <div class="col-lg-6">
                             <label for="example-text-input" class="col-sm-2 col-form-label">الصلاحيات</label>
                             <div class="col-sm-10">

                                 <select name="roles[]" multiple  id="roles" data-placeholder="الصلاحيات ..." class="form-control {{$errors->has('roles')?'is-invalid':''}} select2">
                                     @foreach ($roles as $role)
                                       <option value="{{ $role->id }}">{{ $role->name }}</option>
                                     @endforeach
                                 </select>
                                 @if ($errors->has('roles'))
                                 <div class="invalid-feedback">
                                     {{$errors->first("roles")}}
                                   </div>

                                 @endif
                             </div>
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
<script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>
   <script>
    var roles=@json($admin->roles);
    roles=roles.map((i)=>i["id"]);
    $("#roles").select2({
        placeholder:'اختيار الصلاحيات',
        multiple:true,

    })
    $("#roles").val(roles).trigger('change')


</script>
@endpush
