@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Tambah Mahasiswa</p>
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_depan" class="form-control-label ">Nama Depan *</label>

                                        <input class="form-control @error('nama_depan') is-invalid @enderror"
                                            name="nama_depan" type="text" placeholder="Nama Depan"
                                            onfocusout="defocused(this)" value="{{ old('nama_depan') }}" required>

                                        @error('nama_depan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_belakang" class="form-control-label">Nama Belakang</label>

                                        <input class="form-control @error('nama_belakang') is-invalid @enderror"
                                            id="nama_belakang" name="nama_belakang" type="text"
                                            placeholder="Nama Belakang" value="{{ old('nama_belakang') }}"
                                            onfocusout="defocused(this)">

                                        @error('nama_belakang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="jurusan" class="form-control-label">Pilih Jurusan</label>

                                        <select id="jurusan"
                                            class="form-control form-control-user @error('jurusan') is-invalid @enderror"
                                            name="jurusan" required>
                                            <option value="">{{ __('Pilih Jurusan') }}</option>
                                            @foreach ($jurusan as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['nama_jurusan'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('jurusan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nim" class="form-control-label">Nomer Induk Mahasiswa</label>

                                        <input class="form-control @error('nim') is-invalid @enderror"
                                            id="nim" name="nim" type="number"
                                            placeholder="01010101" value="{{ old('nim') }}"
                                            onfocusout="defocused(this)">

                                        @error('nim')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email *</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" type="email" placeholder="@kampus.com"
                                            onfocusout="defocused(this)" value="{{ old('email') }}" required>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password *</label>
                                        <div class="input-group">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" type="password" onfocusout="defocused(this)"
                                                autocomplete="current-password" value="{{ old('password') }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword()">
                                                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                                </span>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center mt-3">
                                    <a href="{{ route('user.index') }}" class="btn btn-danger mx-4">Back</a>
                                    <button type="submit" class="btn btn-primary mx-4">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                var toggleIcon = document.getElementById("togglePasswordIcon");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                }
            }
        </script>
    @endsection
