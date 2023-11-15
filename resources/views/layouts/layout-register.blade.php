<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('page') | @yield('title')</title>
    <link rel="icon" href="{{ URL::asset('assets/img/logo-v1.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ URL::asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- Plugins -->
    @stack('plugins-css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/components.css') }}">
    @stack('template-css')

</head>

<body>
    
    @yield('content')

    <!-- General JS Scripts -->
    <script src="{{ URL::asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/modules/popper.js') }}"></script>
    <script src="{{ URL::asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ URL::asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ URL::asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/stisla.js') }}"></script>

    <!-- Plugins -->
    @stack('plugins-js')

    <!-- Page Specific JS File -->
    @stack('specific-js')

    <!-- Template JS File -->
    <script src="{{ URL::asset('assets/js/scripts.js') }}"></script>
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>
</body>
</html>