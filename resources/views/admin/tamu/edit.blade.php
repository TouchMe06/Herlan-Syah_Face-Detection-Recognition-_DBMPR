@extends('admin.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('daftar_tamu') }}" class="text-white fw-bold">Daftar Tamu</a>
    </li>
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Edit</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Tamu</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_tamu', $tamu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control shadow" id="nama" name="nama"
                                value="{{ $tamu->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">No Telpon</label>
                            <input type="text" class="form-control shadow" id="telp" name="telp"
                                value="{{ $tamu->telp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Instansi</label>
                            <input type="text" class="form-control shadow" id="instansi" name="instansi"
                                value="{{ $tamu->instansi }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control shadow" id="alamat" name="alamat"
                                value="{{ $tamu->alamat }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jekel" class="form-label">Jenis kelamin</label>
                            <select class="form-select shadow" id="jekel" name="jekel"
                                aria-label="Default select example">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ $tamu->jekel == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Perempuan" {{ $tamu->jekel == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="keperluan_id" class="form-label">Keperluan</label>
                            <select class="form-select shadow" id="keperluan_id" name="keperluan_id"
                                aria-label="Default select example">
                                <option selected disabled>Pilih Keperluan</option>
                                @foreach ($keperluans as $keperluan)
                                    <option value="{{ $keperluan->id }}"
                                        {{ $keperluan->id == $tamu->keperluan_id ? 'selected' : '' }}>
                                        {{ $keperluan->judul }}</option>
                                @endforeach
                                <option value="lainnya">Lainnya</option>
                            </select>
                            <input type="text" class="form-control shadow mt-1 d-none" id="keperluan_lainnya"
                                name="keperluan_lainnya" placeholder="Isi Keperluan Anda">
                        </div>
                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Bertemu</label>
                            <select class="form-select shadow" id="pegawai_id" name="pegawai_id"
                                aria-label="Default select example">
                                <option selected disabled>Pilih Bertemu</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ $pegawai->id == $tamu->pegawai_id ? 'selected' : '' }}>
                                        {{ $pegawai->nip }} -- {{ $pegawai->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom">Simpan</button>
                        <a href="{{ route('daftar_tamu') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJs')
    <script>
        $(document).ready(function() {
            // Menangani Perubahan Dropdown Keperluan
            $('#keperluan_id').change(function() {
                if ($(this).val() === 'lainnya') {
                    $('#keperluan_lainnya').removeClass('d-none');
                } else {
                    $('#keperluan_lainnya').addClass('d-none');
                }
            });
        })
    </script>
@endsection
