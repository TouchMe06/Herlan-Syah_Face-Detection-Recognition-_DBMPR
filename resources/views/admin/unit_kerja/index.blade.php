@extends('admin.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Unit Kerja</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar Unit Kerja</h6>
                    <a href="{{ route('create_unit') }}" class="btn btn-custom" role="button"><i
                            class="fas fa-plus me-2"></i>Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama unit Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit_kerjas as $unit)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->nm_unit_kerja }}</td>
                                        <td><a class="btn btn-primary btn-sm text-xs my-1"
                                                href="{{ route('edit_unit', $unit->id) }}" role="button"><i
                                                    class="fa fa-edit me-1"></i>Edit</a>
                                            <!-- Formulir untuk DELETE -->
                                            <form id="deleteForm_{{ $unit->id }}"
                                                action="{{ route('destroy_unit', ['id' => $unit->id]) }}" method="POST"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm text-xs my-1"
                                                    onclick="">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJs')
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "language": {
                    "paginate": {
                        "previous": '<i class="fas fa-chevron-left"></i>',
                        "next": '<i class="fas fa-chevron-right"></i>'
                    }
                }
            });
        });
    </script>
@endsection
