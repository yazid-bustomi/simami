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
                            <th>PT</th>
                            <th>Posisi Magang</th>
                            <th>Durasi</th>
                            <th>Batas Pendaftaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        {{-- @foreach ($approve as $data)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $data->lowongan->judul }}</td>
                                <td>{{ $data->user->mahasiswaProfile->no_hp ?? '-' }}</td>
                                <td>{{ $data->user->akademikProfile->semester ?? '-' }}</td>
                                <td>{{ $data->user->akademikProfile->ipk ?? '-' }}</td>
                                <td>
                                    @if ($data->status == 'pending')
                                        <div class="text-info">Seleksi Kampus</div>
                                        @elseif ($data->status == 'approve')
                                        <div class="text-primary"> Seleksi Perusahaan </div>
                                        @elseif ($data->status == 'select')
                                        <div class="text-success">Diterima Magang</div>
                                        @elseif ($data->status == 'rejected_kampus')
                                        <div class="text-danger">Ditolak Kampus</div>
                                        @else
                                        <div class="text-danger">Ditolak Perusahaan</div>
                                    @endif
                                </td>

                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach --}}
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
