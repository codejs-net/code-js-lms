
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta name="_token" content="{{ csrf_token() }}">  -->



    <title>{{ config('app.name', 'Laravel') }}</title>

   

    <!-- ============================== Styles============================= -->
    <!-- Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fa-fa/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    
     <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-bootstrap/main.min.css') }}">
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- SmartWizard -->
    <link href="{{ asset('plugins/smart_wizard/css/smart_wizard.min.css') }}" rel="stylesheet">


     <!-- Site Custom -->
     <link href="{{ asset('css/site.css') }}" rel="stylesheet">

    <!-- ======================================================================== -->

    @yield('style')


     

</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->

<div class="wrapper">
@php 
    session_start();
    $user = session()->get('user'); 
    $locale = session()->get('locale');
    if(empty($locale))
    {
        Session::put('locale', 'si');
    }
@endphp 

    @include('partials.header')
    <aside class="main-sidebar sidebar-dark-indigo elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('img/js2.png') }}" alt="lms" class="brand-image img-circle elevation-5"
                 style="opacity: 1">
            <span class="brand-text font-weight-light">LMS</span>
        </a>
        @include('partials.sidebar')
    </aside>

    <div class="content-wrapper">
        <main role="main" class="pb-4">
        @yield('content')
        </main>
    </div>
    @include('partials.footer')
   
    <!-- ================================Scripts ================================ -->

    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}"></script>
    
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/apex/apexcharts.js') }}"></script>

    <!-- smart_wizard -->
    <script src="{{ asset('plugins/smart_wizard/js/smart_wizard.min.js') }}"defer></script>
    
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
  
    <!-- jQuery-Datatable -->
  <script src="{{ asset('plugins/datatables-jquery/js/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>

    <!-- ======================================================================== -->

    <script>
    
 //- ---------------------alert Auto Close---------------------->

    window.setTimeout(function() {
        $(".alert").fadeTo(1500, 0).slideUp(1500, function(){
            $(this).remove(); 
        });
    }, 1000);

/// ------------form validetion---------------------------------------

// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


// ------------------------------------------------------------------

//Click event handler for nav-items
$('.nav-link').on('click',function(){
  $('.nav-link').removeClass('active');
  $(this).addClass('active');
});



// $('.toast').toast({
//     delay:2000,
// });

</script>


@if (session('success'))
  <script>toastr.success('<?php echo session('success'); ?>')</script>
@endif
@if (session('error'))
  <script>toastr.error('<?php echo session('error'); ?>')</script>
@endif
@if (session('warning'))
  <script>toastr.success('<?php echo session('warning'); ?>')</script>
@endif
@if (session('info'))
  <script>toastr.info('<?php echo session('info'); ?>')</script>
@endif


@stack('scripts')

@yield('script')
    

</div>

</body>
</html>
