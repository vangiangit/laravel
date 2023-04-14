<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
    @hasSection('page-title')
        @yield('page-title')
    @else
        Dashboard
    @endif
</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('statics/plugins/fontawesome-free/css/all.min.css')}}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{asset('statics/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('statics/admin/css/adminlte.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('statics/plugins/toastr/toastr.min.css')}}">

<link rel="stylesheet" href="{{asset('statics/admin/css/sixdo.css')}}?v={{time()}}">
