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
                        <div class="col-lg-4 col-sm-12 col-md-6 col-xl-3 d-flex grid-margin stretch-card mb-2">
                            <div class="card overflow-hidden hover-img">
                                <div class="position-relative">
                                    @php
                                        $img = !empty($lowongan->img) ? $lowongan->img : 'default.jpg';
                                    @endphp

                                    <img src="{{ asset('img/post/' . $img) }}"
                                        class="card-img-top img-fluid object-fit-cover" alt="icon-profile"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                </div>
                                <div class="px-3">
                                    <hr class="my-2">
                                </div>

                                <div class="card-body">
                                    <a class="d-block fs-5 text-dark fw-semibold link-primary"
                                        style="text-decoration: none;">{{ $lowongan->judul }}</a>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center gap-4 mx-1">
                                            <i class="mdi mdi-briefcase text-dark fs-10"></i>{{ $lowongan->pemagang }}
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mx-2">
                                            <i class="mdi mdi-clock text-dark fs-10"></i>{{ $lowongan->durasi_magang }}
                                            bulan
                                        </div>
                                        <div class="d-flex align-items-center fs-10 ms-auto gap-2 mx-2">
                                            <i class="mdi mdi-calendar-check text-dark"></i>{{ $lowongan->close_lowongan }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
@endsection
