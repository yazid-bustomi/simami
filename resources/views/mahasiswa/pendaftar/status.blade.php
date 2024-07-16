@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Lamar Magang</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lowongan</th>
                            <th>No Hp</th>
                            <th>Instansi</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>Ipk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pendaftars as $pendaftar)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $pendaftar->lowongan->judul }}</td>
                                <td>{{ $pendaftar->user->mahasiswaProfile->no_hp ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->adminKampus->nama_depan ?? '-' }}</td>
                                <td>{{ $pendaftar->user->akademikProfile->jurusanKampus->nama_jurusan ?? '-' }}</td>
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

                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody> --}}
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
@endsection
