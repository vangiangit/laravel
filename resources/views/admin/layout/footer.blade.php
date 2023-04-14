<!-- jQuery -->
<script src="{{asset('statics/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('statics/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('statics/admin/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('statics/plugins/toastr/toastr.min.js')}}"></script>

@if(App\Services\SessionService::has('error'))
    <script>
        toastr.error("{{App\Services\SessionService::remove('error')}}");
    </script>
@endif

@if(App\Services\SessionService::has('success'))
    <script>
        toastr.success("{{App\Services\SessionService::remove('success')}}");
    </script>
@endif
