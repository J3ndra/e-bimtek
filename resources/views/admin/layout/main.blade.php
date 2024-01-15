<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', $page_title ?? '') | {{ config('app.name') }}</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" type="image/jpg" href="{{ Storage::url(setting('favicon')) }}"/>
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

<body class="layout-app ">
    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
        <!-- <div class="sk-bounce"><div class="sk-bounce-dot"></div><div class="sk-bounce-dot"></div></div> -->
        <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
    </div>
    <!-- Drawer Layout -->
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <!-- Header -->
            @include('admin.layout.partials.header')
            <!-- // END Header -->
            <!-- BEFORE Page Content -->
            <!-- // END BEFORE Page Content -->
            <!-- Page Content -->
            @yield('content')
            <!-- // END Page Content -->
            <!-- Footer -->
            @include('admin.layout.partials.footer')
            <!-- // END Footer -->
        </div>
        <!-- // END drawer-layout__content -->
        <!-- Drawer -->
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                @include('admin.layout.partials.sidebar')
            </div>
        </div>
        <!-- // END Drawer -->
    </div>
    <!-- // END Drawer Layout -->
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

    <!-- Ajax CSRF Token Setup -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
