@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="row g-0">

                <div class="col-md-4">
                    @php
                        $img = !empty($lowongan->img) ? $lowongan->img : 'default.jpg';
                    @endphp
                    <img src="{{ asset('img/post/' . $img) }}" class="img-fluid rounded-start" alt="{{ $lowongan->judul }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @elseif (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-start">
                            <h4 class="card-title fw-bold mt-4">{{ $lowongan->judul }}</h4>
                            <a href="{{ route('magang.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i><span class="d-none d-sm-inline">Kembali</span>
                            </a>
                        </div>
                        <p class="card-text"><i class="mdi mdi-briefcase"></i> Pemagang: {{ $lowongan->pemagang }} Orang</p>
                        <p class="card-text"><i class="mdi mdi-clock"></i> Durasi: {{ $lowongan->durasi_magang }} bulan</p>
                        <p class="card-text"><i class="mdi mdi-calendar-check"></i> Penutupan: {{ $lowongan->days_remaining }} Hari</p>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-muted">Kriteria:</h6>
                        <p class="card-text">{!! nl2br(e($lowongan->kriteria ?? '')) !!}</p>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-muted">Rincian Kegiatan:</h6>
                        <p class="card-text">{!! nl2br(e($lowongan->rincian ?? '')) !!}</p>
                        <hr>
                        <div class="text-center">
                            <form action="{{ route('magang.store') }}" method="post">
                                @csrf
                                <input type="number" name="lowongan_id" hidden value="{{ $lowongan->id }}">
                                <input type="number" hidden name="mahasiswa_id" value="{{ Auth::user()->id }}">
                                <input type="text" name="status" value="pending" hidden>

                                <button type="button" class="btn btn-primary mx-5" onclick="confirmApprove(this, '{{ $lowongan->judul }}')">Lamar Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function confirmApprove(button, judul) {
            Swal.fire({
                title: `Apakah anda yakin melamar ${judul}?`,
                text: "Pastikan data profil Anda sudah lengkap untuk di seleksi.",
                icon: 'warning',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                denyButtonColor: '#009000',
                confirmButtonText: 'Ya, lamar sekarang!',
                denyButtonText: 'Profile',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                } else if(result.isDenied){
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        }
    </script>
@endsection
