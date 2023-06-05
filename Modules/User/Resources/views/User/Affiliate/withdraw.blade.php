@extends('user.master')

@section('title')
    @if (app()->getLocale() == 'ar')
        withdrawal
    @else
        عمليات السحب
    @endif
@endsection

@section('css')
    <style>
        @media only screen and (max-width: 600px) {
            .campaign-table {
                overflow-x: scroll
            }
        }
    .student.course::before {
  position: absolute !important;
  content: "" !important;
  width: 0 !important;

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

                        <div class="col-xl-6 col-lg-6">
                            <div class="course-detelies-wrapper">

                                <div class="course-detiles-meta">
                                    @if ($user->campaign_type == 'money' || auth()->user()->wallet)
                                        <div class="total-course">
                                            <a href="#">
                                                <span>{{ trans('affiliate.total') }}:</span>
                                                <label> {{ $user->wallet ? $user->wallet->total : 0 }} </label>
                                            </a>
                                            <p>اقل مبلغ للسحب :60$</p>
                                            <p>اعلى مبلغ للسحب:300$</p>

                                        </div>
                                    @endif
                                    <div class="student course text-center">
                                       <div style="margin-left: 40px;">
                                        <span>
                                            {{ trans('affiliate.avaliable_withdraw') }}
                                        </span>
                                        @php
                                        if( $user->wallet && $user->wallet->total>=config('services.stripe.min-withdraw'))
                                        {
                                            $balance=$user->wallet->total;
                                            if($user->wallet->total>config('services.stripe.max-withdraw'))
                                            {
                                                $balance=($user->wallet->total-config('services.stripe.max-withdraw'))-$user->wallet->total;
                                                $balance*=-1;
                                            }


                                        }else{
                                            $balance=0;
                                        }


                                        @endphp
                                        <label>{{ $balance > 0 ? $balance : 0 }}</label>
                                       </div>
                                    </div>






                                </div>




                            </div>
                        </div>


                        <div class="col-xl-12  col-lg-12">




                            <section class="membership-area pt-110">


                                        <p>
                                            <a class="btn btn-primary" style="background-color: #010a2e" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                {{ trans('affiliate.withdraw') }}                                            </a>
                                            @if ($user->connect_account_id && $user->has_completed_on_boarding)
                                            <a class="btn btn-primary" style="background-color: #010a2e" href="{{ route('affiliate.wallet.withdrawal.login_account') }}">
                                                {{ trans('affiliate.goToMyAccount') }}
                                              </a>
                                            @endif
                                          </p>

                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    @if ($user->connect_account_id==null)


                                                    <div class="col-xl-12 col-lg-6">
                                                        <div class="section-title text-center mb-40">
                                                            {{ trans('affiliate.withdrawguide') }}
                                                           <h2></h2>
                                                            <p>   {{ trans('affiliate.withdrawguide1') }}</p>
                                                            <a href="{{ route('affiliate.wallet.withdrawal.create_account') }}" class="btn btn-primary" style="background-color: #010a2e" > {{ trans('affiliate.withdraw') }} </a>
                                                    </a>
                                                        </div>

                                                    </div>

                                                    @elseif (!$user->has_completed_on_boarding)
                                                    <div class="col-xl-12 col-lg-6">
                                                        <div class="section-title text-center mb-40">
                                                            <h2></h2>
                                                            <p> {{ trans('affiliate.withdrawguide2') }}</p>
                                                            <a href="{{ route('affiliate.wallet.withdrawal.complete_account') }}" class="btn btn-primary" style="background-color: #010a2e" >Complete My Account</a>
                                                        </div>

                                                    </div>

                                                    @else
                                                    <div class="col-xl-12 col-lg-6">
                                                        <div class="section-title text-center mb-40">

                                                            <p>  {{ trans('affiliate.enteramount') }}</p>
                                                            <form action="{{ route('affiliate.wallet.withdrawal')}}" method="post">
                                                                @csrf
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" value="{{old('amount')}}" name="amount" class="form-control" placeholder="60">
                                                                    <label for="floatingInput">المبلغ</label>
                                                                    @if ($errors->has('amount'))
                                                                    <span class="text-danger" style="margin-top:2px;">
                                                                     {{ $errors->first("amount") }}
                                                                    </span>
                                                               @endif

                                                                  </div>

                                                                  <button style="background-color: #010a2e" class="btn btn-primary" >    {{ trans('affiliate.withdraw') }} </a>
                                                                  </button>

                                                            </form>
                                                        </div>

                                                    </div>

                                                    @endif
                                                </div>
                                              </div>







                            </section>



                        </div>
                        <div class="col-xl-12 col-lg-12">

                            @if ($wallet && count($wallet->withdraws) > 0)
                                <h4 class="text-center" style="margin-top: 22px"> عمليات السحب </h4>

                                <table class="table table-borderd mt-70 campaign-table">

                                    <tr class="table-warning">
                                        <th>                                         </a>
                                        </th>

                                        <th>{{ trans('affiliate.date_of_withdraw') }}     </th>

                                    </tr>

                                    @foreach ($wallet->withdraws as $withdraw)
                                        <tr>
                                            <td>{{ $withdraw->total }}</td>
                                            <td>{{ $withdraw->withdraw_date }} </td>


                                        </tr>
                                    @endforeach
                                </table>
                            @else

                                <div class="col-lg-12 text-center" style="margin-top: 20px">
                                    <h4 style="margin-top: 15px">  {{ trans('affiliate.notoffer') }} </h4>
                                    <img src="{{ asset('assets/user/img/1/ff.png') }}" style="margin-top: 50px"
                                        width="150" alt="">

                                </div>

                            @endif


                        </div>





                    </div>

                </div>
            </div>
        </div>






















    </main>
@endsection






@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
