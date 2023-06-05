@extends('user.master')

@section('title')
@if (app()->getLocale()=='ar')
    إحصائياتي
  @else
  My Statistics
@endif

@endsection

@section('css')
<style>
@media only screen and (max-width: 600px) {
  .campaign-table{
     overflow-x:scroll
  }
}
</style>
@endsection
@section('content')
    <main>



        <button class="show-menu d-lg-none">
            <i class="fas fa-stream"></i>
        </button>
        <div class="video-main-content container-fluid">
            <div class="sidebar d-none d-lg-block mt-70">
                @include('user::User.Profile.sidebar')

            </div>
            <div class="course-detalies-area pb-100">
                     <div class="container">


                    <div class="row mt-70">
                        <div class="col-xl-4 col-lg-3">
                            <div class="course-instructors-img mb-30">
                               <img src="{{ asset($user->image??'assets/user/img/1/user.png') }}" alt="nstructors-img">
                            </div>
                         </div>
                         <div class="col-xl-8 col-lg-9">
                            <div class="course-detelies-wrapper">
                               <div class="course-detiles-tittle mb-30">
                                  <h3>{{ $user->name}}</h3>
                               </div>
                               <div class="course-detiles-meta">
                                @if ($user->campaign_type=='money')
                                  <div class="total-course">
                                     <a href="#">
                                        <span> {{ trans('affiliate.total') }}:</span>
                                     <label> {{ $user->wallet?$user->wallet->total:0 }} </label>
                                     </a>

                                  </div>
                                  @endif
                                  <div class="student course">
                                     <span> {{ trans('affiliate.activeuser') }}</span>
                                     <label>{{ $user->users_inactive }}</label>
                                  </div>

                                  @if ($user->campaign_type=='money')
                                  <div class="review-course">
                                    <span> {{ trans('affiliate.lastdraw') }}</span>
                                    <div class="review-course-inner d-flex">

                                       <p>{{ $user->wallet && $user->wallet->lastWithdraw? $user->wallet->lastWithdraw->withdraw_date:'-' }}</p>
                                    </div>
                                 </div>
                                  @endif


                               </div>




                            </div>
                         </div>
                        <div class="col-xl-11 col-lg-11 overflow-auto">

                            @foreach ($campaigns as $campaign)


                            <div class="row overflow-auto">
                                <div class="col-lg-12 overflow-auto" >
                                    <h4 class="text-center" style="margin-top: 22px"> {{ trans('affiliate.regcompaign') }}</h4>
                                    <table class="table table-borderd mt-70 campaign-table" style="overflow-x: auto">
                                        <tr>
                                            <th colspan="8" class="table-primary">{{ $campaign->title_ar }}</th>
                                        </tr>

                                        <tr class="table-warning">
                                            <th> {{ trans('affiliate.level') }}</th>
                                            <th>   {{ trans('affiliate.studentbyme') }} </th>
                                            <th> {{ trans('affiliate.point') }} </th>
                                            <th>  {{ trans('affiliate.levelpoint') }}</th>
                                            <th>   {{ trans('affiliate.pointper') }}</th>
                                            <th>  {{ trans('affiliate.pointprice') }}</th>
                                            <th> {{ trans('affiliate.percentage') }} </th>

                                            <th> {{ trans('affiliate.rewards') }} </th>


                                        </tr>
                                           @php
                                                   $total=0;
                                           @endphp
                                        @foreach ($campaign->levels as $level)

                                         @php

                                             $userlevel=$user->levels->firstWhere('level_id',$level->id);

                                         @endphp
                                        <tr>
                                            <td>{{ $level->title_ar }}</td>
                                            <td>{{ $userlevel && $level->point_per_one!=0 ? (int) ($userlevel->points / $level->point_per_one ) : 0  }}  </td>
                                            <td>{{ $userlevel?$userlevel->points:0 }}</td>
                                            <td>{{ $level->total_point }}</td>
                                            <td> {{ $level->point_per_one}} </td>
                                            <td> {{ $level->point_price}} </td>
                                            <td class="table-success">{{ $userlevel && $level->total_point!=0?number_format(($userlevel->points /$level->total_point) *100,2,",","."):0 }}% </td>

                                            <td>
                                                {{ $user->campaign_type=='money'?'Earn money for every user':'Get Reward as courses' }}
                                            </td>
                                        </tr>
                                        @php

                                             $money=(float)($userlevel?number_format($userlevel->points * $level->point_price,2,",","."):0);
                                             $total=$total+$money;
                                        @endphp
                                        @endforeach
                                        @if ($user->campaign_type=='money')
                                        <tr>
                                            <td colspan="7"></td>
                                            <td class="table-primary">مجموع={{  $total }}$</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <div class="course-share">
                                        <a id="share_btn"  onclick="copyShareLink(event)" href="#" class="btn btn-default"><i data-sahre-link="{{ route('register')."?share_id=".$user->uuid."&camp_id=".$campaign->slug }}" class="far fa-share-alt"></i></a>
                                     </div>
                                    </div>
                                </div>
                            @endforeach


                    </div>
                </div>
            </div>
        </div>


        </div>


    </main>
@endsection





@section('js')

@if (count($campaigns))


<script>
    function copyShareLink(event){
          event.preventDefault();
          if(event.target.dataset && event.target.dataset.sahreLink){
            var  value=event.target.dataset.sahreLink
            var tempInput = document.createElement("input");
            tempInput.value =value;
            document.body.appendChild(tempInput);
            tempInput.select();
            // Copy the selected text to the clipboard
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    $("#share_btn").html("Share linke copied!")
       setTimeout(() => {
        var div=`<i data-sahre-link="{{ route('register')}}${value}" class="far fa-share-alt"></i>`;
        $("#share_btn").html(div)
       },3000);


          }

    }
</script>
@endif
@endsection
