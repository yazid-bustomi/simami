@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Jurusan</h5>
            <button class="btn btn-primary btn-sm mr-3" id="addJurusanBtn">
                <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah
            </button>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($jurusans as $jurusan)
                            <tr data-id="{{ $jurusan->id }}">
                                <td>{{ $no }}</td>
                                <td class="editable">{{ $jurusan->nama_jurusan }}</td>
                                <td>{{ $jurusan->akademikProfile->count() }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning edit-btn mb-2 mr-3">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-btn mb-2">Delete</button>
                                </td>
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
    {{-- Swal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function () {
            var updateRoute = "{{ route('jurusan.update', ':id') }}";
            var storeRoute = "{{ route('jurusan.store') }}";

            $('#addJurusanBtn').on('click', function () {
                Swal.fire({
                    title: 'Tambah Jurusan',
                    input: 'text',
                    inputLabel: 'Nama Jurusan',
                    inputPlaceholder: 'Masukkan nama jurusan',
                    showCancelButton: true,
                    confirmButtonText: 'Tambah',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Nama jurusan tidak boleh kosong!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: storeRoute,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                nama_jurusan: result.value
                            },
                            success: function (response) {
                                Swal.fire('Berhasil', 'Jurusan berhasil ditambahkan', 'success').then(() => {
                                    location.reload();
                                });
                            },
                            error: function (response) {
                                Swal.fire('Gagal', 'Jurusan gagal ditambahkan', 'error');
                            }
                        });
                    }
                });
            });

            $('.edit-btn').on('click', function () {
                var $row = $(this).closest('tr');
                var namaJurusan = $row.find('.editable').text();
                var jurusanId = $row.data('id');
                var ajaxUrl = updateRoute.replace(':id', jurusanId);

                Swal.fire({
                    title: 'Edit Nama Jurusan',
                    input: 'text',
                    inputLabel: 'Nama Jurusan',
                    inputValue: namaJurusan,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Nama jurusan tidak boleh kosong!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: ajaxUrl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'PUT',
                                nama_jurusan: result.value
                            },
                            success: function (response) {
                                Swal.fire('Berhasil', 'Data berhasil diupdate', 'success').then(() => {
                                    location.reload();
                                });
                            },
                            error: function (response) {
                                Swal.fire('Gagal', 'Data gagal diupdate', 'error');
                            }
                        });
                    }
                });
            });

            $('.delete-btn').on('click', function () {
                var $row = $(this).closest('tr');
                var namaJurusan = $row.find('.editable').text();
                var jurusanId = $row.data('id');

                Swal.fire({
                    title: `Apakah Anda yakin menghapus jurusan ${namaJurusan} ?`,
                    text: "Data ini tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('jurusan.destroy', 'jurusanId') }}'.replace('jurusanId', jurusanId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function (response) {
                                Swal.fire('Berhasil', 'Data berhasil dihapus', 'success').then(() => {
                                    $row.remove();
                                });
                            },
                            error: function (response) {
                                Swal.fire('Gagal', 'Data gagal dihapus', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
