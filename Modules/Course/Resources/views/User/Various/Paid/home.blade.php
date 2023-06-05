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
$settings=cache()->get('settings.variouses')??
[
'price'=>'20',
'preview_video'=>'swarmify://0191981f6b35a38800fa724dae7a7f8a5f61440a257ef6aa87c8139e16a69970',

];

@endphp

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
@if(request()->type == 'videos')
@foreach ($PlayListPaid as $Paid )


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

@else



@foreach ($PlayListPaid as $playlist )

        <div class="one-videos">
            <a href="{{ route('user.paidVideos' , $playlist->id ) }}">
                <img src="{{ asset($playlist->poster) }}" class="video-img" alt="">
            </a>

            <div class="details-video">
                <div>
                    <a href="{{ route('user.paidVideos' , $playlist->id ) }}">
                        <img src="assets/img/course/academic-tutor-1.png" alt="">
                    </a>

                </div>



                @if (App::getLocale() == 'en')
                <h6>   {{  $playlist->title_en }}  </h6>
                     @else
                     <h6>  {{  $playlist->title_ar }}  </h6>
                     @endif


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
                {{ $PlayListPaid->links('vendor.pagination.tailwind') }}
                </div>
        </div>
@endsection





@section('js')

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


