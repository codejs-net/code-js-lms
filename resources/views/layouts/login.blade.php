<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}"> 
    <title>{{ config('app.name', 'Laravel') }}</title>

<!-- Bootstrap -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<link href="{{ asset('css/login-util.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fa-fa/css/font-awesome.min.css') }}">
 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
<!--===============================================================================================-->

</head>
<body>
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
        
    <div class="content-wrapper">
        <main role="main" class="pb-4">
        @yield('content')
        </main>
    </div>
        
    <!--===============================================================================================-->
        <!-- Bootstrap 4 -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/login.js') }}" defer></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

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


    toastr.options = {
        positionClass: 'toast-top-center'
    };

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