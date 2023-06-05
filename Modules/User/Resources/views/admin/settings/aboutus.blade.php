@extends('layouts.admin.master')
@section('title','تعديل إعدادات صفحة معلومات عن الموقع')
@section('css')

@endsection
@section('title_page','تعديل إعدادات صفحة معلومات عن الموقع')

@section('content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>تعديل إعدادات صفحة معلومات عن الموقع</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">

            <li class="breadcrumb-item active"><a href="javascript:void(0);">تعديل إعدادات صفحة معلومات عن الموقع</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a></li>

        </ol>
    </div>
</div>
@php
    $settings=cache()->get('settings.aboutus')??['description_ar'=>'','description_en'=>'','description_ar_seconed'=>'','description_en_seconed'=>'','image'=>'','feachers'=>[]];

@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">تفاصيل صفحة عن الموقع</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.settings.aboutus.edit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">





                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">الوصف باللغة العربية للقسم الأول</label>

                                 <textarea class="summernote"  id="description" name="description_ar">{{ $settings['description_ar'] }}</textarea>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("description_ar")}}

                                </span>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">الوصف باللغة الإنجليزية للقسم الأول</label>

                                 <textarea class="summernote"  id="description" name="description_en">{{  $settings['description_en']  }}</textarea>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("description_en")}}

                                </span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">الوصف باللغة العربية للقسم الثاني</label>

                                 <textarea class="summernote"  id="description" name="description_ar_seconed">{{ $settings['description_ar_seconed'] }}</textarea>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("description_ar_seconed")}}

                                </span>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                              <label class="form-label">الوصف باللغة الإنجليزية للقسم الثاني</label>

                                 <textarea class="summernote"  id="description" name="description_en_seconed">{{  $settings['description_en_seconed']  }}</textarea>
                                </div>
                                <span class="text-danger" style="padding-bottom: 10px;">
                                    {{$errors->first("description_en_seconed")}}

                                </span>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">صورة</label>
                                <input type="file" name="image" class="dropify" data-default-file="">
                            </div>
                            <span class="text-danger" style="padding-bottom: 10px;">
                                {{$errors->first("image")}}

                            </span>
                        </div>
                        @if ($settings['image']!='')
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback w-100">
                                <label class="form-label d-block">الصورة القديمة</label>
                                <img class="img-responsive" width="350px" height="350px" src="{{asset( $settings['image'] )}}" alt="Not Found">

                            </div>

                        </div>
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12" id="feachers">
                            <label class="form-label d-block">المميزات</label>
                           @foreach ($settings['feachers'] as $feacher)
                           <div class="form-group fallback w-200" id="feacher-{{$loop->iteration}}">
                            <div class="row">


                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">{{$loop->iteration}}-</label>
                                    <input type="text" value="{{$feacher[0]}}" name="feachers[{{$loop->iteration-1}}][0]" class="form-control">
                                    @if ($errors->first("feachers"))
                                    <span class="text-danger" style="padding-bottom: 10px;">
                                        {{$errors->first("feachers")[$loop->iteration=1][0]}}

                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" value="{{$feacher[1]}}" name="feachers[{{$loop->iteration-1}}][1]" class="form-control">
                                    <span class="text-danger" style="padding-bottom: 10px;">
                                        @if ($errors->first("feachers"))

                                        {{$errors->first("feachers")[$loop->iteration-1][1]}}

                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,{{$loop->iteration}})"><i class="la la-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>

                             </div>

                           @endforeach
                           @if (count($settings['feachers'])==0)
                           <label class="form-label d-block">المميزات</label>
                           <div class="form-group fallback w-200" id="feacher-1">
                            <div class="row">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">1-</label>
                                    <input type="text" name="feachers[0][0]" class="form-control">
                                    @if ($errors->first("feachers"))

                                    <span class="text-danger" style="padding-bottom: 10px;">
                                        {{$errors->first("feachers")[0][0]}}

                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="feachers[0][1]" class="form-control">
                                    @if ($errors->first("feachers"))

                                    <span class="text-danger" style="padding-bottom: 10px;">
                                        {{$errors->first("feachers")[0][1]}}

                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,1)"><i class="la la-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>

                             </div>

                           @endif

                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group fallback">

                          <button class="btn btn-success" onclick="addFeacher(event)" style="color: #fff">+</button>
                            </div>

                        </div>

                        <input type="hidden" id="count_feachers" value="{{count($settings['feachers'])!=0?count($settings['feachers']):1}}">




                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                            <a href="{{route('admin.dashboard')}}" class="btn btn-light">إلغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')

<script src="{{asset('assets/admin/vendor/svganimation/vivus.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/svganimation/svg.animation.js')}}"></script>
	<!-- pickdate -->

	<!-- Pickdate -->

  <script>
    $('.summernote').summernote({
        height: 150,   //set editable area's height

  toolbar: [
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['insert', ['link']],
  ['view', ['fullscreen']],
],

});


 function addFeacher(e)
 {
    e.preventDefault();

    countfeachers++;
   var newTextDiv = $(document.createElement('div'))
         .attr("id", 'feacher-' + countfeachers).addClass("form-group fallback w-200");

         newTextDiv.after().html(`

                            <div class="row">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">${countfeachers}-</label>
                                    <input type="text" name="feachers[${countfeachers-1}][0]" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="feachers[${countfeachers-1}][1]" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,${countfeachers})"><i class="la la-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>


         `);

          newTextDiv.appendTo("#feachers");

 }
 function removeFeacher(e,id)
 {
    e.preventDefault();
    if(countfeachers==1 || id==1)
    {
        alert("لا يمكن حذف جميع المميزات");
         return false;

    }

    $("#feacher-"+id).remove()

    countfeachers--;
     if(id==countfeachers || id<countfeachers)
     {
        $("#feachers").html('')
        let defaultvalues=@json($settings['feachers']);
        defaultvalues.splice(id-1,1)
        for(let i=0;i<countfeachers;i++)
     {

        var newTextDiv = $(document.createElement('div'))
         .attr("id", 'feacher-' + (i+1)).addClass("form-group fallback w-200");


         newTextDiv.after().html(`

                            <div class="row">

                                <div class="col-lg-4" style="display: flex;justify-content: center;align-items: center;">
                                    <label class="form-label" style="margin-left: 10px;">${i+1}-</label>
                                    <input type="text" value="${defaultvalues.length>i?defaultvalues[i][0]:""}" name="feachers[${i}][0]" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" value="${defaultvalues.length>i?defaultvalues[i][0]:""}" name="feachers[${i}][1]" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                <button style="border: 0;background: none;" onclick="removeFeacher(event,${i+1})"><i class="la la-trash" style="font-size: 25px;color: red"></i></button>
                                </div>
                            </div>


         `);

          newTextDiv.appendTo("#feachers");
     }

     }


 }

 let countfeachers=$('#count_feachers').val()


</script>



@endsection

