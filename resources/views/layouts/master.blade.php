<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo-min.png') }}" />
    <title>Buku Tamu DBMPR</title>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
</head>

<body style="background-color: #bce8db !important">
    <nav class="navbar" style="background-color: #def4ed">
        <div class="container text-center">
            <div class="row d-flex align-items-center" href="#">
                <div class="col-md-1">
                    <img src="{{ asset('assets/logo.png') }}" alt="Lambang Jawa Barat" width="70">
                </div>
                <div class="col-md-11">
                    <h1 class="fs-3 ms-3" style="color: #00840c">Dinas Bina Marga dan Penataan Ruang Provinsi Jawa Barat
                    </h1>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="fs-6 mb-2" style="color: #212529" id="date-time">
                    <span id="date-part" class="fw-bold"></span>
                    <span id="time-part"></span>
                </p>

                @yield('button-link')
            </div>
        </div>
    </nav>

    @yield('content')

    <img src="{{ asset('assets/login-backg.png') }}" alt="background" class="background-img">

    @include('sweetalert::alert')

    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('js')
</body>

</html>
