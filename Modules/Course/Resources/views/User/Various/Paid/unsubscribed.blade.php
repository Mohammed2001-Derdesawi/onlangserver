@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
<meta name="description" content="{{ trans('main_trans.seo_description') }}">
<meta name="keywords" content="فيديوهات بدون حقوق,فيديوهات بدون حقوق ملكية,فيديوهات,مدفوعة,كورسات مدفوعة مجانا,فيديوهات مجانية للمونتاج,احصل على دورات مدفوعة,تطبيقات مدفوعة مجانا,شركة مدفوعة,تحرير الفيديوهات,فيديوهات بدون حقوق نشر,كورسات مدفوعة بالمجان,تطبيقات مدفوعه,الحصول على دورات مدفوعة,برامج مدفوعة,تطبيقات مدفوعه جديده 2022,نصابين مدفوعة,فيديوهات اونلي فانز ببلاش,ابلكيشن مدفوعة,احصل على دورات مدفوعة مجانا,افكار فيديوهات بدون الظهور,فيديوهات للمونتاج بدون حقوق , educational videos for kids,blippi videos,educational videos for toddlers,education,educational,educational videos,kids educational videos,educational videos for children,kg educational videos,learning videos,educational video,kids education,kids educational video,educational video for kids,blippi educational videos for kids,preschool education videos,videos for kids,best educational videos for toddlers,educational video for children , تعليم,تطبيقات تعليم اللغات,تعليم اللغات,تعلم اللغات,لغات,تطبيق طليق لتعلم اللغات,تعلم اللغات الاجنبية,كيف تتعلم اللغة الانجليزية,تعليم scc,أكثر اللغات تعلماً,أهم لغات في العالم,تعليم الطفل,تعليم اللغة الصينية,تعليم اللغة الروسية,تعليم لغة تركية تعلم لغة تركية,تعليم الاطفال,اسهل تعليم css,تعليم اللغة الاسبانية,تطبيق تعلم اللغات,تعلم اللغات بسرعة,تعلم اللغات ابراهيم عادل,تعليم اللغة الانجليزية,تعلم اللغات بسهولة,تعلم اللغات وأنت نائم,تتعلم , تعليم الاطفال,تعليم الارقام,تعليم الحروف,تعليم,فيديوهات تعليم للاطفال,تعليم الالوان,تعليم العربية,تعليم اسماء الحيوانات,تعليم الطفل,تعليم الاشكال,تعليم الأطفال,تعليم حروف الهجاء,تعليم الطفل المسلم,تعليم اسماء الفواكه,تعليم اللغة الانجليزية,تعليم اطفال,فيديو تعليمي,تعليمي الفيديو,فيديوهات رائعة,فيديوهات اطفال,تعليم النطق للأطفال,العاب تعليمية,فديوهات,تعليم ديني,تعليم الالوان للاطفال,تعليم الألوان للأطفال,فيديوهات مفيدة للاطفال,تعليم ال">

<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection
@section('content')
@php
$settings=cache()->get('settings') && isset(cache()->get('settings')['subscribes_page'])?cache()->get('settings')['subscribes_page']:config('front_settings.subscribes_page');
@endphp

<main style="margin-top:120px">

        <section class="cart-area pt-100 pb-100" style="margin-top:50px;padding-bottom: 220px ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">


                    </div>
                    <div class="row" style="padding-top:40px ">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">


                                <h2 style="text-align: center;font-size: 30px" > <i style="font-size: 30px" class="far fa-hand-point-down"></i>{{ $settings[app()->getLocale()]['title'] }} </h2>
                                <div class="mymainvideo1" style="text-align: center">
                                    <smartvideo class="mymainvideo swarm-fluid" controls playsinline
                                  poster=" {{ $settings['poster'] }}"
                                    src=" {{ $settings['video'] }} ">
                        </smartvideo>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">


                                <h2 style="text-align: center;font-size: 30px"><i style="font-size: 30px" class="far fa-hand-point-down"></i>  {{ $settings[app()->getLocale()]['card_title'] }} </h2>
                                <div class="order-button-payment mt-20" style="padding-top: 50px">
                                    <form action="{{ route('various.payment.confirm') }}" method="POST" id="subscribe-form">

                                        <label for="card-holder-name form-control">الاسم على البطاقة </label> <br>
                                        <input id="card-holder-name" type="text" class="form-control mb-4">
                                        @csrf
                                        <div class="form-row mt-4">
                                            <label for="card-element">رقم البطاقة </label>
                                            <div id="card-element" class="form-control">
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                        <div class="stripe-errors"></div>
                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                            @endforeach
                                        </div>
                                        @endif
                                        <div class="form-group text-center mt-4">
                                            <button  style="font-size: 15px" id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-primary btn-block">الاشتراك في خدمة الفيديوهات المدفوعة مقابل {{ $settings['price'] }} دولار </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

























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
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log("attempting");
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            paymentMethodHandler(setupIntent.payment_method);
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        console.log(payment_method)
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>

{{--  var stripe = Stripe('{{ config('services.stripe.publishable_key') }}');
var elements = stripe.elements();
var cardElement = elements.create('card');
  cardElement.mount('#card-element');  --}}

@endsection


