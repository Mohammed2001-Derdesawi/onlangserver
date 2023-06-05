@extends('user.master')

@section('title')
@endsection

@section('css')
    <style>
        .membership-list {
            font-size: 14px;
            text-align: center;
        }

        .membership-list span {
            font-size: 14px;
            text-align: center;
        }

        .affiliatepara .membership-info p {
            max-width: 200px;
        }
     .sss{

        margin: 20px auto;
        background-color: rgb(59, 141, 255);
        padding: 10px 69px;
        border-radius: 5px;
        color: #fff;
        margin-top: 15px;
     }


        .membership-list {
            font-size: 14px;
            text-align: center;
        }

        .membership-list span {
            font-size: 14px;
            text-align: center;
        }

        .affiliatepara .membership-info p {
            max-width: 200px;
        }

.membership-list {
            font-size: 14px;
            text-align: center;
        }

        .membership-list span {
            font-size: 14px;
            text-align: center;
        }

        .affiliatepara .membership-info p {
            max-width: 200px;
        }
           .affiliatepara .register {
            background-color: #ffb013;
            text-align: center;
            padding: 15px 28px;
            color: #fff;
            border-radius: 5px;
            margin-top: 20px;
        }

        .affiliatepara .register {
            background-color: #ffb013;
            text-align: center;
            padding: 15px 28px;
            color: #fff;
            border-radius: 5px;
            margin-top: 20px;
        }
        input[type="radio"] {
  display: none;
}

.icon {
  display: inline-block;
  width: 40px;
  height: 40px;
  border: 2px solid #ccc;
  border-radius: 50%;
  text-align: center;
  line-height: 40px;
}

input[type="radio"]:checked + .icon {
  border-color: #007bff;
  background-color: #007bff;
color: #fff;
}

/* width and color of the scrollbar track */
.scroll-container::-webkit-scrollbar-track {
  width: 10px; /* or any desired width */
  background-color: #f5f5f5; /* or any desired color */
}

/* width and color of the scrollbar thumb (the draggable handle) */
.scroll-container::-webkit-scrollbar-thumb {
  width: 10px; /* or any desired width */
  background-color: #ccc; /* or any desired color */
}
.scroll-container {
  scroll-behavior: smooth;
}
.scroll-container {
  height: 200px;
  overflow: auto;
  scroll-behavior: smooth;
}

.scroll-container::-webkit-scrollbar-track {
  width: 10px;
  background-color: #f5f5f5;
}

.scroll-container::-webkit-scrollbar-thumb {
  width: 10px;
  background-color: #ccc;
  scrollbar-width: thin; /* thin, auto or none */
  scrollbar-color: #ccc #f5f5f5; /* thumb color and track color */
}

    </style>
@endsection
@section('content')
<main>

   @php
       $user=auth()->user();
   @endphp
    <div class=" container difinationaffiliate">
        <section class="membership-area pt-110">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-6" style="text-align: center">
                     <div class="section-title text-center mb-40">

                        <h2>{{  app()->getLocale() == 'en' ? $campaign->title_en : $campaign->title_ar }}</h2>
                        <p>
                            {!! app()->getLocale() == 'en' ? $campaign->description_en : $campaign->description_ar !!}
                        </p>
                     </div>
            @php
                $user=auth()->user();
            @endphp
            @if ($user==null || !$user->is_start_campaigns)
            <form action="{{ route('affiliate.subscribes')}}" method="post">
               @csrf
               <div class="col-lg-12">
                <span style="margin: 0 15px;">
                    {{ trans('affiliate.select') }}

                </span>

               </div>
               <div class="col-lg-12 mb-4">
                <p class="text-danger">
                    {{ trans('affiliate.notescantchange') }}
                </p>
               </div>
              <div class="col-lg-12">
                <label>
                    {{ trans('affiliate.money') }}
                                   <input type="radio" name="type" value="money">

                    <span class="icon">
                        <i class="fas fa-coins"></i>
                    </span>
                  </label>

                  <label style="margin: 0 10px;">
                    {{ trans('affiliate.freecourse') }}
                    <input type="radio" name="type" value="course">
                    <span class="icon">
                        <i class="fas fa-book-reader"></i>
                    </span>
                  </label>
              </div>

            <button class="mb-60 register" style="
            background-color: #ffb013;
            text-align: center;
            padding: 15px 28px;
            color: #fff;
            border-radius: 5px;
            margin-top: 20px;
        " >{{ trans('affiliate.signup') }}</button>

        </form>
            @endif
                     @if ($user && $user->is_start_campaigns )
                     <div>
                        <button id="share_btn" class="sss">

                           <i class="fas fa-link"></i>

                           <span  data-sahreLink="{{ route('register')."?share_id=".$user->uuid."&&"."camp_id=".$campaign->slug }}" > {{ trans('affiliate.copylink') }}</span>
                        </button>
                       </div>
                     @endif
                  </div>
                  <div class="tab-content" id="priceTabContent"
                     style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                     <div class="tab-pane fade active show" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                        <div class="row">
                            @foreach ($campaign->levels as $level)


                           <div class="col-xl-3 col-lg-6 col-md-6">
                              <div class="membership-box mb-30" style="overflow:auto;padding:19px 23p; ">
                                 <div class="membership-info">
                                    <h4>{{  app()->getLocale() == 'en' ? $level->title_en  : $level->title_ar }}</h4>
                                    <div class="membership-price">
                                       <span> {{ $level->total_point }} </span>
                                       <p>Free for starters</p>
                                    </div>

                                        <div class="membership-list">
                                            {!! app()->getLocale() == 'en' ? $level->description_en : $level->description_ar !!}

                                        </div>

                                 </div>


                              </div>
                           </div>

                           @endforeach

                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </section>
    </div>


    <!-- campus-area-end -->

        </main>

@endsection




@section('js')

@if ($campaign && $user && $user->is_start_campaigns )


<script>

    $("#share_btn").on('click',function(event){
        event.preventDefault();

          if(event.target.dataset && event.target.dataset.sahrelink){
            var  value=event.target.dataset.sahrelink

            var tempInput = document.createElement("input");
            tempInput.value =value;
            document.body.appendChild(tempInput);
            tempInput.select();
            // Copy the selected text to the clipboard
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    $("#share_btn").html("Share link copied!")
       setTimeout(() => {
        var div=`  <i class="fas fa-link"></i>

                <span id="share_text" data-shareLink="${value}">نسخ رابط المشاركة</span>`;
        $("#share_btn").html(div)
       },3000);


          }

    })

</script>
@endif
@endsection



