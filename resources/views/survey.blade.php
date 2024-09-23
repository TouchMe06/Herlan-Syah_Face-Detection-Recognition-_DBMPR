@extends('layouts.master')

@section('button-link')
    <a href="{{ route('home') }}" type="button" class="btn bg-gradient-secondary btn-sm">Tamu</a>
@endsection

@section('content')
    <style>
        .img-half-out {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
        }

        .card-relative {
            position: relative;
            padding-top: 40px;
            border: 3px solid #ccc;
        }

        .card-relative:hover {
            background-color: #ccc;
            color: #000;
            border-color: #000;
            border: #000;
        }
    </style>

    <main class="d-flex align-items-center justify-content-center">
        <article class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 d-flex py-3 align-item-center">
                    <div class="card justify-content-center px-5 text-center bg-glass" style="height: 100%; width: 100%">
                        <h4 style="color: #212529">Selamat Datang <span style="color:#009604">Buku Tamu</span></h4>
                        <p>Dinas Bina Marga dan Penataan Ruang Provinsi Jawa Barat</p>
                        <img src="{{ asset('assets/logo-min.png') }}" alt="Lambang Jawa Barat" width="200"
                            class="img-fluid mx-auto">
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 py-3">
                    <div class="card p-3 bg-glass" style="height: 80vh">
                        <div class="rounded label-wrapper">
                            <div class="text-light label-half-out">INDEX KEPUASAN</div>
                        </div>
                        <div class="row">
                            @foreach ($tamus as $tamu)
                                <div class="col-lg-3 col-md-6 pt-5">
                                    <a href="{{ route('isi_survey', $tamu->id) }}">
                                        <div class="card text-center card-relative">
                                            <img src="{{ asset('upload/' . $tamu->foto) }}" alt="gambar_tamu"
                                                class="img-fluid mx-auto rounded img-half-out" width="115">
                                            <div class="card-body">
                                                {{ $tamu->nama }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
@endsection
