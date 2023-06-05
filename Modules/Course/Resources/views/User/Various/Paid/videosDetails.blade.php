@extends('user.master')

@section('title')
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content="فيديوهات بدون حقوق,فيديوهات بدون حقوق ملكية,فيديوهات,مدفوعة,كورسات مدفوعة مجانا,فيديوهات مجانية للمونتاج,احصل على دورات مدفوعة,تطبيقات مدفوعة مجانا,شركة مدفوعة,تحرير الفيديوهات,فيديوهات بدون حقوق نشر,كورسات مدفوعة بالمجان,تطبيقات مدفوعه,الحصول على دورات مدفوعة,برامج مدفوعة,تطبيقات مدفوعه جديده 2022,نصابين مدفوعة,فيديوهات اونلي فانز ببلاش,ابلكيشن مدفوعة,احصل على دورات مدفوعة مجانا,افكار فيديوهات بدون الظهور,فيديوهات للمونتاج بدون حقوق , educational videos for kids,blippi videos,educational videos for toddlers,education,educational,educational videos,kids educational videos,educational videos for children,kg educational videos,learning videos,educational video,kids education,kids educational video,educational video for kids,blippi educational videos for kids,preschool education videos,videos for kids,best educational videos for toddlers,educational video for children , تعليم,تطبيقات تعليم اللغات,تعليم اللغات,تعلم اللغات,لغات,تطبيق طليق لتعلم اللغات,تعلم اللغات الاجنبية,كيف تتعلم اللغة الانجليزية,تعليم scc,أكثر اللغات تعلماً,أهم لغات في العالم,تعليم الطفل,تعليم اللغة الصينية,تعليم اللغة الروسية,تعليم لغة تركية تعلم لغة تركية,تعليم الاطفال,اسهل تعليم css,تعليم اللغة الاسبانية,تطبيق تعلم اللغات,تعلم اللغات بسرعة,تعلم اللغات ابراهيم عادل,تعليم اللغة الانجليزية,تعلم اللغات بسهولة,تعلم اللغات وأنت نائم,تتعلم , تعليم الاطفال,تعليم الارقام,تعليم الحروف,تعليم,فيديوهات تعليم للاطفال,تعليم الالوان,تعليم العربية,تعليم اسماء الحيوانات,تعليم الطفل,تعليم الاشكال,تعليم الأطفال,تعليم حروف الهجاء,تعليم الطفل المسلم,تعليم اسماء الفواكه,تعليم اللغة الانجليزية,تعليم اطفال,فيديو تعليمي,تعليمي الفيديو,فيديوهات رائعة,فيديوهات اطفال,تعليم النطق للأطفال,العاب تعليمية,فديوهات,تعليم ديني,تعليم الالوان للاطفال,تعليم الألوان للأطفال,فيديوهات مفيدة للاطفال,تعليم ال">

<style>
    .invalid{
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e);
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
</style>
@endsection
@section('content')
<main style="margin-top:170px" >

    <!-- Start Section One -->
    <section class="one">

        <div class="firstsection1">






                <!-- <img class="hero-shape-6" src="assets/img/shape/shape-01.png" alt="shape"> -->

            </div>

        </div>
    </section>

    <button class="show-menu">
        <i class="fas fa-stream"></i>
    </button>
    <div class="video-main-content container-fluid">
        <div class="sidebar">
            @include('course::User.Playlist.sidebarComponent')

        </div>

        <div class="all-videos">
            @foreach ( $allPaidVideos   as $Paid )

            <div class="one-videos">

                <a  href="{{ route('user.paidVideoShow' , $Paid->id ) }}"
                    >
                    <img src="{{ asset($Paid->poster) }}" class="video-img" alt="">
                </a>
                <button onclick="addToWatchLater({{ $Paid->id }})" type="submit" class="watch-later-button">
                    <span class="watch-later-label">WATCH LATER</span>
                    <svg class="mysvg" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M16.2,16.2L11,13V7h1.5v5.2l4.5,2.7L16.2,16.2z"/></g></g></g></svg>
                </button>
                <div class="details-video">
                    <div>
                        <a  href="{{ route('user.paidVideoShow' , $Paid->id ) }}">
                            <img src="assets/img/course/academic-tutor-1.png" alt="">
                        </a>

                    </div>

                    <a  href="{{ route('user.paidVideoShow' , $Paid->id ) }}">
                        @if (App::getLocale() == 'en')
                        <h6>    <a  href="{{ route('user.paidVideoShow' , $Paid->id ) }}"
                            >   {{ $Paid->title_en }} </a></h6>

                        @else
                        <h6>   <a  href="{{ route('user.paidVideoShow' , $Paid->id ) }}"
                            >{{ $Paid->title_ar }} </a></h6>

                        @endif



                    </a>

                    <div class="actions1">


                        <div class="dropdown">
                            <button                  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><button  style="   font-size: 13px;"   class=" btn addtolist"  data-bs-toggle="modal" data-bs-target="#ss"  data-bs-placement="top" title="Add To Playlist" onclick="SaveAPlayList({{ $Paid->id }})">
                                اضافة لقائمة التشغيل                          </button>
    </li>
                            </ul>
                          </div>
                       </div>

            </div>
        </div>


            @endforeach



            <div class="modal fade .modal-sm" id="ss" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content"  style="width:290.387px; height350px">
                    <div class="modal-header" >
                        @if (App::getLocale() == 'ar')
                        <h5  id="exampleModalLabel"> اضافة الى </h5>
                        @else
                        <h5 id="exampleModalLabel">  Add To </h5>
                        @endif

                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div >
                            <!-- ACCORDION START -->
                            <div class="row">
                                @foreach ($playlists as $playlist)

                                <div class="col-lg-12">
                                    <input type="checkbox" onclick="SaveVideoTo({{ $playlist->id }})" value="{{$playlist->id }}" class="form-check-input playlist-check"   style="display: inline-block" id="playlist-{{ $playlist->id }}" data-id="{{ $playlist->id }}">
                                    <label>{{ $playlist->title }}</label>
                                </div>
                                @endforeach

                            </div>
                            @if (App::getLocale() == 'ar')
                            <h6  style="cursor:pointer;margin-top: 14px;">  <span id="showcoupon">
                                <img alt="Playlist Icon" width="25" src="https://cdn.iconscout.com/icon/free/png-256/playlist-add-insert-new-player-30545.png?f=webp&amp;w=256" srcset="https://cdn.iconscout.com/icon/free/png-256/playlist-add-insert-new-player-30545.png?f=webp&amp;w=256 1x, https://cdn.iconscout.com/icon/free/png-256/playlist-add-insert-new-player-30545.png?f=webp&amp;w=512 2x">
                                إنشاء قائمة تشغيل</span></h6>
                            @else
                            <h6  style="cursor:pointe;margin-top: 14px;"> <span id="showcoupon"><img alt="Playlist Icon" width="25" src="https://cdn.iconscout.com/icon/free/png-256/playlist-add-insert-new-player-30545.png?f=webp&amp;w=256" srcset="https://cdn.iconscout.com/icon/free/png-256/playlist-add-insert-new-player-30545.png?f=webp&amp;w=256 1x, https://cdn.iconscout.com/icon/free/png-256/playlist-add-insert-new-player-30545.png?f=webp&amp;w=512 2x">
                                 Create A playList</span></h6>
                            @endif

                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="#">
                                        <p class="checkout-coupon">
                                            <label>Name</label>
                                            <input type="text" id="playlist_name"  class="form-control" placeholder="PlayList Name " />
                                            <hr>
                                            @if (App::getLocale() == 'ar')
                                            <button  type="submit " onclick="createPlaylist( event )">حفظ قائمة التشغيل</button>
                                            @else
                                            <button onclick="createPlaylist( event )" type="submit">
                                                Save The Playlist</button>
                                            @endif
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <!-- ACCORDION END -->
                        </div>                               </div>
                    <div class="modal-footer">
                      <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>






        </div>
    </div>

    <!-- End Section Six -->




















        </main>

@endsection





@section('js')



// Start Product View with Modal

// Eend Product View with Moda
<script>




    function SaveVideoTo(id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                id:id,
                video:video
            },

            url: "{{ route('user.playlist.video.save.to') }}",
            success:function(data){
                playlist = id ;
              let icon="success"
              if(data.error)
              icon='error'
              // Start Message
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: icon,
                showConfirmButton: false,
                timer: 4000
              })
          if ($.isEmptyObject(data.error)) {
              Toast.fire({
                  type:icon,
                  title: data.success
              })
          }else{
              Toast.fire({
                  type: 'error',
                  title: data.error
              })
          }
          // End Message
        }

        })
    }

    $( document ).ready(function() {
        $('#playlist_name').on('input',function() {
           $('#playlist_name').removeClass('invalid')
        });
    });
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })

    var video = 0 ;
    var playlist = null ;

    function SaveAPlayList(id){
     video = id ;
     checkPalylist(video)
    }

    function checkPalylist(video){
        $.get("/playlist/get/user/where/video="+video,function(data){



            $('input[type="checkbox"]').prop('checked', false);

            const playlists =data.playlists;

              playlists.forEach((value)=>{
                 var checkbox=$('#playlist-'+value)
                if (playlists.includes(parseInt(checkbox.val()))) {
                  checkbox.prop('checked', true);
                }


            })



        })
    }
    function addToWatchLater(id){

        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                id:id,
            },

            url: "/add/watchlater",
            success:function(data){
              let icon="success"
              if(data.error)
              icon='error'
              // Start Message
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: icon,
                showConfirmButton: false,
                timer: 4000
              })
          if ($.isEmptyObject(data.error)) {
              Toast.fire({
                  type:icon,
                  title: data.success
              })
          }else{
              Toast.fire({
                  type: 'error',
                  title: data.error
              })
          }
          // End Message
        }
    })
    }
    function createPlaylist(event){

        event.preventDefault()
        var name=$("#playlist_name")
        console.log(name)
        let icon="success"
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: icon,
            showConfirmButton: false,
            timer: 4000
          })
        if(name.val().length>2)
        {
            $.ajax({
                type: "POST",
                dataType: 'json',
                data:{
                    video:video,
                    title:name.val()
                },

                url: "{{ route('user.playlist.store') }}",
                success:function(data){

                  if(data.error)
                  icon='error'
                  // Start Message

              if ($.isEmptyObject(data.error)) {
                  Toast.fire({
                      type:icon,
                      title: data.success
                  })
              }else{
                  Toast.fire({
                      type: 'error',
                      title: data.error
                  })
              }
              // End Message
            }

            })
        }
        else{
            name.addClass('invalid')

        }
    }
</script>






@endsection


