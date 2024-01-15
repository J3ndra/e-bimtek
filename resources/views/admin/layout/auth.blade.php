<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', $page_title ?? '') | {{ config('app.name') }}</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('vendor/spinkit.css') }}" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('css/material-icons.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('css/preloader.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body class="layout-default layout-login-centered-boxed">

    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('vendor/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('vendor/material-design-kit.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Preloader -->
    <script src="{{ asset('js/preloader.js') }}"></script>

    @yield('scripts')
</body>

</html>
