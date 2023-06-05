@extends('user.master')

@section('title')
    Messages
@endsection

@section('css')
<style>
.message-invalid{
    border-color: #dc3545;
padding-right: calc(1.5em + .75rem);
background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
background-repeat: no-repeat;
background-position: left calc(.375em + .1875rem) bottom;
background-size: calc(.75em + .375rem) calc(.75em + .375rem);

}
</style>
@endsection
@section('content')
<main>


<div class="video-main-content container-fluid">


    <main>

        <button class="show-menu d-lg-none">
            <i class="fas fa-stream"></i>
        </button>

        <div class="video-main-content container-fluid"  style="margin-top: 116px;">
            <div class="sidebar d-none d-lg-block">
                @include('user::User.Profile.sidebar')

            </div>



            <div class="all-notifications">
                <div id="messages">


                @foreach ($messages as $message)
                  <div class="messages">
                    @if ($message->sender_id!=$user->id || $message->sender_type!=get_class($user))


                    <div class="mainnotification">
                      <img src="{{asset('assets/user/img/1/logo.png')}}" alt="">
                      <span class="sender">OnLangauage Courses Admin</span>
                      <span class="datenotify">{{ $message->created_at }}</span>

                      <h5>
                          {!!  $message->message !!}
                      </h5>


                    </div>
                    @else
                    <div class="mainnotification recieve-part" >
                      <img src="{{$user->image?asset($user->image):asset('assets/user//img/1/F.png')}}" alt="" class="recieve" />
                      <span class="sender recieve">{{$user->name??'User'}}</span>
                      <span class="datenotify recieve1">{{ $message->created_at }}</span>

                       <br>
                      <div>
                        <p class="recieve">{{  $message->message }} </p>

                      </div>
                    </div>


                    @endif
                  </div>

              @endforeach
            </div>



              <div class="addreply">
               <form action="#">
                <textarea class="form-control" id="message" cols="30" rows="5" placeholder=" اكتب رسالتك هنا "  oninput="checkMessage(this.value)" ></textarea>

                <button class="mt-3" onclick="SendMessage(event)">     {{ trans('myProfile_trans.send') }}</button>

            </form>
        </div>




            </div>
        </div>

        <!-- End Section Six -->




















            </main>
</div>

<!-- End Section Six -->





    </main>
@endsection





@section('js')
<script>
    $(document).ready(function(){
        $("#message").on('input',function( event ) {
        $("#message").removeClass('message-invalid')
        event.preventDefault();
});
    })

    function checkMessage(message){
          if(message!='Send Your Message' && message.length>1)
          return true;

          $("message").val('')
          $("#message").addClass('message-invalid')
          return false;
    }
    function SendMessage(event){
        event.preventDefault();

        var message=$("#message")
        var messagesdiv=$("#messages")



        $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })

        if(checkMessage(message.val())){
            var image="{{ $user->image?asset($user->image):asset('assets/user/img/1/F.png')}}";
            var newchild= `           <div class="messages">
            <div class="mainnotification recieve-part" >
                      <img src="${image}" alt="" class="recieve">
                      <span class="sender recieve">`+"{{$user->name??'User'}}"+`</span>
                      <span class="datenotify recieve1">now</span>
                      <br>
                      <hp class="recieve">


                          `+message.val()+`

                      </p>


                    </div>
                    </div>`;
            messagesdiv.append(newchild)
            $.ajax({
            type: "post",
            dataType: 'json',
            data:{
                message:message.val()
            },
            url: "{{route('user.message.send.to.onlanguages')}}",
            success:function(data){

                  if(data.message){
                       message.val('')
                  }else{
                    message.val('')

                  }




        }

        })
        }
    }
</script>


@endsection
