@extends('layouts.master')

@section('button-link')
    <a href="{{ route('survey') }}" type="button" class="btn bg-gradient-secondary btn-sm">Survey</a>
@endsection

@section('content')
    <style>
        .cam-wrapper {
            position: relative;
            z-index: 1;
        }

        .cam-half-out {
            position: relative;
            background: linear-gradient(to right, #55c05b, #198754);
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
        }

        .cam-half-out::before {
            content: '';
            position: absolute;
            bottom: -13px;
            left: 2px;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 0 solid transparent;
            border-top: 20px solid #55c05b;
            z-index: -2;
        }
    </style>

    <main class="d-flex align-items-center justify-content-center">
        <article class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 d-flex py-3 align-item-center">
                    <div class="card justify-content-center px-5 text-center bg-glass" style="height: 100%; width: 100%">
                        <h4 style="color: #212529">Selamat Datang <span style="color: #009604">Buku Tamu</span></h4>
                        <p>Dinas Bina Marga dan Penataan Ruang Provinsi Jawa Barat</p>
                        <img src="{{ asset('assets/logo-min.png') }}" alt="Lambang Jawa Barat" width="200"
                            class="img-fluid mx-auto">
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 py-3">
                    <div class="card p-3 bg-glass" style="height: 80vh">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('store_tamu') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <div class="rounded mb-1 label-wrapper">
                                        <div class="text-light label-half-out">REGISTER TAMU</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-2">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control shadow" id="nama"
                                                    name="nama">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-2">
                                                <label for="telp" class="form-label">No Telpon</label>
                                                <input type="text" class="form-control shadow" id="telp"
                                                    name="telp">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="instansi" class="form-label">Asal Instansi</label>
                                        <input type="text" class="form-control shadow" id="instansi" name="instansi">
                                    </div>
                                    <div class="mb-2">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control shadow" id="alamat" name="alamat">
                                    </div>
                                    <div class="mb-2">
                                        <label for="jekel" class="form-label">Jenis kelamin</label>
                                        <select class="form-select shadow" id="jekel" name="jekel"
                                            aria-label="Default select example">
                                            <option selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="keperluan_id" class="form-label">Keperluan</label>
                                        <select class="form-select shadow" id="keperluan_id" name="keperluan_id"
                                            aria-label="Default select example" data-placeholder="Pilih Keperluan">
                                            <option selected disabled>Pilih Keperluan</option>
                                            @foreach ($keperluans as $keperluan)
                                                <option value="{{ $keperluan->id }}">{{ $keperluan->judul }}</option>
                                            @endforeach
                                            <option value="lainnya">-- Lainnya --</option>
                                        </select>
                                        <input type="text" class="form-control shadow mt-1 d-none" id="keperluan_lainnya"
                                            name="keperluan_lainnya" placeholder="Isi Keperluan Anda">
                                    </div>
                                    <div class="mb-2">
                                        <label for="pegawai_id" class="form-label">Bertemu</label>
                                        <select class="form-select shadow" id="pegawai_id" name="pegawai_id"
                                            data-placeholder="Pilih Bertemu">
                                            {{-- <option selected disabled>Pilih Bertemu</option> --}}
                                            <option selected disabled></option>
                                            @foreach ($pegawais as $pegawai)
                                                <option value="{{ $pegawai->id }}">
                                                    {{ $pegawai->nip }} -- {{ $pegawai->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 cam">
                                    <div class="rounded mb-4 cam-wrapper">
                                        <div class="text-light text-end cam-half-out">Ambil Foto</div>
                                    </div>
                                    <video id="camera-stream" class="w-100 rounded" autoplay></video>
                                    <img id="image-preview" class="w-100 rounded d-none" src="" alt="Image Preview">
                                    <input type="hidden" id="foto" name="foto">
                                    <button type="button" id="capture" class="btn bg-gradient-info">
                                        <i class="fa fa-camera me-2"></i>Capture</button>
                                    <button type="submit" class="btn bg-gradient-primary shadow mt-2">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const video = $("#camera-stream")[0];
            const captureButton = $("#capture");
            const imageDataInput = $("#foto");
            const imagePreview = $("#image-preview")[0];

            // add function hide button submit
            const submitButton = $('button[type="submit"]');
            submitButton.hide();

            navigator.mediaDevices
                .getUserMedia({
                    video: true
                })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((error) => {
                    console.error("Ada kesalahan saat mengakses kamera: ", error);
                });

            captureButton.click(function() {
                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const imageDataURL = canvas.toDataURL("image/png");
                imageDataInput.val(imageDataURL);

                // Sembunyikan tag video dan tampilkan image preview
                video.style.display = "none";
                imagePreview.src = imageDataURL;
                $(imagePreview).removeClass("d-none");

                // add function hide button submit
                captureButton.hide();
                submitButton.show();
            });

            // Menangani Perubahan Dropdown Keperluan
            $('#keperluan_id').change(function() {
                if ($(this).val() === 'lainnya') {
                    $('#keperluan_lainnya').removeClass('d-none');
                } else {
                    $('#keperluan_lainnya').addClass('d-none');
                }
            });

            $('#pegawai_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                dropdownCssClass: 'select2-dropdown-custom',
            });
        });
    </script>
@endsection
