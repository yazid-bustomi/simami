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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pemagang</th>
                            <th>Durasi</th>
                            <th>Open Informasi</th>
                            <th>Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($lowongans as $lowongan)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $lowongan->judul }}</td>
                                <td>{{ $lowongan->pemagang }}</td>
                                <td>{{ $lowongan->durasi_magang }} bulan</td>
                                <td>{{ $lowongan->close_lowongan }}</td>
                                <td>{{ $lowongan->pendaftar()->count() }}</td>
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
@endsection
