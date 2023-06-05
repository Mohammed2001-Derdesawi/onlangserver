@extends('admin.master')

@section('title','إنشاء مستوى')

@section('title_page','إنشاء مستوى')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/libs/tinymce/skins/ui/oxide/skin.min.css') }}">
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
                    <h4 class="mb-sm-0">إنشاء مستوى</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">إنشاء مستوى</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">إنشاء مستوى</h4>

                       <form action="{{route('admin.level.store')}}" method="POST" class="">
                        @csrf
                        <div class="row mb3">
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-4 col-form-label">العنوان بالعربي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('title_ar')?'is-invalid':''}}" value="{{old('title_ar')}}" name="title_ar" type="text" placeholder="عنوان المستوى .." id="example-text-input">
                                @if ($errors->has('title_ar'))
                                <div class="invalid-feedback">
                                    {{$errors->first("title_ar")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                           <div class="col-lg-6">
                            <label for="example-text-input" class="col-sm-4 col-form-label">عنوان بالإنجليزي</label>
                            <div class="col-sm-10">
                                <input class="form-control {{$errors->has('title_en')?'is-invalid':''}}" value="{{old('title_en')}}" name="title_en" type="text" placeholder="عنوان المستوى .." id="example-text-input">
                                @if ($errors->has('title_en'))
                                <div class="invalid-feedback">
                                    {{$errors->first("title_en")}}
                                  </div>

                                @endif
                            </div>
                           </div>
                        </div>
                        <div class="row mb3">
                            <div class="col-lg-12">
                                <label for="example-text-input" class="col-sm-4 col-form-label">الوصف
                                    بالعربي</label>


                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" class="form-control">{{old("description_ar")}}</textarea>


                                    @if ($errors->has('description_ar'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description_ar') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-12 mt-2">
                                <label for="example-text-input" class="col-sm-2 col-form-label">الوصف
                                    بالإنجليزي</label>

                                    <textarea class="elm1 {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en"  class="form-control">{{old("description_en")}}</textarea>
                                    @if ($errors->has('description_en'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description_en') }}
                                        </div>
                                    @endif

                            </div>
                        </div>

                        <div class="row mb3">
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">النقاط الكلية للمستوى</label>
                                <input class="form-control {{$errors->has('total_point')?'is-invalid':''}}" value="{{old('total_point')}}" name="total_point" type="text" id="example-text-input">
                                @if ($errors->has('total_point'))
                                <div class="invalid-feedback">
                                    {{$errors->first("total_point")}}
                                  </div>

                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">سعر النقطة</label>
                                <input class="form-control {{$errors->has('point_price')?'is-invalid':''}}" value="{{old('point_price')}}" name="point_price" type="text" id="example-text-input">
                                @if ($errors->has('point_price'))
                                <div class="invalid-feedback">
                                    {{$errors->first("point_price")}}
                                  </div>

                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">عدد النقاط للشخص الواحد</label>
                                <input class="form-control {{$errors->has('point_per_one')?'is-invalid':''}}" value="{{old('point_per_one')}}" name="point_per_one" type="text" id="example-text-input">
                                @if ($errors->has('point_per_one'))
                                <div class="invalid-feedback">
                                    {{$errors->first("point_per_one")}}
                                  </div>

                                @endif
                            </div>
                        </div>

                        <div class="row mb3">
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">ترتيب المستوى</label>
                                <input class="form-control {{$errors->has('order')?'is-invalid':''}}" value="{{old('order')}}" name="order" type="text" id="example-text-input">
                                @if ($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{$errors->first("order")}}
                                  </div>

                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">نظام التربح</label>
                                 <select name="campaign" class="form-control" id="">
                                    @foreach ($campaigns as $campaign)
                                    <option value="{{$campaign->id}}" {{ old('campaign')==$campaign->id?'selected':''}}>{{$campaign->title_ar}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('campaign'))
                                <div class="invalid-feedback">
                                    {{$errors->first("campaign")}}
                                  </div>

                                @endif
                                <span class="text-danger">
                                    *ملاحظة:لا يمكن تعديل  نظام التربح عند حفظ التغييرات
                                </span>
                            </div>

                                <div class="col-lg-4">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">جوائز المستوى</label>
                                        <select id="course"  name="courses[]" class="{{ $errors->has('course') ? 'is-invalid' : '' }} form-control select2" id="">

                                        </select>
                                        @if ($errors->has('course'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('course') }}
                                            </div>
                                        @endif

                                </div>



                        </div>
                        <div class="row mb3">
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">سعر النقطة بعد إنتهاء المستوى</label>
                                <input class="form-control {{$errors->has('point_price_after_done')?'is-invalid':''}}" value="{{old('point_price_after_done')}}" name="point_price_after_done" type="text" id="example-text-input">
                                @if ($errors->has('point_price_after_done'))
                                <div class="invalid-feedback">
                                    {{$errors->first("point_price_after_done")}}
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

@push('js')
<script src="{{ asset('assets/admin/libs/tinymce/tinymce.min.js') }}"></script>

<script src="{{ asset('assets/admin/js/pages/form-editor.init.js') }}"></script>
<script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>    <script>
    $("#course").select2({
        placeholder:'اختيار جوائز المستوى',
        ajax: {
       url: '{{route("admin.api.course.getAll")}}',
       delay: 500,
       dataType: 'json',
      data: function (params) {
          var query = {
           search: params.term,
            type: 'public',
            page: params.page || 1
            }
            // Query parameters will be ?search=[term]&type=public
            return query;
       },
       processResults: function (data,params) {
  // Transforms the top-level key of the response object from 'items' to 'results'
  params.page = params.page || 1;


  return {
    results: data.data,
    pagination: {
         more:data.pagination.more
      }
    };
        },
       results: function (data) {
            return {results: data.data};
        }
        },


     });

</script>
@endpush
