@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Pelamar Lowongan Magang</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lowongan</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            <th>Instansi</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>Ipk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pendaftars as $pendaftar)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $pendaftar->lowongan->judul }}</td>
                                <td>{{ $pendaftar->user->nama_depan }} {{ $pendaftar->user->nama_belakang }}</td>
                                <td>{{ $pendaftar->user->mahasiswaProfile->no_hp ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->adminKampus->nama_depan ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->jurusanKampus->nama_jurusan ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->semester ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->ipk ?? '-' }}</td>
                                <td>
                                    <button class="badge bg-primary text-white rounded-pill"
                                        onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'terima')">Terima</button>

                                    <button class="badge bg-danger text-white rounded-pill"
                                        onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'tolak')">Tolak</button>

                                    <a href="#" class="badge bg-info text-white rounded-pill">Detail</a>

                                    <form id="action-form-{{ $pendaftar->id }}" action="{{ route('pendaftar.edit', ['pendaftar' => $pendaftar->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmAction(id, name, action) {
            let actionText = action === 'terima' ? 'menerima' : 'menolak';

            let route = routes[action];
            let route = action === 'terima' ? '{{ route('pendaftar.edit', ':id') }}' :
                '{{ route('pendaftar.edit', ':id') }}';
            route = route.replace(':id', id);

            let status = action === 'terima' ? 'tolak' : 'rejected';

            Swal.fire({
                title: `Apakah yakin ${actionText} ${name}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ' + actionText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('action-form-' + id);
                    form.action = route;

                    // Append hidden input for status
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'status';
                    input.value = status;
                    form.appendChild(input);
                    form.submit();
                }
            });
        }
    </script>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src={{ asset('vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/datatables-demo.js') }}></script>
@endsection
