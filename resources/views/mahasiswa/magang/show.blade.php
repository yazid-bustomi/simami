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
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 class="card-title fw-bold mt-4">{{ $lowongan->judul }}</h4>
                            <a href="{{ route('magang.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i><span class="d-none d-sm-inline">Kembali</span>
                            </a>
                        </div>
                        <h5 class="card-subtitle mb-2 text-muted">Perusahaan:</h5>
                        <p class="card-text fw-bold">{{ $lowongan->user->nama_depan }}</p>
                        <p class="card-text"><i class="mdi mdi-map-marker"></i> Alamat:
                            {{ $lowongan->user->alamat->alamat }}
                            {{ $lowongan->user->alamat->provinsi }}
                            {{ $lowongan->user->alamat->kab_kot }}
                            {{ $lowongan->user->alamat->kecamatan }}
                            {{ $lowongan->user->alamat->desa }}
                            {{ $lowongan->user->alamat->kode_pos }}
                        </p>
                        @if (!empty($lowongan->user->sosmed))
                        @if (!empty($lowongan->user->sosmed->website))
                            <p class="card-text">
                                <i class="mdi mdi-web"></i> Website :
                                <a href="{{ $lowongan->user->sosmed->website }}" target="_blank">{{ $lowongan->user->sosmed->website }}</a>
                            </p>
                        @endif
                        @if (!empty($lowongan->user->sosmed->linkedin))
                            <p class="card-text">
                                <i class="mdi mdi-linkedin"></i> LinkedIn :
                                <a href="{{ $lowongan->user->sosmed->linkedin }}" target="_blank">{{ $lowongan->user->sosmed->linkedin }}</a>
                            </p>
                        @endif
                        @if (!empty($lowongan->user->sosmed->twiter))
                            <p class="card-text">
                                <i class="mdi mdi-twitter"></i> Twitter :
                                <a href="{{ $lowongan->user->sosmed->twiter }}" target="_blank">{{ $lowongan->user->sosmed->twiter }}</a>
                            </p>
                        @endif
                        @if (!empty($lowongan->user->sosmed->instagram))
                            <p class="card-text">
                                <i class="mdi mdi-instagram"></i> Instagram :
                                <a href="{{ $lowongan->user->sosmed->instagram }}" target="_blank">{{ $lowongan->user->sosmed->instagram }}</a>
                            </p>
                        @endif
                        @if (!empty($lowongan->user->sosmed->facebook))
                            <p class="card-text">
                                <i class="mdi mdi-facebook"></i> Facebook :
                                <a href="{{ $lowongan->user->sosmed->facebook }}" target="_blank">{{ $lowongan->user->sosmed->facebook }}</a>
                            </p>
                        @endif
                        @if (!empty($lowongan->user->sosmed->tiktok))
                            <p class="card-text">
                                <i class="mdi mdi-tiktok"></i> Tiktok :
                                <a href="{{$lowongan->user->sosmed->tiktok }}" target="_blank">{{ $lowongan->user->sosmed->tiktok }}</a>
                            </p>
                        @endif
                    @endif

                        <hr>

                        <p class="card-text"><i class="mdi mdi-briefcase"></i> Kebutuhan magang : {{ $lowongan->pemagang }} Orang
                        </p>
                        <p class="card-text"><i class="mdi mdi-clock"></i> Durasi : {{ $lowongan->durasi_magang }} bulan</p>
                        <p class="card-text"><i class="mdi mdi-calendar-check"></i> Penutupan :
                            {{ $lowongan->days_remaining }} Hari</p>
                        <hr>



                        <h6 class="card-subtitle mb-2 text-muted">Kriteria :</h6>
                        <p class="card-text">{!! nl2br(e($lowongan->kriteria ?? '')) !!}</p>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-muted">Rincian Kegiatan :</h6>
                        <p class="card-text">{!! nl2br(e($lowongan->rincian ?? '')) !!}</p>
                        <hr>
                        <div class="text-center">
                            <form action="{{ route('magang.store') }}" method="post">
                                @csrf
                                <input type="number" name="lowongan_id" hidden value="{{ $lowongan->id }}">
                                <input type="number" hidden name="mahasiswa_id" value="{{ Auth::user()->id }}">
                                <input type="text" name="status" value="pending" hidden>

                                <button type="button" class="btn btn-primary mx-5"
                                    onclick="confirmApprove(this, '{{ $lowongan->judul }}', '{{ route('profile.index') }}')">Lamar
                                    Sekarang</button>
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
        function confirmApprove(button, judul, routeProfile) {
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
                } else if (result.isDenied) {
                    window.location.href = routeProfile;
                }
            });
        }
    </script>
@endsection
