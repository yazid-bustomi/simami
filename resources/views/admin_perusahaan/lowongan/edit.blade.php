@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase text-sm">Edit Lowongan Magang</h5>
                    @include('admin_perusahaan.lowongan.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
