
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                     <img width="120px"  src="{{ asset('assets/user/img/logo/main_logo.png')}}" height="120" class="logo-dark mx-auto" alt="">
                                </span>
                                <span class="logo-lg">
                                     <img width="120px"  src="{{ asset('assets/user/img/logo/main_logo.png')}}" height="80"  alt="">
                                </span>
                            </a>

                             <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                                <span class="logo-sm">
                                     <img width="120px"  src="{{ asset('assets/user/img/logo/main_logo.png')}}" height="120" class="logo-dark mx-auto" alt="">
                                </span>
                                <span class="logo-lg">
                                     <img width="120px"  src="{{ asset('assets/user/img/logo/main_logo.png')}}" height="80"  alt="">
                                </span>
                            </a>

                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>

                        <!-- App Search-->



                    </div>

                    <div class="d-flex">






                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="ri-fullscreen-line"></i>
                            </button>
                        </div>



                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                     $admin=auth()->guard('admin')->user();
                                    $src=$admin->image?asset($admin->image):asset('assets/admin/images/users/avatar-2.jpg');
                                @endphp
                                <img class="rounded-circle header-profile-user" src="{{$src}}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1">{{$admin->name}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('admin.myprofile')}}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{route('admin.logout')}}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="ri-shut-down-line align-middle me-1 text-danger"></i>تسجيل خروج</button>

                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </header>
