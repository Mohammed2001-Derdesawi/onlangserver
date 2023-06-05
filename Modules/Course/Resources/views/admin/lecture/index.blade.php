@extends('admin.master')

@section('title','المحاضرات')

@section('title_page','المحاضرات')
@php
$admin=auth()->guard('admin')->user();
 @endphp
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
                    <h4 class="mb-sm-0">المحاضرات</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">المحاضرات</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    المحاضرات
                                </div>
                                <div class="col-sm-12 col-md-6" style="text-align: left">
                                    <a href="{{route('admin.lecture.create')}}" class="btn btn-primary">إنشاء</a>
                                </div>
                            </div>
                        </h4>

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer" id="datatable_wrapper">

                                 <form action="" class="row">
                                    <div class="col-sm-12 col-md-6" >
                                        <div id="datatable_filter" class="dataTables_filter" style="text-align: right !important">
                                            <label>بحث:<input name="search" value="{{request('search')}}" type="search" placeholder="بحث عن..." class="form-control form-control-sm" placeholder="" aria-controls="datatable"></label>
                                            <span style="margin-right: 8px;">عدد المحاضرات:{{$info->count}}</span>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="datatable_length" style="text-align: left !important">
                                            <label>عرض
                                                <select onchange="this.form.submit()" name="paginate" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                                    <option  {{request('paginate')==10?'selected':''}} value="10">10</option>
                                                    <option {{request('paginate')==25?'selected':''}} value="25">25</option>
                                                    <option {{request('paginate')==50?'selected':''}} value="50">50</option>
                                                </select></label>
                                            </div>
                                    </div>
                                 </form>


                                <div class="row">
                                    <div class="col-sm-12 overflow-auto">

                            <table style="border-collapse: collapse; border-spacing: 0px; width: 100%;" id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
                                <thead>
                                    <tr style="cursor: pointer;">
                                        <th>#</th>
                                        <th>العنوان بالعربي</th>
                                        <th>العنوان بالإنجليزي</th>
                                        <th>مدة المحاضرة </th>
                                        <th>الكورس</th>
                                        <th>تاريخ الإنشاء</th>
                                        <th>الترتيب</th>
                                        <th>النوع</th>
                                        <th>الأكشن</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($lectures as $lecture)


                                    <tr data-id="1" style="cursor: pointer;">
                                        <td data-field="id" style="width: 80px">{{ $lectures->firstItem() + $loop->index }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $lecture->title_ar }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $lecture->title_en }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $lecture->duration }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $lecture->course->title_ar }}</td>
                                        <td data-field="age" style="width: 182.783px;">{{ $lecture->created_at->format('y-m-d') }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $lecture->order }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $lecture->type==1?'مقفلة':'مجانية'}}</td>
                                        <td style="width: 200px;" class="d-flex justify-content-center ">
                                            @if ($admin->can('تعديل محاضرة') || $admin->can('جميع الصلاحيات super_admin')  )

                                            <a class="btn btn-outline-secondary btn-sm edit text-primary" href="{{route('admin.lecture.edit',$lecture->id)}}" title="تعديل">
                                                <i class="fas fa-pencil-alt" title="تعديل"></i>
                                            </a>
                                            @endif
                                            @if ($admin->can('رفع ملف محاضرة') || $admin->can('جميع الصلاحيات super_admin')  )

                                            <a class="btn btn-outline-secondary btn-sm edit text-success" href="{{route('admin.lecture.upload.page',$lecture->id)}}" style="margin:0 4px;" title="رفع ملف">
                                                <i class="fas fa-upload" title="رفع ملف"></i>
                                            </a>
                                            @endif
                                            @if ($admin->can('حذف محاضرة') || $admin->can('جميع الصلاحيات super_admin')  )

                                             <form action="{{route('admin.lecture.delete',$lecture->id)}}" id="deleteform{{$lecture->id}}" method="POST" style="margin-right:4px;">
                                                @csrf
                                                <button type="submit" onclick="JSconfirm(event,{{$lecture->id}})" class="btn btn-outline-secondary btn-sm edit text-danger">

                                                        <i class="fas fa-trash" title="حذف"></i>

                                                </button>
                                             </form>
                                             @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                    </div>
                                </div>
                                {!! $lectures->withQueryString()->links() !!}

                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end page title -->

    </div> <!-- container-fluid -->
</div>

@endsection


@push('js')
<script src="{{asset('assets/admin/js/swal.js')}}"></script>
@endpush
