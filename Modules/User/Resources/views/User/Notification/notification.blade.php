@extends('user.master')

@section('title')
@endsection

@section('css')
    <style>
        .nice-select .option:hover, .nice-select .option.focus, .nice-select .option.selected.focus{
            background-color: rgb(208, 207, 110)
        }
        .nice-select .option {
            padding-right: 4px;
        }
      .nn{
        margin-right: 30%
      }
      @media (max-width:767px) {
        .nn{
            margin-right: 0%
          }
      }
</style>
@endsection
@section('content')
<main>
    <div class="video-main-content container-fluid">
        <div class="sidebar d-none d-lg-block mt-70">
            @include('user::User.Profile.sidebar')

        </div>
        <div class="course-detalies-area pb-100">
                 <div class="container">


                <div class="row mt-70">

                    <div class="event-ara pt-120 pb-90">
                        <div class="container">
                            <div class="row search-filter" >
                                <div class="col-xl-4 col-lg-5 col-md-8 nn" >
                                    <div class="sidebar-widget-wrapper">
                                       <div class="sidebar-widget mb-30">
                                          <div>
                                           <div>
                                           <form action="" method="get">
                                               <select  name="notify" onchange="this.form.submit()">
                                                   <option style="color: black"     value="" {{ request('notify')==''?'selected':'' }} selected>    {{ trans('myProfile_trans.allNotification') }} </option>
                                                   <option style="color: black"  class="user-btn-sign-in"  value="unread" {{ request('notify')=='unread'?'selected':'' }}>   {{ trans('myProfile_trans.unreadNotification') }} </option>
                                                   <option style="color: black"  class="user-btn-sign-in" value="read" {{ request('notify')=='read'?'selected':'' }}>   {{ trans('myProfile_trans.readNotification') }}</option>
                                                </select>
                                           </form>
                                            </div>
                                          </div>
                                       </div>

                                    </div>
                                 </div>
                            </div>
                           <div class="row">

                            @foreach ($notifications as $notification)

                            <div class="col-xl-8 col-lg-7">
                                 <div class="single-item mb-30">
                                    <div class="event_date f-left">
                                       <div class="event_date_inner">
                                          <h4>{{ $notification->created_at->format('d') }}</h4>
                                          <span>{{ $notification->created_at->format('M Y') }}</span>
                                       </div>
                                    </div>
                                    <div class="event_info">
                                       <h3><a href="#">{{  $notification->data['title'] }}</a></h3>
                                       <div class="event-detalis d-flex align-items-center">
                                          <div class="event-time mr-30 d-flex align-items-center">
                                             <span style="
                                             width: 308px;">

                                             {{ isset($notification->data['message'])?$notification->data['message']:'-'}}
                                            </span>
                                          </div>

                                       </div>

                                    </div>
                                    @if ($notification->read_at==null)


                                    <div class="get-ticket-btn">
                                       <a class="get-btn" href="{{ route('user.notification.markasread',$notification->id) }}">  {{ trans('main_trans.asread') }}</a>
                                    </div>
                                    @endif
                                 </div>

                            </div>

                            @endforeach

                            @if (count($notifications)==0)
                            <div class="col-xl-8 col-lg-7">
                                <div class="single-item mb-30">
                                   <div class="event_date f-left">
                                      <div class="event_date_inner">
                                        <i class="far fa-bell" style="font-size: 68px"></i>
                                      </div>
                                   </div>

                                   <div class="event_info">

                                      <h3><a href="#"></a></h3>
                                      <div class="event-detalis d-flex align-items-center">
                                         <div class="event-time mr-30 d-flex align-items-center">
                                            <span style="
                                            width: 308px;">

                                            {{ trans('myProfile_trans.notYetNotification') }}                                            </span>
                                         </div>

                                      </div>

                                   </div>

                                </div>

                           </div>
                            @endif

                           </div>
                        </div>
                     </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
        </div>
    <!-- event-area start -->

    <!-- event-area-end -->

 </main>

@endsection





@section('js')
@endsection


