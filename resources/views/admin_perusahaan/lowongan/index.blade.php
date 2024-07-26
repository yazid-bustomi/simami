@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Lowongan Magang</h5>
            @if (Auth::user()->role == 'perusahaan' || Auth::user()->role == 'admin')
                <a href="{{ route('lowongan.create') }}" class="btn btn-primary btn-sm mr-4">
                    <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah Lowongan
                </a>
            @else
            @endif
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi Magang</th>
                            <th>Kebutuhan</th>
                            <th>Durasi</th>
                            <th>Batas Pendaftaran</th>
                            <th>Pendaftar</th>
                            @if (Auth::user()->role == 'perusahaan')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($lowongans as $lowongan)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $lowongan->judul }}</td>
                                <td>{{ $lowongan->pemagang }} Orang</td>
                                <td>{{ $lowongan->durasi_magang }} bulan</td>
                                <td>{{ $lowongan->close_lowongan }}</td>
                                <td>{{ $lowongan->pendaftar()->count() }} Mahasiswa</td>
                                @if (Auth::user()->role == 'perusahaan')
                                    <td>
                                        <a href="{{ route('lowongan.edit', $lowongan->id) }}"
                                            class="btn btn-warning btn-sm my-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm my-md-2"
                                                onclick="confirmDelete(this)">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @php $no++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src={{ asset('vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/datatables-demo.js') }}></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Apakah Anda yakin menghapus lowongan ?',
                text: "Data ini tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection
