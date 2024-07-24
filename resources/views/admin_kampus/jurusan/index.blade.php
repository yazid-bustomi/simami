@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Jurusan</h5>
            <form action="{{ route('jurusan.store') }}" method="POST" class="d-flex align-items-center mr-3">
                @csrf
                <input type="text" class="form-control @error('jurusan') is-invalid @enderror mr-2" name="jurusan"
                    placeholder="Nama Jurusan" value="{{ old('jurusan') }}" style="width: 250px;">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah
                </button>
            </form>
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
                                <td contenteditable="false" class="editable">{{ $jurusan->nama_jurusan }}</td>
                                <td>{{ $jurusan->akademikProfile->count() }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                    <button class="btn btn-sm btn-success save-btn d-none">Save</button>
                                    <button class="btn btn-sm btn-secondary back-btn d-none">Back</button>
                                    <button class="btn btn-sm btn-danger delete-btn">Delete</button>
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
            var updateRoute = "{{ route('jurusan.update', ':id') }}"
            $('.edit-btn').on('click', function () {
                var $row = $(this).closest('tr');
                $row.find('.editable').attr('contenteditable', 'true').addClass('editable-active').focus();
                $row.find('.edit-btn').addClass('d-none');
                $row.find('.save-btn, .back-btn').removeClass('d-none');
            });

            $('.back-btn').on('click', function () {
                var $row = $(this).closest('tr');
                $row.find('.editable').attr('contenteditable', 'false').removeClass('editable-active');
                $row.find('.edit-btn').removeClass('d-none');
                $row.find('.save-btn, .back-btn').addClass('d-none');
            });

            $('.save-btn').on('click', function () {
                var $row = $(this).closest('tr');
                var namaJurusan = $row.find('.editable').text();
                var jurusanId = $row.data('id');
                var ajaxUrl = updateRoute.replace(':id', jurusanId);

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        nama_jurusan: namaJurusan
                    },
                    success: function (response) {
                        Swal.fire('Berhasil', 'Data berhasil diupdate', 'success');
                        $row.find('.editable').attr('contenteditable', 'false').removeClass('editable-active');
                        $row.find('.edit-btn').removeClass('d-none');
                        $row.find('.save-btn, .back-btn').addClass('d-none');
                    },
                    error: function (response) {
                        Swal.fire('Gagal', 'Data gagal diupdate', 'error');
                    }
                });
            });

            $('.delete-btn').on('click', function () {
                var $row = $(this).closest('tr');
                var namaJurusan = $row.find('.editable').text();
                var jurusanId = $row.data('id');

                Swal.fire({
                    title: `Apakah Anda yakin menghapus ${namaJurusan} ?`,
                    text: "Data ini tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('jurusan.destroy', 'jurusanId') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function (response) {
                                Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                                $row.remove();
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
