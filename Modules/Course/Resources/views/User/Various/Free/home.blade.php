@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content="فيديوهات بدون حقوق,فيديوهات بدون حقوق ملكية,فيديوهات,مدفوعة,كورسات مدفوعة مجانا,فيديوهات مجانية للمونتاج,احصل على دورات مدفوعة,تطبيقات مدفوعة مجانا,شركة مدفوعة,تحرير الفيديوهات,فيديوهات بدون حقوق نشر,كورسات مدفوعة بالمجان,تطبيقات مدفوعه,الحصول على دورات مدفوعة,برامج مدفوعة,تطبيقات مدفوعه جديده 2022,نصابين مدفوعة,فيديوهات اونلي فانز ببلاش,ابلكيشن مدفوعة,احصل على دورات مدفوعة مجانا,افكار فيديوهات بدون الظهور,فيديوهات للمونتاج بدون حقوق , educational videos for kids,blippi videos,educational videos for toddlers,education,educational,educational videos,kids educational videos,educational videos for children,kg educational videos,learning videos,educational video,kids education,kids educational video,educational video for kids,blippi educational videos for kids,preschool education videos,videos for kids,best educational videos for toddlers,educational video for children , تعليم,تطبيقات تعليم اللغات,تعليم اللغات,تعلم اللغات,لغات,تطبيق طليق لتعلم اللغات,تعلم اللغات الاجنبية,كيف تتعلم اللغة الانجليزية,تعليم scc,أكثر اللغات تعلماً,أهم لغات في العالم,تعليم الطفل,تعليم اللغة الصينية,تعليم اللغة الروسية,تعليم لغة تركية تعلم لغة تركية,تعليم الاطفال,اسهل تعليم css,تعليم اللغة الاسبانية,تطبيق تعلم اللغات,تعلم اللغات بسرعة,تعلم اللغات ابراهيم عادل,تعليم اللغة الانجليزية,تعلم اللغات بسهولة,تعلم اللغات وأنت نائم,تتعلم , تعليم الاطفال,تعليم الارقام,تعليم الحروف,تعليم,فيديوهات تعليم للاطفال,تعليم الالوان,تعليم العربية,تعليم اسماء الحيوانات,تعليم الطفل,تعليم الاشكال,تعليم الأطفال,تعليم حروف الهجاء,تعليم الطفل المسلم,تعليم اسماء الفواكه,تعليم اللغة الانجليزية,تعليم اطفال,فيديو تعليمي,تعليمي الفيديو,فيديوهات رائعة,فيديوهات اطفال,تعليم النطق للأطفال,العاب تعليمية,فديوهات,تعليم ديني,تعليم الالوان للاطفال,تعليم الألوان للأطفال,فيديوهات مفيدة للاطفال,تعليم ال">

@endsection
@section('content')

<main style="margin-top:100px" >
    <form action="">
        <div class="search-filter">
            <div class="couse-dropdown">
                <div class="course-drop-inner">
                    
                   <select onchange="this.form.submit()" name="type">

                      <option value="playlists"  style="color: black;"  {{ request()->type=='playlists'?'selected':''}}  >  قوائم التشغيل </option>
                      
                      <option value=""    {{ request()->type !='playlists'?'selected':''}} style="color: black;"  > الفيديوهات </option>

                   </select>
                </div>
    </div>

        </div>
    </form>
        <button class="show-menu d-lg-none">
            <i class="fas fa-stream"></i>
        </button>

    <div class="video-main-content container-fluid"  >
        <div class="sidebar d-none d-lg-block">
            @include('course::User.Playlist.sidebarComponent')

        </div>
    <div class="all-videos">
        @if(request()->type != 'playlists')
        @foreach ($PlayListFree as $Free )


        <div class="one-videos">

            <a  href="{{ route('user.freeVideoShow' , $Free->id ) }}">
                <img src="{{ asset($Free->poster) }}" class="video-img" alt="">
            </a>
            <button onclick="addToWatchLater({{ $Free->id }})" type="submit" class="watch-later-button">
                <span class="watch-later-label">WATCH LATER</span>
                <svg class="mysvg" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M16.2,16.2L11,13V7h1.5v5.2l4.5,2.7L16.2,16.2z"/></g></g></g></svg>
            </button>
            <div class="details-video">
                <div>
                    <a  href="{{ route('user.freeVideoShow' , $Free->id ) }}">
                        <img src="assets/img/course/academic-tutor-1.png" alt="">
                    </a>

                </div>

                <a  href="{{ route('user.freeVideoShow' , $Free->id ) }}">
                    @if (App::getLocale() == 'en')
                    <h6>    <a  href="{{ route('user.freeVideoShow' , $Free->id ) }}"
                        >   {{ $Free->title_en }} </a></h6>

                    @else
                    <h6>   <a  href="{{ route('user.freeVideoShow' , $Free->id ) }}"
                        >{{ $Free->title_ar }} </a></h6>

                    @endif



                </a>

                <div class="actions1">


                    <div class="dropdown">
                        <button                  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><button  style="   font-size: 13px;"   class=" btn addtolist"  data-bs-toggle="modal" data-bs-target="#ss"  data-bs-placement="top" title="Add To Playlist" onclick="SaveAPlayList({{ $Free->id }})">
                            اضافة لقائمة التشغيل                          </button>
                          </li>
                        </ul>
                      </div>
                   </div>

        </div>
        </div>

        @endforeach

        @else
@foreach ($PlayListFree as $playlist )

        <div class="one-videos">
            <a href="{{ route('user.freeVideos' , $playlist->id ) }}">
                <img src="{{ asset($playlist->poster) }}" class="video-img" alt="">
            </a>

            <div class="details-video">
                <div>
                    <a  href="{{ route('user.freeVideos' , $playlist->id ) }}">
                        <img src="assets/img/course/academic-tutor-1.png" alt="">
                    </a>

                </div>

                <a  href="{{ route('user.freeVideos' , $playlist->id ) }}">
                    @if (App::getLocale() == 'en')
                    <h6>   {{  $playlist->title_en }}  </h6>
                         @else
                         <h6>  {{  $playlist->title_ar }}  </h6>
                         @endif

                </a>
                <div class="actions1">


                    <div class="dropdown">
                        <button                  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><button  style="
                            font-size: 13px;
    "     class=" btn addtolist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Playlist" onclick="SaveAPlayList({{ $playlist->id }})">
اضافة لقائمة التشغيل     </button></li>
                        </ul>
                      </div>
            </div>
        </div>
    </div>

    @endforeach


    @endif




    </div>
</div>

<!-- End Section Six -->













    </main>
    
    
     <div class="col-lg-12 text-center">
            <div >
                {{ $PlayListFree->links('vendor.pagination.tailwind') }}
                </div>
        </div>
@endsection





@section('js')

<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
// Start Product View with Modal

// Eend Product View with Modal
 // Start Add To Cart Product
    function SaveAPlayList(id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                id:id,
            },

            url: "{{ route('user.playlist.store.admin') }}",
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

// End Add To Cart Product
</script>


@endsection


