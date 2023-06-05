@extends('admin.master')

@section('title','الأراء')

@section('title_page','الأراء')

@section('content')
@php
$admin=auth()->guard('admin')->user();
 @endphp
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
                    <h4 class="mb-sm-0">الأراء</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">الأراء</li>
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
                                    الأراء
                                </div>
                                <div class="col-sm-12 col-md-6" style="text-align: left">
                                    <a href="{{route('admin.opinion.create')}}" class="btn btn-primary">إنشاء</a>
                                </div>
                            </div>
                        </h4>

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer" id="datatable_wrapper">

                                 <form action="" class="row">
                                    <div class="col-sm-12 col-md-6" >
                                        <div id="datatable_filter" class="dataTables_filter" style="text-align: right !important">
                                            <label>بحث:<input name="search" value="{{request('search')}}" type="search" placeholder="بحث عن..." class="form-control form-control-sm" placeholder="" aria-controls="datatable"></label>
                                            <span style="margin-right: 8px;">عدد الأراء:{{$info->count}}</span>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="datatable_length" style="text-align: left">
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
                                        <th>الرأي باللغة العربية</th>
                                        <th>الرأي باللغة الإنجليزية</th>
                                        <th>صورة الرأي</th>
                                        <th>تاريخ الإنشاء</th>
                                        <th>الأكشن</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($opinions as $opinion)


                                    <tr data-id="1" style="cursor: pointer;">
                                        <td data-field="id" style="width: 80px">{{ $opinions->firstItem() + $loop->index }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $opinion->opinion_ar }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $opinion->opinion_en }}</td>
                                        <td data-field="name" style="width: 445.65px;"><img src="{{asset($opinion->image)}}" width="150" height="150" alt=""></td>
                                        <td data-field="age" style="width: 182.783px;">{{ $opinion->created_at->format('y-m-d') }}</td>
                                        <td style="width: 200px;" class="d-flex justify-content-center">
                                            @if ($admin->can('تعديل رأي') || $admin->can('جميع الصلاحيات super_admin')  )

                                            <a class="btn btn-outline-secondary btn-sm edit" href="{{route('admin.opinion.edit',$opinion->id)}}" title="تعديل">
                                                <i class="fas fa-pencil-alt" title="تعديل"></i>
                                            </a>
                                            @endif
                                            @if ($admin->can('حذف رأي') || $admin->can('جميع الصلاحيات super_admin')  )

                                             <form action="{{route('admin.opinion.delete',$opinion->id)}}" id="deleteform{{$opinion->id}}" method="POST" style="margin-right:4px;">
                                                @csrf
                                                <button type="submit" onclick="JSconfirm(event,{{$opinion->id}})" class="btn btn-outline-secondary btn-sm edit">

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
                                {!! $opinions->withQueryString()->links() !!}

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
