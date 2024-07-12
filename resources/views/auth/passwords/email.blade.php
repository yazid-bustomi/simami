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
                            <img src="{{ asset('img/logo-itb.png') }}" class="small-image" style="width: 40%;" alt="logo-itb">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Lupa Password ?</h1>
                                    <p class="mb-4">Silahkan input email untuk reset pasword</p>
                                    @if (session('status'))
                                    <div class="alert alert-succes" role="alert">
                                        Riset password sudah terkirim, silahkan cek email anda.
                                    </div>

                                    @endif
                                </div>
                                <form class="user" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is->invalid @enderror"
                                            id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus
                                            placeholder="Silahkan Masukkan Email Anda">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                            <img src="{{ asset('img/logo-itb.png') }}" class="small-image" style="width: 50%;"
                                alt="logo-itb">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
