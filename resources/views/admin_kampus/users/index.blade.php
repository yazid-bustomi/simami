@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Mahasiswa</h5>
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm mr-4">
                <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah Mahasiswa
            </a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Nim</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                   <tbody>
                    @php $no = 1 @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $no }}</td>
                       <td>{{ $user->nama_depan }} {{ $user->nama_belakang }}</td>
                       <td>{{ $user->email }}</td>
                       <td>{{ $user->akademikProfile->nim }}</td>
                       <td>{{ $user->alamat->alamat ?? '-' }} {{ $user->alamat->desa ?? ''}} {{ $user->alamat->kecamatan ?? ''}} {{ $user->alamat->kab_kot ?? ''}} {{ $user->alamat->provinsi ?? ''}} {{ $user->alamat->kode_pos ?? ''}}</td>
                       <td>{{ $user->profile->no_hp ?? '-'}}</td>
                       <td>{{ $user->akademikProfile->jurusanKampus->nama_jurusan }}</td>
                       <td>{{ $user->akademikProfile->semester ?? '-' }}</td>
                       <td class="align-item-center text-center">
                        <a href="{{ route('user.edit', $user->id) }}" class="badge btn-info mb-3">
                            <i class="fas fa-edit"> Edit</i>
                        </a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete(this,'{{ $user->nama_depan . ' ' . $user->nama_belakang }}')" class="badge badge-danger">
                                <i class="fas fa-trash"> Delete</i>
                            </button>
                        </form>
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
        function confirmDelete(button, $nama) {
            Swal.fire({
                title: `Apakah Anda yakin menghapus ${$nama} ?`,
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
