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
.swiper-button-prev, .swiper-button-next {
  position: absolute;
  top: 50%;
  width: 40px;
  height: 40px;
  margin-top: -20px;
  z-index: 10;
  cursor: pointer;
  background-size: 100%;
  background-repeat: no-repeat;
}

.swiper-button-prev {
  left: 10px;
  background-image: url('path/to/your/prev-button-image');
}

.swiper-button-next {
  right: 10px;
  background-image: url('path/to/your/next-button-image');
}
.affiliatepara button{
    padding:0 !important;
}

    </style>
@endsection
@section('content')
@php
$settings=cache()->get('settings') && isset(cache()->get('settings')['general_info'])?cache()->get('settings')['general_info']:config('front_settings.general_info');
@endphp
    <main>

        <div class=" container difinationaffiliate">
            <div class="imgaffilliate">
                <div class="stepsaffiliate">
                    <div class="step1">
                        <img src="{{ asset('assets/user/img/animated/signup.gif') }}" alt="">
                        <span>{{ trans('affiliate.signup') }}</span>
                    </div>
                    <div class="step1">
                        <img src="{{ asset('assets/user/img/animated/invite.gif') }}" alt="">
                        <span>{{ trans('affiliate.invite') }}</span>
                    </div>
                    <div class="step1">
                        <img src="{{ asset('assets/user/img/animated/money-bag.gif') }}" alt="">
                        <span>{{ trans('affiliate.earn') }}</span>
                    </div>


                </div>


            </div>
        </div>
        <div class="container affiliatecontent">
            <div class="affiliatepara">
                    <h3>{{ trans('affiliate.mainTitle') }}

                </h3>
                <p>
                    {!!  $settings['affilate'][app()->getLocale()]['description'] !!}
                </p>
                      <br>
             <div class="event-area pt-110 pb-90 col-lg-9" style="margin:auto">
            <div class="event-shape-wrapper position-relative">
                <div class="event-shape">
                    <img src="assets/img/shape/feedback-img.png" alt="image not found">
                </div>
            </div>
<div id="carouselExampleControls" class="carousel slide col-log-9"  data-bs-touch="false" data-bs-interval="false"

  data-bs-ride="carousel">
  <div class="carousel-inner">
        @foreach ( $settings['affilate']['sliders'] as $key => $item)
    <div class="carousel-item @if ($key == 0) active @endif  " data-bs-interval="false">
                                                              <smartvideo class="mymainvideo swarm-fluid" controls playsinline poster="{{ asset($item['poster'])  }}"
                    src="{{ $item['video']  }}">
        </smartvideo>   
    </div>
  @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
            </div>
        </div>



                <div class="tab-content" id="priceTabContent"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                    <div class="tab-pane fade active show" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                        <div class="row">
                            @foreach ($campaigns as $campaign)
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="membership-box mb-30" style="overflow:auto">
                                        <div class="membership-info">
                                            <h4>{{ app()->getLocale() == 'en' ? $campaign->title_en : $campaign->title_ar }}
                                            </h4>
                                            <div class="membership-price">
                                                <span>{{ $campaign->total_points }}</span>
                                                <p>Free for starters</p>
                                            </div>
                                            <div class="membership-list">
                                                {!! app()->getLocale() == 'en' ? $campaign->feachers_en : $campaign->feachers_ar !!}

                                            </div>
                                        </div>
                                     
                                    </div>
                                       <a class="membership-btn"
                                            href="{{ route('affiliate.campaign.details', $campaign->slug) }}"> {{ trans('affiliate.explore') }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

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

            <button class="mb-100 membership-btn" style="margin: auto;
    margin-bottom: 50px;
    margin-top: 20px;" >{{ trans('affiliate.signup') }}</button>

        </form>
            @endif
            </div>
            <div class="Advertising">
                <img src="assets/img/adversiting/Rectangle 14.png" alt="">
            </div>

        </div>


    </main>
@endsection

@section('js')
<script>
    const icons = document.querySelectorAll('.icon');
icons.forEach(icon => {
  icon.addEventListener('click', () => {
    icons.forEach(icon => {
      icon.classList.remove('selected');
    });
    icon.classList.add('selected');
  });
});




$(document).ready(function(){
    // Add active class to first slide
    $("#myCarousel .carousel-item:first-child").addClass("active");
    
    // Add active class to next slide when "Next" button is clicked
    $(".carousel-control-next").click(function(){
        var currentSlide = $("#myCarousel .carousel-item.active");
        var nextSlide = currentSlide.next();
        currentSlide.removeClass("active");
        nextSlide.addClass("active");
    });
});

</script>
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



@endsection































