<!-- JAVASCRIPT -->

<script src="{{ asset('assets/admin/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/admin/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/admin/libs/node-waves/waves.min.js')}}"></script>


<script src="{{ asset('assets/admin/js/app.js')}}"></script>
@if (Route::is('admin.message.chat') || Route::is('admin.message.index'))

<script src="{{ mix('js/app.js') }}"></script>

@endif
@stack('js')

