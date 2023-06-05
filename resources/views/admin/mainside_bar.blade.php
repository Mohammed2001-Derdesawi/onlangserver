<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                @php
                $admin=auth()->guard('admin')->user();
                $src=$admin->image?asset($admin->image):asset('assets/admin/images/users/avatar-2.jpg');
            @endphp

                <img src="{{$src}}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{$admin->name}}</h4>
               @if ($admin->can('جميع الصلاحيات super_admin'))
               <span class="text-muted">مدير موقع OnLanguage</span>
               @endif
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                 @if ($admin->can('عرض لوحة التحكم') || $admin->can('جميع الصلاحيات super_admin')  )
                 <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>
                 @endif

                <li class="menu-title text-muted">القوائم</li>

                @if ($admin->can('عرض لغة') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-language"></i>
                        <span>اللغات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.language.index')}}">حميع اللغات</a></li>
                        @if ($admin->can('إنشاء لغة') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.language.create')}}">إضافة لغة</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($admin->can('عرض كورس') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-graduation-cap "></i>
                         <span>الكورسات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.course.index')}}">حميع الكورسات</a></li>
                        @if ($admin->can('إنشاء كورس') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.course.create')}}">إضافة كورسات</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($admin->can('عرض محاضرة') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-video-chat-line"></i>
                        <span>المحاضرات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.lecture.index')}}">حميع المحاضرات</a></li>
                        @if ($admin->can('إنشاء محاضرة') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.lecture.create')}}">إضافة محاضرة</a></li>
                        @endif
                    </ul>
                </li>

                @endif

                @if ($admin->can('عرض معلم') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>المعلمين</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.teacher.index')}}">حميع المعلمين</a></li>
                        @if ($admin->can('إنشاء معلم') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.teacher.create')}}">إضافة معلم</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if ($admin->can('عرض طالب') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-graduate"></i>
                        <span>الطلاب</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.student.index')}}">حميع الطلاب</a></li>
                        @if ($admin->can('إنشاء طالب') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.student.create')}}">إضافة طالب</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if ($admin->can('عرض مقال') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-newspaper"></i>
                         <span>المقالات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.article.index')}}">حميع المقالات</a></li>
                        @if ($admin->can('إنشاء مقال') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.article.create')}}">إضافة مقال</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if ($admin->can('عرض البلاي ليست') || $admin->can('جميع الصلاحيات super_admin')  )

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-play"></i>
                         <span>playlists</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.group.index')}}">حميع playlists</a></li>
                        @if ($admin->can('إنشاء البلاي ليست') || $admin->can('جميع الصلاحيات super_admin')  )

                        <li><a href="{{route('admin.group.create')}}">إضافة playlist</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if ($admin->can('عرض منوعة') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-play"></i>
                         <span>الفيديوهات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.various.index')}}">جميع الفيديوهات</a></li>

                        @if ($admin->can('إنشاء منوعة') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.various.create')}}">إضافة فيديو</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($admin->can('عرض رأي') || $admin->can('جميع الصلاحيات super_admin')  )

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-comment"></i>
                     <span>الآراء</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.opinion.index')}}">حميع الآراء</a></li>
                        @if ($admin->can('إنشاء رأي') || $admin->can('جميع الصلاحيات super_admin')  )

                        <li><a href="{{route('admin.opinion.create')}}">إضافة رأي</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($admin->can('عرض تقييم') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-star"></i>
                     <span>التقييمات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.review.index')}}">حميع التقييمات</a></li>

                    </ul>
                </li>
                @endif

                @if ($admin->can('عرض الرسائل') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    @php
                    $admin->loadCount('UnReardreceivedMessages as receieved_messages');
                    $unread_messages=$admin->receieved_messages;

                @endphp
                    <a href="javascript: void(0);" class="has-arrow waves-effect">

                        <span class="badge rounded-pill bg-success float-end">{{$unread_messages}}</span>
                        <i class="fas fa-bell"></i>
                     <span>الرسائل</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">


                        <li><a href="{{route('admin.message.chat')}}">الرسائل الواردة</a></li>
                        @if ($admin->can('إنشاء الرسائل') || $admin->can('جميع الصلاحيات super_admin')  )

                        <li><a href="{{route('admin.message.index')}}">إضافة رسالة</a></li>
                        @endif
                        @if ($admin->can('إرسال الرسائل') || $admin->can('جميع الصلاحيات super_admin')  )

                        <li><a href="{{route('admin.message.outside')}}">إرسال رسائل خارجية</a></li>
                        @endif
                    </ul>
                </li>

                @endif

                @if ($admin->can('عرض نظام التربح') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-money-bill"></i>
                     <span>أنظمة التربح</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.campaign.index')}}">أنظمة التربح</a></li>
                        @if ($admin->can('إنشاء نظام التربح') || $admin->can('جميع الصلاحيات super_admin')  )

                        <li><a href="{{route('admin.campaign.create')}}">إضافة نظام تربح</a></li>
                        @endif
                        @if ($admin->can('عرض مستوى') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.level.index')}}">المستويات</a></li>
                        @endif
                        @if ($admin->can('إحصائيات نظام التربح') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.statistic.users')}}">إحصائيات المستخدمين</a></li>
                        @endif
                    </ul>
                </li>

                @endif

                @if ($admin->can('عرض مستخدم') || $admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user"></i>
                     <span>المستخدمين</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.admins.index')}}">المستخدمين</a></li>
                        @if ($admin->can('إنشاء مستخدم') || $admin->can('جميع الصلاحيات super_admin')  )
                        <li><a href="{{route('admin.admins.create')}}">إنشاء مستخدم</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($admin->can('جميع الصلاحيات super_admin')  )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                                             <span>الصلاحيات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.role.index')}}">الصلاحيات</a></li>
                        <li><a href="{{route('admin.role.create')}}">إنشاء الصلاحيات</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{URL::to('/admin/user-activity')}}">
                        <i class="fa fa-lock"></i>
                        <span>النشاطات</span>
                    </a>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                         <span>الإعدادات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.setting.home')}}">الرئيسية</a></li>
                        <li><a href="{{route('admin.setting.aboutus')}}">من نحن</a></li>
                        <li><a href="{{route('admin.setting.monthlypage')}}">الإشتراك الشهري</a></li>
                        <li><a href="{{route('admin.setting.general.info.page')}}">الإعدادات العامة ومعلومات الإتصال</a></li>
                    </ul>
                </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
