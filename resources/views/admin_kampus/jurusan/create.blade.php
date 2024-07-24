@extends('layouts.master')

@section('content')
    <div class="container-fluid  py-4" style="min-height: 50%;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10 col-xl-8">
                <div class="card align-item-center ">
                    <div class="card-body">
                        <p class="text-uppercase text-sm text-center align-item-center">Tambah Jurusan</p>
                        <form action="{{ route('jurusan.store') }}" method="post">
                            @csrf
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-10 mt-4">
                                    <div class="form-gruop">
                                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" placeholder="Nama Jurusan" value="{{ old('jurusan') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center mt-4">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
