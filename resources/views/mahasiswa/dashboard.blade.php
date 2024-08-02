@extends('layouts.master')

@section('content')
    <!-- Content Row -->
    <div class="row">
        {{-- Card Total mendaftar --}}
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <a href="{{ route('mahasiswa.status') }}" class="text-decoration-none">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Proses Seleksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $allAplications }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-business-time  fa-2x text-primary"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Total di terima --}}
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <a href="{{ route('mahasiswa.status') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Diterima</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $confirmAplications }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <a href="{{ route('mahasiswa.status') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Ditolak</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $allReject }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-times fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
