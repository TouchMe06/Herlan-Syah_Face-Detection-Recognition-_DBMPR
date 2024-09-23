@extends('admin.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('pegawai') }}" class="text-white fw-bold">Pegawai</a>
    </li>
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Edit</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Pegawai</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_pegawai', $pegawai->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control shadow" id="nama" name="nama"
                                value="{{ $pegawai->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control shadow" id="nip" name="nip"
                                value="{{ $pegawai->nip }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Telphone</label>
                            <input type="text" class="form-control shadow" id="telp" name="telp"
                                value="{{ $pegawai->telp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
                            <select class="form-select shadow" id="unit_kerja_id" name="unit_kerja_id"
                                aria-label="Default select example">
                                <option selected disabled>Pilih Unit Kerja</option>
                                @foreach ($unit_kerjas as $unit_kerja)
                                    <option value="{{ $unit_kerja->id }}"
                                        {{ $unit_kerja->id == $pegawai->unit_kerja_id ? 'selected' : '' }}>
                                        {{ $unit_kerja->nm_unit_kerja }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom">Simpan</button>
                        <a href="{{ route('pegawai') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
