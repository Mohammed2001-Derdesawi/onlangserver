@extends('admin.master')

@section('title','رفع صور للمقالة')

@section('title_page','رفع صور للمقالة')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <i class="mdi mdi-bullseye-arrow me-2"></i>
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">رفع صور للمقالة</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active">رفع صور للمقالة</li>
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
                                    رفع صور للمقالة
                                </div>

                            </div>
                        </h4>
                        <div id="upload-container" class="text-center">
                            <button id="browseFile" class="btn btn-primary">الرجاء الضغط لإختيار صورة</button>
                        </div>
                        <div  style="display: none" id="uploaddiv" class="mt-3 text-center" style="height: 24px !important;">
                            <div class="form-group">
                                <label class="form-label" class="text-right">وصف الصورة بالعربي</label>
                                 <textarea name="description_ar" id="file_description_ar" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" class="text-right">وصف الصورة بالإنجليزي</label>
                                 <textarea name="description_en" id="file_description_en" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <button id="uploadfile" onclick="uploadFile()" class="btn btn-success mt-5">رفع الصورة</button>
                        </div>
                        <div  style="display: none" class="progress mt-3" style="height: 24px !important;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%;background-color: greenyellow;">75%</div>
                        </div>

                        <div class="card-footer p-4 mt-3 text-center" style="display: none">
                            <span id="message" class="text-center text-success"></span>
                       </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">صور المقالة</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive recentOrderTable">
                            <table class="table verticle-middle table-responsive-md">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">عنوان الصورة</th>
                                        <th scope="col">الصورة</th>
                                        <th scope="col" class="text-center">الأكشن</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($article->attachments as $attachment)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$attachment->title}}</td>
                                        <td>
                                            <div class="col-lg-4">
                                                <img src="{{asset($attachment->path)}}" class="img-responsive" width="150" height="150" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-lg-4">
                                                    <a href="{{route('admin.article.attachment.download',[$article->id,$attachment->id])}}" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>

                                                </div>
                                                <div class="col-lg-4">
                                                    <form action="{{route('admin.article.attachment.delete',[$article->id,$attachment->id])}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>

                                                    </form>
                                                </div>
                                              </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

          </div>
        <!-- end page title -->

    </div> <!-- container-fluid -->
</div>

@endsection
@push('js')

<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
<script type="text/javascript">
    let browseFile = $('#browseFile');
    let resumable = new Resumable({
        target: '{{ route('admin.article.upload',$article->id) }}',
        query:{_token:'{{ csrf_token() }}',
        description_ar:$('#file_description_ar').val()=='undefined'?'':$('#file_description_ar').val(),
        description_en:$('#file_description_en').val()=='undefined'?'':$('#file_description_en').val()
    },
    fileType:['jpeg','png','gif','jpg'],
        chunkSize: 10*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
        multiple:true,
        maxFiles:3,
    });

    resumable.assignBrowse(browseFile[0]);


    resumable.on('fileAdded', function (file) { // trigger when file picked
        $("#uploaddiv").css('display','block')
        browseFile.css('display','none');
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        response = JSON.parse(response)
        $('#message').text(response.message);
        $('#message').append("<a class='btn btn-sucesss' href='{{route('admin.article.index')}}'>الرجوع للخلف</a>");
        $('.card-footer').show();
        hideProgress();
        $("#uploaddiv").css('display','none')
        browseFile.css('display','block');
        setTimeout(() => {
            $('.card-footer').hide();
        },4000);
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
        alert(response)
        $("#uploaddiv").css('display','none')
        browseFile.css('display','block');
    });


    let progress = $('.progress');
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();

    }

    function uploadFile(){
        resumable.opts.query={_token:'{{ csrf_token() }}',description_ar:$('#file_description_ar').val()=='undefined'?'':$('#file_description_ar').val(),
        description_en:$('#file_description_en').val()=='undefined'?'':$('#file_description_en').val()}

        resumable.upload() // to actually start uploading.
        $("#uploaddiv").css('display','none')
        showProgress();




    }
</script>
@endpush
