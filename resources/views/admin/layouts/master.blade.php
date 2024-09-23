<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo-ipeun.png') }}" />
    <title>Dashboard Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo-min.png') }}" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">

    @yield('addCss')
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"
        style="background: linear-gradient(to bottom, #009600, #198754);"></div>
    @include('admin.layouts.sidebar')

    <main class="main-content position-relative border-radius-lg">
        @include('admin.layouts.navbar')

        <div class="container-fluid py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </div>

    </main>

    @include('sweetalert::alert')

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/dataTables-1.13.7.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>

    <script src="{{ asset('js/alert.js') }}"></script>

    @yield('addJs')
</body>

</html>
