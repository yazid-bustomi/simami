@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase text-sm mb-3">Edit Kampus</h5>
                    @include('admin.kampus.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
