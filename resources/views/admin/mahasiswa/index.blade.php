@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Mahasiswa</h5>
            <a href="#" class="btn btn-primary btn-sm mr-4">
                <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah Mahasiswa
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Email</th>
                            <th>Kampus</th>
                            <th>Jurusan</th>
                            <th>No Hp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp

                        @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $mahasiswa->nama_depan }} {{ $mahasiswa->nama_belakang ?? '' }}</td>
                                <td>{{ $mahasiswa->akademikProfile->nim ?? '-' }}</td>
                                <td>{{ $mahasiswa->email ?? '' }}</td>
                                <td>{{ $mahasiswa->akademikProfile->adminKampus->nama_depan ?? '' }}</td>
                                <td>{{ $mahasiswa->akademikProfile->jurusanKampus->nama_jurusan ?? '-' }}</td>
                                <td>{{ $mahasiswa->profile->no_hp ?? '-' }}</td>
                                <td><button class="btn btn-rounded bg-info fw-bold" type="submit">Detail</button></td>
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
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src={{ asset('vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/datatables-demo.js') }}></script>
@endsection
