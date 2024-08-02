@extends('layouts.master')

@section('style')
    <link href={{ asset('vendor/datatables/dataTables.bootstrap4.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold text-dark m-0 mx-4">Daftar Perusahaan</h5>
            <a href="{{ route('perusahaan.create') }}" class="btn btn-primary btn-sm mr-4">
                <i class="fas fa-plus-circle fa-sm fa-fw mr-2"></i> Tambah Perusahaan
            </a>

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
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>
                            <th>Lowongan Buka</th>
                            <th>Total Lowongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($companys as $company)
                            @php
                                $allJob = 0;
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $company->nama_depan ?? '' }}</td>
                                <td>
                                    {{ $company->alamat->alamat ?? '' }}
                                    {{ $company->alamat->provinsi ?? '' }}
                                    {{ $company->alamat->kab_kot ?? '' }}
                                    {{ $company->alamat->kecamatan ?? '' }}
                                    {{ $company->alamat->desa ?? '' }}
                                    {{ $company->alamat->kode_pos ?? '' }}
                                </td>
                                <td>
                                    @foreach ($company->lowongan as $lowongan)
                                        @if ($lowongan->close_lowongan >= $dateNow)
                                            @php
                                                $allJob++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    {{ $allJob }}
                                </td>
                                <td>{{ $company->lowongan->count() }}</td>
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
