@extends('admin.master')

@section('title','تعديل فيديو')

@section('title_page','تعديل فيديو')

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
                    <h4 class="mb-sm-0">تعديل فيديو</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">تعديل فيديو</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">تعديل فيديو</h4>

                       <form action="{{route('admin.various.update',$various->id)}}" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb3">
                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-2 col-form-label">العنوان
                                    بالعربي</label>
                                <div class="col-sm-10">
                                    <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                                        value="{{ $various->title_ar }}" name="title_ar" type="text"
                                        placeholder="الإسم.." id="example-text-input">
                                    @if ($errors->has('title_ar'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title_ar') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="example-text-input" class="col-sm-2 col-form-label">العنوان
                                    بالإنجليزي</label>
                                <div class="col-sm-10">
                                    <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}"
                                        value="{{ $various->title_en }}" name="title_en" type="text"
                                        placeholder="..title" id="example-text-input">
                                    @if ($errors->has('title_en'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title_en') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb3">
                            <div class="col-lg-12">
                                <label for="example-text-input" class="col-sm-2 col-form-label">وصف
                                    بالعربي</label>


                                    <textarea class="elm1 {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" class="form-control">{{$various->description_ar}}</textarea>


                                    @if ($errors->has('description_ar'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description_ar') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-12 mt-2">
                                <label for="example-text-input" class="col-sm-2 col-form-label">وصف
                                    بالإنجليزي</label>

                                    <textarea class="elm1 {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en"  class="form-control">{{$various->description_en}}</textarea>
                                    @if ($errors->has('description_en'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description_en') }}
                                        </div>
                                    @endif

                            </div>
                        </div>
                        <div class="row mb3">
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">رابط الفيديو</label>


                                    <input class="form-control {{ $errors->has('path') ? 'is-invalid' : '' }}"
                                    value="{{ $various->path }}" name="path" type="text"
                                    placeholder="الرابط" id="example-text-input">

                                    @if ($errors->has('path'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('path') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-4 mt-2">
                                <label for="example-text-input" class="col-sm-4 col-form-label">صورة للفيديو</label>

                                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image" type="file"
                                 id="example-text-input">
                                @if ($errors->has('image'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="col-lg-4 mt-2">
                                <label for="example-text-input" class="col-sm-4 col-form-label">نوع الفيديو </label>

                                 <select name="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" id="">
                                    <option value="free" {{$various->type=="free"?'selected':''}}>مجاني</option>
                                    <option value="paid" {{$various->type=="paid"?'selected':''}}>مدفوع</option>
                                </select>
                                @if ($errors->has('type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type') }}
                                        </div>
                                    @endif

                            </div>
                        </div>
                        <div class="row mb3">
                            <div class="col-lg-4">
                                <label for="example-text-input" class="col-sm-4 col-form-label">playlist</label>
                                    <select id="group"  name="group" class="{{ $errors->has('group') ? 'is-invalid' : '' }} form-control select2" id="">
                                      @if ($various->group)
                                        <option value="{{$various->group->id}}">{{$various->group->title_ar}}</option>
                                      @endif
                                    </select>
                                    @if ($errors->has('group'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('group') }}
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
<script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>
   <script>
    $("#group").select2({
        placeholder:'اختيار playlist',
        ajax: {
       url: '{{route("admin.api.group.getAll")}}',
       delay: 500,
       minimumInputLength: 3,
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
     var group="{{$various->group?$various->group->id:''}}";
     $("#course").val(group).trigger('change')


</script>
@endpush
