@extends('layouts.master')

@section('style')
    <!-- Link ke Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke Material Design Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <style>
        .object-fit-cover {
            object-fit: cover;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">


                    @foreach ($lowongans as $lowongan)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @php
                                    $img = !empty($lowongan->img) ? $lowongan->img : 'default.jpg';
                                @endphp
                                <img src="{{ asset('img/post/' . $img) }}" class="img-fluid rounded-start" style="height: 100%; object-fit: cover" alt="{{ $lowongan->judul }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title fw-bold">{{ $lowongan->judul }}</h4>
                                    <p class="card-text"><i class="mdi mdi-briefcase"></i> Pemagang: {{ $lowongan->pemagang }} Orang</p>
                                    <p class="card-text"><i class="mdi mdi-clock"></i> Durasi: {{ $lowongan->durasi_magang }} bulan</p>
                                    <p class="card-text"><i class="mdi mdi-calendar-check"></i> Penutupan: {{ $lowongan->days_remaining }} Hari</p>
                                    <p class="card-text"><strong>Kriteria:</strong> {{ $lowongan->short_kriteria }}</p>
                                    <a href="{{ route('magang.show', $lowongan->id) }}" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
