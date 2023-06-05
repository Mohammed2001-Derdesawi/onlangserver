@extends('admin.master')

@section('title','احصائيات المستخدم')

@section('title_page','احصائيات المستخدم')

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
                    <h4 class="mb-sm-0">احصائيات المستخدم</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">احصائيات المستخدم</li>
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
                                  احصائيات المستخدم  {{$user->name??''}}
                                </div>

                            </div>
                        </h4>

                        @foreach ($campaigns as $campagin)
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer mb-5 mt-5" id="datatable_wrapper">



                            <div class="row">
                                <h4 class="card-title">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            احصائيات المستخدم في {{$campagin->title_ar}}
                                        </div>

                                    </div>
                                </h4>

                            <div class="col-sm-12 overflow-auto">

                            <table style="border-collapse: collapse; border-spacing: 0px; width: 100%;" id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
                                <thead>
                                    <tr style="cursor: pointer;">
                                        <th>#</th>
                                        <th>المستوى</th>
                                        <th>عدد النقاط الكلية</th>
                                        <th>عدد نقاط المشترك</th>
                                        <th>نوع الإشتراك</th>
                                        <th>المبلغ المحصل</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($campagin->levels as $level)

                                     @php
                                         $userlevel=$user->levels->firstWhere('level_id',$level->id);
                                     @endphp
                                    <tr data-id="1" style="cursor: pointer;">
                                        <td data-field="id" style="width: 80px">{{  $loop->index+1 }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->title_ar }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $level->total_point }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $userlevel?$userlevel->points:0 }}</td>
                                        <td data-field="age" style="width: 182.783px;">{{ $user->campaign_type=='course'?'كورسات':'أموال' }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $userlevel?$userlevel->points*$level->point_price:0 }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                    </div>


                                </div>


                        </div>
                        @endforeach
                    </div>
                </div>
            </div> <!-- end col -->
        </div>




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                 عمليات السحب للمستخدم
                                </div>
                                <div class="col-sm-12 col-md-12 mt-5">
                                  المبلغ الكلي في المحفظة {{ $user->wallet?$user->wallet->total:0 }}
                                </div>

                            </div>
                        </h4>
                        @if ($user->wallet)



                        <div class="dataTables_wrapper dt-bootstrap4 no-footer mb-5 mt-5 " id="datatable_wrapper">



                            <div class="row">


                            <div class="col-sm-12 overflow-auto">

                            <table style="border-collapse: collapse; border-spacing: 0px; width: 100%;" id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
                                <thead>
                                    <tr style="cursor: pointer;">
                                        <th>#</th>
                                        <th>المبلغ</th>
                                        <th>تاريخ السحب</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($user->wallet->withdraws as $withdraw)
                                    <tr data-id="1" style="cursor: pointer;">
                                        <td data-field="id" style="width: 80px">{{  $loop->index+1 }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $withdraw->total }}</td>
                                        <td data-field="name" style="width: 445.65px;">{{ $withdraw->withdraw_date }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                    </div>


                                </div>


                        </div>

                        @else
                         <span class="text-center">لم يتم إيجاد عمليات سحب للمستخدم</span>
                         @endif
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
