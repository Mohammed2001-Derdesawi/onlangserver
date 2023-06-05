@extends('admin.master')

@section('title','المستويات')

@section('title_page','المستويات')
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
                    <h4 class="mb-sm-0">المستويات</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">المستويات</li>
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
                                    المستويات
                                </div>
                                <div class="col-sm-12 col-md-6" style="text-align: left">
                                    <a href="{{route('admin.level.create')}}" class="btn btn-primary">إنشاء</a>
                                </div>
                            </div>
                        </h4>

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer" id="datatable_wrapper">

                                 <form action="" >
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6" >
                                            <div id="datatable_filter" class="dataTables_filter" style="text-align: right !important">
                                                <label>بحث:<input name="search" value="{{request('search')}}" type="search" placeholder="بحث عن..." class="form-control form-control-sm" placeholder="" aria-controls="datatable"></label>
                                                 <span style="margin-right: 8px;">عدد المستويات:{{$info->count}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="dataTables_length" id="datatable_length" style="text-align: left">
                                                <label>عرض
                                                    <select onchange="this.form.submit()" name="paginate" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                                        <option  {{request('paginate')==10?'selected':''}} value="10">10</option>
                                                        <option {{request('paginate')==25?'selected':''}} value="25">25</option>
                                                        <option {{request('paginate')==50?'selected':''}} value="50">50</option>
                                                    </select></label>
                                                </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
                                            <div class="dataTables_length" id="datatable_length">
                                                <label>
                                                    النظام
                                                </label>
                                                    <select onchange="this.form.submit()" name="campaign" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                                         <option value="">اختيار نظام تربح</option>
                                                        @foreach ($campaigns as $campaign)

                                                        <option {{request('campaign')==$campaign->id?'selected':''}} value="{{$campaign->id}}">{{$campaign->title_ar}}</option>

                                                        @endforeach
                                                    </select>

                                                </div>
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
                                        <th>اسم نظام التربح</th>
                                        <th>مجموع النقاط</th>
                                        <th>عدد النقاط /1</th>
                                        <th>سعر النقطة</th>
                                        <th>الترتيب</th>
                                        <th>الأكشن</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($levels as $level)


                                    <tr data-id="1" style="cursor: pointer;">
                                        <td data-field="id" style="width: 80px">{{ $levels->firstItem() + $loop->index }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->title_ar }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->title_en }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->campaign->title_ar }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->total_point }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->point_per_one }}</td>
                                        <td data-field="age" style="width: 182.783px;">{{ $level->point_price }}</td>
                                        <td data-field="age" style="width: 182.783px;">{{ $level->order }}</td>

                                        <td style="width: 200px;" class="d-flex justify-content-center">
                                            @if ($admin->can('تعديل مستوى') || $admin->can('جميع الصلاحيات super_admin')  )

                                            <a class="btn btn-outline-secondary btn-sm edit" href="{{route('admin.level.edit',$level->id)}}" title="تعديل">
                                                <i class="fas fa-pencil-alt" title="تعديل"></i>
                                            </a>
                                            @endif
                                            @if ($admin->can('حذف مستوى') || $admin->can('جميع الصلاحيات super_admin')  )

                                             <form action="{{route('admin.level.delete',$level->id)}}" id="deleteform{{$level->id}}" method="POST" style="margin-right:4px;">
                                                @csrf
                                                <button type="submit" onclick="JSconfirm(event,{{$level->id}})" class="btn btn-outline-secondary btn-sm edit">

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
                                {!! $levels->withQueryString()->links() !!}

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
