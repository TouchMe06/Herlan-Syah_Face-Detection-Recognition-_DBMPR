@extends('admin.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Daftar Tamu</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar Tamu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead>
                                <tr class="text-sm">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Instansi</th>
                                    <th>Telpon</th>
                                    <th>Kelamin</th>
                                    <th>Bertemu</th>
                                    <th>Keperluan</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tamus as $tamu)
                                    <tr class="text-center align-middle text-sm">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tamu->nama }}</td>
                                        <td>{{ $tamu->alamat }}</td>
                                        <td>{{ $tamu->instansi }}</td>
                                        <td>{{ $tamu->telp }}</td>
                                        <td>{{ $tamu->jekel }}</td>
                                        <td>{{ $tamu->pegawai->nama }}</td>
                                        <td>
                                            @if ($tamu->keperluan_id === null)
                                                {{ $tamu->keperluan_lainnya }}
                                            @else
                                                {{ $tamu->keperluan ? $tamu->keperluan->judul : 'Tidak ada keperluan' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($tamu->created_at)->format('H:i:s') }} <br>
                                            {{ \Carbon\Carbon::parse($tamu->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td id="checkout-{{ $tamu->id }}">
                                            @if ($tamu->keluar)
                                                {{ \Carbon\Carbon::parse($tamu->keluar)->format('H:i:s') }} <br>
                                                {{ \Carbon\Carbon::parse($tamu->keluar)->format('d-m-Y') }}
                                            @else
                                                <button class="btn bg-gradient-warning btn-xs"
                                                    onclick="">Checkout</button>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column flex-md-row">
                                                <a class="btn btn-primary btn-xs text-xs my-1 me-md-1"
                                                    href="{{ route('edit_tamu', ['id' => $tamu->id]) }}" role="button">
                                                    <i class="fa fa-edit me-1"></i>Edit
                                                </a>
                                                <form id="deleteForm_{{ $tamu->id }}"
                                                    action="{{ route('hapus_tamu', ['id' => $tamu->id]) }}" method=""
                                                    class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger btn-xs text-xs my-1"
                                                        onclick="deleteConfirmation('deleteForm_{{ $tamu->id }}')">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
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

        function checkoutTamu(id) {
            $.ajax({
                url: '/daftar-tamu/checkout/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'success',
                            'Tamu sudah keluar',
                            'success'
                        );
                        $('#checkout-' + id).html(response.checkout_time.replace(' ', '<br>'));
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Checkout gagal, silahkan coba lagi.',
                            'error'
                        );
                    }
                },
                error: function(response) {
                    Swal.fire(
                        'Gagal!',
                        'Checkout gagal, silahkan coba lagi.',
                        'error'
                    );
                }
            });
        }
    </script>
@endsection
