<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="/assets/images/logo_lcc.png" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    @include('layouts.sidebar')

    @include('layouts.navbar')


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        @yield('content')
    </div>

    <footer class="py-3 d-flex justify-content-end pr-4">
        {{-- <p class="text-white my-auto mr-3">dibuat oleh</p> --}}
        <img src="/assets/images/logo_lcc.png" width="30" alt="">
        <h5 class="text-white my-auto ml-2">copyright &copy; 2024</h5>
    </footer>

    <!-- Required Js -->
    <script src="/assets/js/vendor-all.min.js"></script>
    <script src="/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/assets/js/ripple.js"></script>
    <script src="/assets/js/pcoded.min.js"></script>
    <!-- Apex Chart -->
    <script src="/assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="/assets/js/pages/dashboard-main.js"></script>
    {{-- Alert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('script')
</body>

</html>
