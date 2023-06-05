@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
 <style>
    .selectcolor{
        background-color: #0c63e4;
        color: #fff;
    }
.active{
padding: 20px;
}
.content-one-video {
width: 68% !important;
}
@media(max-width : 767px;){

    div.gbb {
        position: absolute;
        right: 12px;
        top: 7%;
    }
}


 </style>
@endsection
@section('content')
@php


$uiqueId=session()->get('guest_id')?session()->get('guest_id'):session()->put('guest_id',Str::random(10));

     $uiqueId=auth()->user()?auth()->user()->id:$uiqueId;
     $settings=cache()->get('settings') && isset(cache()->get('settings')['general_info'])?cache()->get('settings')['general_info']:config('front_settings.general_info');

@endphp

<main style="margin-top: 100px">

<button class="show-menu">
    <i class="fas fa-stream"></i>
</button>
<div class="video-main-content privateCoursesSection container-fluid" style="justify-content: center">
    <div class="sidebar displaynone">
        @include('course::User.Playlist.sidebarComponent')

    </div>

  <div class="content-one-video" style="min-width: 60%">
    @php

    $poster = str_replace( '\\', '/', asset($Privateachers->image) );

@endphp
<smartvideo class="swarm-fluid" controls playsinline
width="1686" height="868"
 src="{{  $Privateachers->private_video  }}">
</smartvideo>
<div class="contactPrivate">
    <div class="course-detiles-tittle mb-30">
        @if(App::getLocale() == 'ar')

     <h3  style="display: flex;">{{ $Privateachers->name_ar }}  <div style="margin-right:153px;margin-top:-5px" class=" gbb">





        <!-- Button trigger modal -->
        <button  style="
        font-size: 31px;
        margin-left: 16px;
    " id="button2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-share"></i>
          </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Share</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div style="
          text-align: center;
      ">
            <a  onclick="Share('whatsapp')" > <i style="
                font-size: 49px;
                padding-right: 31px; " class="fab fa-whatsapp"></i></a>
            <a onclick="Share('facebook')" > <i style="
                font-size: 42px;
                padding-right: 31px;
            " class="fab fa-facebook-f"></i></a>
            <a  onclick="Share('instagram')" > <i style="
                font-size: 42px;
                padding-right: 31px;
            " class="fab fa-instagram"></i></a>
            <a  onclick="Share('twitter')"> <i style="
                font-size: 42px;
                padding-right: 31px;
            " class="fab fa-twitter"></i></a>


          </div>
          <div class="copylink">
            <input type="text" id="copyLinkInput" value="{{ url()->current() }}" placeholder="video Link Here">
            <button class="btncopy" onclick="copyToClipboard()">Copy Link</button>
          </div>
        </div>

      </div>
    </div>
  </div>

</button>



    </div></h3>
          @else
       <h3  style="display: flex" >{{ $Privateachers->name_en }}  <div style="margin-left:70px;margin-top:-5px"   class=" gbb">





        <!-- Button trigger modal -->
        <button  style="
        font-size: 31px;
        margin-left: 16px;
    " id="button2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-share"></i>
          </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Share</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div style="
          text-align: center;
      ">
            <a  onclick="Share('whatsapp')" > <i style="
                font-size: 49px;
                padding-right: 31px; " class="fab fa-whatsapp"></i></a>
            <a onclick="Share('facebook')" > <i style="
                font-size: 42px;
                padding-right: 31px;
            " class="fab fa-facebook-f"></i></a>
            <a  onclick="Share('instagram')" > <i style="
                font-size: 42px;
                padding-right: 31px;
            " class="fab fa-instagram"></i></a>
            <a  onclick="Share('twitter')"> <i style="
                font-size: 42px;
                padding-right: 31px;
            " class="fab fa-twitter"></i></a>


          </div>
          <div class="copylink">
            <input type="text" id="copyLinkInput" value="{{ url()->current() }}" placeholder="video Link Here">
            <button class="btncopy" onclick="copyToClipboard()">Copy Link</button>
          </div>
        </div>

      </div>
    </div>
  </div>

</button>



    </div></h3>
          @endif

    </div>


    <div class="teacher-info">


        <div class="description">
            <h3>{{trans('main_trans.teacherdescription')}}</h3>
            @if(App::getLocale() == 'ar')

            <p style="margin: auto;"  >  {!! $Privateachers->description_ar !!}</p>
          @else
          <p  style="margin:auto;"  > {!! $Privateachers->description_en !!}</p>
          @endif

        </div>
        <div class="tableappoint container table-responsive">
           الايام المختارة: <br>
                <div   style="direction: ltr !important;width: 247px;height:150px;d" id="the_seats"  >

                </div>
            <table class="table">
                <tr class="table-warning ">
                    <th colspan="7"><h3>اختيار الايام والمواعيد</h3></th>
                </tr>
                <tr class="day">

                    <th> <button class="seat"     value="Saturday">السبت</button> </th>
                    <th><button class="seat"  value="Sunday">الاحد</button> </th>
                    <th><button class="seat" value="Monday">الاثنين</button> </th>
                    <th><button class="seat"  value="Tuesday">الثلاثاء</button> </th>
                    <th><button class="seat" value="Wednesday">الاربعاء</button> </th>
                    <th><button class="seat"  value="Thursday">الخميس</button> </th>
                    <th><button class="seat"  value="Friday" >الجمعة</button> </th>
                </tr>
                <tr>

                    <td><button  class="date active times " onclick="selectedTimeAndDate( event , 'saturday' , this.value)" value="8-10am" >8-10am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event ,'sunday' , this.value)" value="8-10am">8-10am</button></td>
                    <td><button class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)" value="8-10am">8-10am</button></td>
                    <td><button class="date active times "  onclick="selectedTimeAndDate( event , 'tuesday' , this.value)" value="8-10am">8-10am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'wednesday' , this.value)" value="8-10am">8-10am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'thursday' , this.value)" value="8-10am">8-10am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'friday' , this.value)" value="8-10am">8-10am</button></td>

                </tr>
                <tr>
                    <td><button class="date active times "   onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="10-12am">10-12 am</button></td>
                    <td><button class="date active times "    onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="10-12am">10-12 am</button></td>
                    <td><button class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="10-12am">10-12 am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'tuesday' , this.value)"  value="10-12am">10-12 am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'wednesday' , this.value)" value="10-12am">10-12 am</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'thursday' , this.value)" value="10-12am">10-12 am</button></td>
                    <td><button class="date active times "        onclick="selectedTimeAndDate( event , 'friday' , this.value)" value="10-12am" >10-12 am</button></td>

                </tr>
                <tr>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="12-2pm"  >12-2 pm</button></td>
                    <td><button class="date active"onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="12-2pm"   >12-2 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="12-2pm"  > 12-2 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'tuesday ' , this.value)"  value="12-2pm">12-2 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'wednesday ' , this.value)"  value="12-2pm">12-2 pm</button></td>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'thursday ' , this.value)"  value="12-2pm">12-2 pm</button></td>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'friday ' , this.value)"  value="12-2pm">12-2 pm</button></td>

                </tr>
                <tr>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="2-4pm"  >2-4 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="2-4pm"   >2-4 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="2-4pm"  > 2-4  pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'tuesday ' , this.value)"  value="2-4pm">2-4  pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'wednesday ' , this.value)"  value="2-4pm">2-4  pm</button></td>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'thursday ' , this.value)"  value="2-4pm">2-4 pm</button></td>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'friday ' , this.value)"  value="2-4pm">2-4  pm</button></td>

                </tr>
                <tr>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="4-6 pm"  >4-6 pm</button></td>
                    <td><button  class="date active times "   onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="4-6 pm"   >4-6 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="4-6 pm"  > 4-6 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'tuesday ' , this.value)"  value="4-6 pm">4-6 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'wednesday ' , this.value)"  value="4-6 pm">4-6 pm</button></td>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'thursday ' , this.value)"  value="4-6 pm">4-6 pm</button></td>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'friday ' , this.value)"  value="4-6 pm">4-6 pm</button></td>



                </tr>
                <tr>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="6-8 pm"  >6-8 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="6-8 pm"   >6-8 pm</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="6-8 pm"  > 6-8 pm</button></td>
                    <td><button  class="date active times "   onclick="selectedTimeAndDate( event , 'tuesday ' , this.value)"  value="6-8 pm">6-8 pm</button></td>
                    <td><button  class="date active times "   onclick="selectedTimeAndDate( event , 'wednesday ' , this.value)"  value="6-8 pm">6-8 pm</button></td>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'thursday ' , this.value)"  value="6-8 pm">6-8 pm</button></td>
                    <td><button class="date active times " onclick="selectedTimeAndDate( event , 'friday ' , this.value)"  value="6-8 pm">6-8 pm</button></td>

                </tr>
                <tr>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="8-10 pm"  >8-10 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="8-10 pm"   >8-10 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="8-10 pm"  >8-10 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'tuesday ' , this.value)"  value="8-10 pm">8-10pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'wednesday ' , this.value)"  value="8-10 pm">8-10 pm</button></td>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'thursday ' , this.value)"  value="8-10 pm">8-10pm</button></td>
                    <td><button   class="date active times " onclick="selectedTimeAndDate( event , 'friday ' , this.value)"  value="8-10 pm">8-10 pm</button></td>

                </tr>
                <tr>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'saturday' , this.value)"  value="10-12 pm"  >10-12 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'sunday' , this.value)"  value="10-12 pm"   >10-12 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'monday' , this.value)"  value="10-12 pm"  > 10-12 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'tuesday ' , this.value)"  value="10-12 pm">10-12 pm</button></td>
                    <td><button   class="date active times "  onclick="selectedTimeAndDate( event , 'wednesday ' , this.value)"  value="10-12 pm">10-12 pm</button></td>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'thursday ' , this.value)"  value="10-12 pm">10-12 pm</button></td>
                    <td><button  class="date active times "  onclick="selectedTimeAndDate( event , 'friday ' , this.value)"  value="10-12 pm">10-12 pm</button></td>

                </tr>




            </table>
          </div>
          <div class="contactPrivate" style="text-align: center" >

            <button class="user-btn-sign-up edu-btn"  onclick="takeDay('whatsapp')"   >  التواصل معنا </button>
        </div>



    </div>
  </div>




<!-- End Section Six -->




















    </main>

@endsection




@section('js')

<script data-cfasync="false">
    var swarmoptions = {
        swarmcdnkey: "d0474def-2c8e-4cc2-99bf-80504a2846d2",
        iframeReplacement: "iframe",
        autoreplace: {
            youtube: true
        }
    };
</script>
<script async data-cfasync="false" src="https://assets.swarmcdn.com/cross/swarmdetect.js"></script>
<script>
    function Share(share)
    {
        switch(share)
        {
            case "facebook":
                window.open("https://www.facebook.com/sharer/sharer.php?u={{route('user.courseDetails',$Privateachers->slug)}}&text={{$Privateachers->name_en}}")
                break;
                case "twitter":
                window.open("https://twitter.com/intent/tweet?url={{route('user.courseDetails',$Privateachers->slug)}}")
                break;
                case "whatsapp":
                window.open("https://wa.me/?text={{route('user.courseDetails',$Privateachers->slug)}}")

                break;

        }

    }
    </script>
    <script>
        function copyToClipboard() {
          const input = document.getElementById("copyLinkInput");
          input.select();
          document.execCommand("copy");
          alert("تم نسخ رابط الدورة التدريبية  ");

        }
        </script>
        <script>
            var days=['sunday','saturday','monday' , 'tuesday' ,'wednesday' , 'thursday' , 'friday' ];
            var selected_days = {};
            function selectedTimeAndDate(event,day,value){

                if(days.includes(day) && value!='' && Object.keys(selected_days).length < 3 && !(day  in selected_days ) ){
                    selected_days[day] = value;
                     event.target.classList.add('selectcolor')
              } else if(day in selected_days ){
                delete selected_days[day]
                event.target.classList.remove('selectcolor')


            }


            var seats = '';
            var timesAndDays = '' ;
                 for(key in selected_days){

                     seats+=key+":"+selected_days[key]
                     timesAndDays+=key+":"+selected_days[key]
                     seats+="</br>";
                     console.log(seats)
                 }

                 $('.times').each(function() {
                     console.log($(this).val());
                   });
                 $("#the_seats").html(seats)


        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })

        function takeDay(seat) {
            var seats = $("#the_seats").html();
            seats= seats.replace(/<br>/g, ' ');

            switch (seat) {
                case "whatsapp":
                    var url = "https://wa.me/{{ $settings['whatsapp_phone']}}?text=" + "مرحبا On language courses" + " أرغب في التسجيل في الدورات الخاصة  في هذه المواعيد " + seats + "  مع المدرب   " + "{{ $Privateachers->name_ar }}" + "وشكرا لكم .";
                     var uiqueId =   "{{ $uiqueId }}";
                     var teacherId = "{{ $Privateachers->id }}";
                    // Send an AJAX request to record the click
                    $.ajax({
                        type: "POST",
                        url: "/record-whatsapp",
                        data: { uiqueId:uiqueId ,
                            teacherId:teacherId,
                        },
                        success: function(response) {
                            // Open the WhatsApp link in a new window
                            window.open(url);
                        }
                    });

            break;
     }
        }

        </script>
@endsection


