@extends('admin.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('tanya') }}" class="text-white">Pertanyaan</a>
    </li>
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Edit</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Pertanyaan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_tanya', $pertanyaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="daftar_pertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control shadow" id="daftar_pertanyaan"
                                name="daftar_pertanyaan" value="{{ $pertanyaan->daftar_pertanyaan }}" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Simpan</button>
                        <a href="{{ route('tanya') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
