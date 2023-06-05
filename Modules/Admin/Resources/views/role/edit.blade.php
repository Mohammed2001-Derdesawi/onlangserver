@extends('admin.master')

@section('title','تعديل صلاحية')

@section('title_page','تعديل صلاحية')

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
                    <h4 class="mb-sm-0">تعديل صلاحية</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">تعديل صلاحية</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">تعديل صلاحية</h4>

                       <form action="{{route('admin.role.update',$role->id)}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">اسم المستخدم</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('title')?'is-invalid':''}}" value="{{$role->name}}" name="title" type="text" placeholder="الإسم.." id="example-text-input">
                                @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{$errors->first("title")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">الأذونات</label>
                            <div class="col-sm-10">

                                <select name="permissions[]" multiple  id="permissions" data-placeholder="الأذونات ..." class="form-control {{$errors->has('permissions')?'is-invalid':''}} select2">
                                    @foreach ($permissions as $permission)
                                      <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('permissions'))
                                <div class="invalid-feedback">
                                    {{$errors->first("permissions")}}
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
    var permissions=@json($role->permissions);
    permissions=permissions.map((i)=>i["id"]);
    $("#permissions").select2({
        placeholder:'اختيار أذونات',
        multiple:true,

    })
    $("#permissions").val(permissions).trigger('change')


</script>
@endpush
