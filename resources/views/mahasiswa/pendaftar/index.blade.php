@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Pelamar Lowongan Magang</h5>
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
                            <th>Lowongan</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            @if (Auth::user()->role == 'perusahaan')
                                <th>Instansi</th>
                                <th>Jurusan</th>
                            @endif
                            <th>Semester</th>
                            <th>Ipk</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $role = Auth::user()->role;
                            $no = 1;
                        @endphp
                        @foreach ($pendaftars as $pendaftar)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $pendaftar->lowongan->judul }}</td>
                                <td>{{ $pendaftar->user->nama_depan }} {{ $pendaftar->user->nama_belakang }}</td>
                                <td>{{ $pendaftar->user->mahasiswaProfile->no_hp ?? '-' }}</td>
                                @if (Auth::user()->role == 'perusahaan')
                                    <td>{{ $pendaftar->user->akademikProfile->adminKampus->nama_depan ?? '-' }}</td>
                                    <td>{{ $pendaftar->user->akademikProfile->jurusanKampus->nama_jurusan ?? '-' }}</td>
                                @endif
                                <td>{{ $pendaftar->user->akademikProfile->semester ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->ipk ?? '-' }}</td>
                                <td>
                                    @if ($pendaftar->status == 'pending')
                                        <div class="text-info">Seleksi Kampus</div>
                                    @elseif ($pendaftar->status == 'approve')
                                        <div class="text-primary"> Seleksi Perusahaan </div>
                                    @elseif ($pendaftar->status == 'select')
                                        <div class="text-success">Diterima Magang</div>
                                    @elseif ($pendaftar->status == 'rejected_kampus')
                                        <div class="text-danger">Ditolak Kampus</div>
                                    @else
                                        <div class="text-danger">Ditolak Perusahaan</div>
                                    @endif
                                </td>
                                <td>
                                    {{-- jika kampus dan status pending maka approve di lakukan oleh kampus terlebih dahulu --}}
                                    @if ($role == 'kampus' && $pendaftar->status == 'pending')
                                        <button class="badge bg-primary text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'approve')">Terima</button>
                                        <button class="badge bg-danger text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'rejected_kampus')">Tolak</button>

                                            {{-- Jika sudah di approve kampus maka di proses perusahaan apakah di terima atau di tolak --}}
                                            @elseif ($role == 'perusahaan' && $pendaftar->status == 'approve')
                                        <button class="badge bg-primary text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'select')">Terima</button>
                                        <button class="badge bg-danger text-white rounded-pill"
                                            onclick="confirmAction('{{ $pendaftar->id }}', '{{ $pendaftar->user->nama_depan . ' ' . $pendaftar->user->nama_belakang }}', 'rejected_perusahaan')">Tolak</button>
                                    @endif
                                    <a href="#" class="badge bg-info text-white rounded-pill">Detail</a>

                                    <form id="action-form-{{ $pendaftar->id }}"
                                        action="{{ route('pendaftar.update', ['pendaftar' => $pendaftar->id]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('PATCH')
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
            let actionText = '';
            let status = '';

            if (action === 'approve') {
                actionText = 'mengajukan magang';
                status = 'approve';
            } else if (action === 'select') {
                actionText = 'menerima magang';
                status = 'select';
            } else if (action === 'rejected_kampus') {
                actionText = 'menolak';
                status = 'rejected_kampus';
            } else if (action === 'rejected_perusahaan') {
                actionText = 'menolak';
                status = 'rejected_perusahaan';
            }


            let route = '{{ route('pendaftar.update', ':id') }}';
            route = route.replace(':id', id);

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
