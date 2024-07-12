@extends('layouts.auth')

@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center justify-content-center d-lg-none pt-5">
                    <img src="{{ asset('img/logo-itb.png') }}" alt="logo-itb" class="small-image" style="width: 50%">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                        </div>
                    <form method="POST" action="{{ route('register') }}" class="user">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text"
                                        class="form-control form-control-user @error('name_depan') is-invalid @enderror"
                                        id="nama_depan" name="nama_depan" placeholder="Nama Depan" autocomplete="nama_depan"
                                        required autofocus>
                                    @error('nama_depan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control form-control-user @error('nama_belakang') is-invalid @enderror"
                                        id="nama_belakang" name="nama_belakang" placeholder="Nama Belakang"
                                        autocomplete="nama_belakang">
                                    @error('nama_belakang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" placeholder="Email Address" name="email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select name="kampus" id="kampus"
                                        class="form-control form-control-user @error('kampus') is-invalid @enderror"
                                        required>
                                        <option value="">Pilih Perguruan Tinggi</option>
                                        @foreach ($kampus as $instansi)
                                            <option value="{{ $instansi->id }}">{{ $instansi->nama_depan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <!-- Dropdown for Jurusan -->
                                    <div class="form-group">
                                        <select id="jurusan"
                                            class="form-control form-control-user @error('jurusan') is-invalid @enderror"
                                            name="jurusan" required>
                                            <option value="">{{ __('Pilih Jurusan') }}</option>
                                        </select>
                                        @error('jurusan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="password" name="password" required autocomplete="new-password"
                                        placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password-confirm"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Ulangi Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Register Akun</button>

                            <hr>
                            <a href="#" class="btn btn-google btn-user btn-block">
                                <i class="fas fa-home fa-fw"></i> Back to Home
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('kampus').addEventListener('change', function() {
            var kampusId = this.value;
            var jurusanSelect = document.getElementById('jurusan');
            jurusanSelect.innerHTML = '<option value="">{{ __('Pilih Jurusan') }}</option>';

            if (kampusId) {
                fetch('/get-jurusan/' + kampusId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(jurusan => {
                            var option = document.createElement('option');
                            option.value = jurusan.id;
                            option.textContent = jurusan.nama_jurusan;
                            jurusanSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection
