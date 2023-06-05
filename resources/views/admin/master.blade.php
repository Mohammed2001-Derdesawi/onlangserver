<!doctype html>
<html lang="en" dir="rtl">


@include('admin.head')

    <body data-topbar="dark">



    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">



            @include('admin.mainheader_bar')

            @include('admin.mainside_bar')


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content" id="app">
                   @yield('content')
                <!-- End Page-content -->
                @include('admin.footer')

            </div>

            <!-- end main content-->


        </div>
        <!-- END layout-wrapper -->






        @include('admin.footer_scripts')

    </body>

</html>
