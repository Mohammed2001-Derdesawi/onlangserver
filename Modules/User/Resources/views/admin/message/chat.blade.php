@extends('admin.master')

@section('title','إرسال رسالة')

@section('title_page','إرسال رسالة')
@push('css')
{{-- <link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}"> --}}
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
                    <h4 class="mb-sm-0">الرسائل الواردة</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">الرسائل الواردة</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

       <chat  :admin={{auth()->guard('admin')->user()->id}}></chat>

        <!-- end page title -->

    </div> <!-- container-fluid -->
</div>

@endsection


