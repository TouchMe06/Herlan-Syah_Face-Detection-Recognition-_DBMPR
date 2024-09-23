@extends('admin.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('nitKerja') }}" class="text-white fw-bold">Unit Kerja</a>
    </li>
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Tambah</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Unit Kerja</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_unit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nm_unit_kerja" class="form-label">Unit Kerja</label>
                            <input type="text" class="form-control shadow" id="unit_k" name="nm_unit_kerja" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Tambah</button>
                        <a href="{{ route('nitKerja') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
