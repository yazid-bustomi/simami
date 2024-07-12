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
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user  @error('email') is-invalid @enderror"
                                            id="email" aria-describedby="emailHelp" placeholder="Email" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password" placeholder="Password" name="password" required
                                            autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user @error('password-confirm') is-invalid @enderror"
                                            id="password-confirm" placeholder="Password Confirmasi" name="password_confirmation" required
                                            autocomplete="new-password">

                                        @error('password-confirm')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
@endsection
