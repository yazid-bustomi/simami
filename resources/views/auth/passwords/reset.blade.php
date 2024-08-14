@extends('layouts.auth')
@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center justify-content-center d-lg-none pt-5">
                            <img src="{{ asset('img/logo-itb.png') }}" class="small-image" style="width: 50%;" alt="logo-itb">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center pb-2">
                                    <h1 class="h4 text-gray-900 mb-4">Silahkan Riset Password Anda</h1>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="user" method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user  @error('email') is-invalid @enderror"
                                            id="email" aria-describedby="emailHelp" placeholder="Email" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" readonly
                                            autofocus>


                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" placeholder="Password" name="password" required
                                                autocomplete="new-password">

                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword()">
                                                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                                </span>
                                            </div>


                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password-confirm') is-invalid @enderror"
                                                id="password-confirm" placeholder="Password Confirmasi"
                                                name="password_confirmation" required autocomplete="new-password">

                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="toggleConfirmPassword()">
                                                    <i class="fa fa-eye" id="togglePasswordConfirmIcon"></i>
                                                </span>
                                            </div>

                                            @error('password-confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-user btn-block" type="submit">
                                        Reset Password
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                            <img src="{{ asset('img/logo-itb.png') }}" class="small-image" style="width: 70%;"
                                alt="logo-itb">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

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

        function toggleConfirmPassword() {
            var passwordField = document.getElementById("password-confirm");
            var toggleIcon = document.getElementById("togglePasswordConfirmIcon");
            if (passwordField.type === "password-confirm") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password-confirm";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
@endsection
