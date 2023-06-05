@extends('user.master')

@section('title')
    الرئيسسية
@endsection

@section('css')
@endsection
@section('content')
<main >

<button class="show-menu d-lg-none">
    <i class="fas fa-stream"></i>
</button>
<div class="video-main-content container-fluid" style="margin-top: 116px;">
    <div class="sidebar d-none d-lg-block">
        @include('user::User.Profile.sidebar')

    </div>
    <div class="course-detalies-area">
        <div class="container">
           <div class="row">
              <div >



                 <div class="generalpofile">
                    <h3>{{ trans('myProfile_trans.profile') }}</h3>

                    <form class="form-valide" action="{{ route('profile.update') }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 ">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="name">  {{ trans('profile.my_name')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>
                                </div>


                            </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">  {{ trans('profile.email')}}<span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="email" class="form-control" disabled id="email" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        </div>




                              <div class="col-xl-6 mt-4 mb-4">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="age"> {{ trans('profile.age')}}<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="age" name="age" rows="5" value="{{$user->age}}" required >
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <label class="col-lg-4 col-form-label" for="phone"> {{ trans('phone')}}<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="phone" name="phone" rows="5" value="{{$user->phone}}" required >
                                    </div>
                                </div>
                              </div>
                            <div class="col-xl-6 mt-4 mb-4">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="gender"> {{ trans('profile.gender')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="" id="gender" name="gender" >
                                            <option value="male" {{$user->gender=='male'?'selected':''}}>   {{ trans('profile.male')}} </option>
                                            <option value="female" {{$user->gender=='female'?'selected':''}}> {{ trans('profile.female')}} </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <label class="col-lg-4 col-form-label" for="image">  {{ trans('profile.image')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 mt-2" style="text-align: center">
                            <button type="submit" class="edu-btn">  {{ trans('profile.save')}} </button>

                        </div>                            </div>

                    </form>


                </div>
              </div>

           </div>
        </div>
     </div>


</div>

<!-- End Section Six -->




















    </main>

@endsection





@section('js')



@endsection


